<?php

namespace App\Http\Controllers\Inventaris;

use App\Http\Controllers\Controller;
use App\Models\Inventaris\{InventarisPenjualan as Penjualan, InventarisPenjualanPenawar as Penawar};
use App\Models\LogActivity;
use App\Models\User;
use App\Notifications\NotifikasiPengajuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class InventarisPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $jabatan = Auth::user()->jabatan;
        $id_cabang = Auth::user()->id_cabang;
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();
        $reqCabang = $request->id_cabang;
        $kode = $request->kode;

        // pemberitahuan sudah dibaca
        if ($kode != null) {
            auth()->user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        }

        if (request()->ajax()) {
            switch ($jabatan) {
                # kaops ...
                case 'Kasi Operasional':
                case 'Kasi Komersial':
                case 'Analis Area':
                case 'Staf Area':
                case 'Sekretariat':
                case 'Kepala Kantor Kas':
                case 'Pimpinan Cabang':
                    if (!empty($request->kode)) {
                        $data = Penjualan::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Penjualan::where('id_cabang', $id_cabang)
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Penjualan::where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                # Pimpinan Cabang ...
                case 'Pembukuan':
                case 'Internal Audit':
                    if (!empty($request->kode)) {
                        $data = Penjualan::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Penjualan::whereIn('status_pincab', ['Approve', '--'])
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->get();
                        } elseif (!empty($request->cari)) {
                            $data = Penjualan::where('kode_form', $request->cari)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Penjualan::whereIn('status_pincab', ['Approve', '--'])
                                ->OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'Direktur Operasional':
                case 'Direktur Utama':
                    if (!empty($request->kode)) {
                        $data = Penjualan::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Penjualan::where('status_pembukuan', "Edited")
                                ->orwhere('status_pembukuan', 'Approve')
                                ->orwhere('status_tsi', '--')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Penjualan::where('status_pembukuan', 'Approve')->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'TSI':
                    if (!empty($request->kode)) {
                        $data = Penjualan::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Penjualan::where('status_dirut', 'Approve')
                                ->orWhere('status_pembukuan', 'Approve')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Penjualan::where('status_dirut', 'Approve')->orWhere('status_pembukuan', 'Approve')->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                default:
                    $data = ['tidak ada data'];
                    break;
            }

            return DataTables()->of($data)
                ->addColumn('id_cabang', function ($data) {
                    return $data->cabang->cabang;
                })
                ->addColumn('status', function ($data) {
                    $statusDropdown = $this->statusNothing($data); //menyimpan ke variable dari status private ke table sini

                    $status = '';
                    switch (auth()->user()->jabatan) {
                        case 'Kasi Operasional':
                        case 'Kasi Komersial':
                        case 'Analis Area':
                        case 'Staf Area':
                        case 'Sekretariat':
                        case 'Kepala Kantor Kas':
                            if ($data->status_akhir == 'Selesai') {
                                $status .= '<a class="btn btn-success btn-sm disabled">Selesai</a>';
                            } elseif ($data->status_dirut == 'Approve') {
                                $status = '';
                                $status .= '<div class="dropdown">';
                                $status .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                $status .= 'Nothing';
                                $status .= '</button>';
                                $status .= '<div class="dropdown-menu" aria-labelledby="statusDropdown">';
                                $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_inventaris_penjualan) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
                                $status .= '</div>';
                                $status .= '</div>';
                            } else {
                                $status .= '<a class="btn btn-success btn-sm disabled">Terkirim</a>';
                            }
                            break;

                        case 'Pimpinan Cabang':
                            $jabatan = $data->status_pincab;
                            $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;

                        case 'Pembukuan':
                            $jabatan = $data->status_pembukuan;
                            $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;

                        case 'Direktur Operasional':
                            $status .= '<a class="btn btn-info btn-sm disabled">NotNeeded</a>';
                            // if ($data->status_pembukuan != null) {
                            //     $jabatan = $data->status_dirut;
                            //     $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                            //     return $statusAfter;
                            // }
                            break;

                        case 'Direktur Utama':
                            if ($data->status_dirops != null) {
                                $status .= '<a class="btn btn-success btn-sm disabled">Finish</a>';
                            } else if ($data->status_pembukuan != null) {
                                $jabatan = $data->status_dirut;
                                $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                                return $statusAfter;
                            } else {
                                $status .= '<a class="btn btn-warning btn-sm disabled">NotYet</a>';
                            }
                            break;
                    }

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id_inventaris_penjualan . '" id="' . $data->id_inventaris_penjualan . '"
                                        class="btn btn-info btn-sm detail_data" data-kode_form="' . $data->kode_form . '">
                                        <span class="icon text-white-50">
                                        <i class="fa fa-eye"></i>
                                        </span>
                                    </a>';
                    $button .= '&nbsp;';

                    # code pembagian user Aksi
                    switch (auth()->user()->jabatan) {
                        # Kaops...
                        case 'Kasi Operasional':
                        case 'Kasi Komersial':
                        case 'Analis Area':
                        case 'Staf Area':
                        case 'Sekretariat':
                        case 'Kepala Kantor Kas':
                            if ($data->status_pincab == "Approve" || $data->status_pincab == "Reject"  || $data->status_pembukuan != null) {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_inventaris_penjualan . '" id="' . $data->id_inventaris_penjualan . '"
                                                class="btn btn-warning btn-sm edit" data-kode_form="' . $data->kode_form . '">
                                            <i class="fa fa-edit"></i></a>';
                                $button .= '&nbsp;';
                            }
                            break;
                        # Pincab...
                        case 'Pimpinan Cabang':
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                        # Pembukuan, dirut & TSi...
                        case 'Pembukuan':
                        case 'Direktur Operasional':
                        case 'Direktur Utama':
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                    }
                    return $button;
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('Page.Inventaris_penjualan.index', ['title' => 'Pengajuan Penjualan Inventaris']);
    }


    public function store(Request $request)
    {
        $cabang = DB::connection('mysql') // Assuming 'mysql' is the default connection in your database.php configuration
            ->table('tb_cabang')
            // ->select('kode', 'nama_pincab') // jika ada select tertentu diakhiri ->first() atau get()
            ->where('id_cabang', auth()->user()->id_cabang)
            ->value('kode');
        // dd($cabang);
        $now = Carbon::now();
        $thn = $now->year;

        if ($thn == 2023) {
            $cek = 0;
        } else {
            $cek = Penjualan::count();
        }

        if ($cek == 0) {
            $urut = 0001;
            $nomer = $cabang . '/INV-SLL/' . $thn . '/0001';
        } else {
            $ambil = Penjualan::all()->last();
            $cekTahun = substr($ambil->kode_form, -9, 4);
            if ($cekTahun != $thn) {
                $urut = 0001;
                $nomer = $cabang . '/INV-SLL/' . $thn . '/0001';
            } else {
                $urut = substr($ambil->kode_form, -4, 10);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 4, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $cabang . '/INV-SLL/' . $thn . '/' . $urut;
            }
        }

        $data = new Penjualan();
        $data->id_cabang = auth()->user()->id_cabang;
        $data->nama_kaops = auth()->user()->nama;
        $data->kode_form = $nomer;
        $data->kategori_barang = $request->kategori_barang;
        $data->no_inventaris = $request->no_inventaris;
        $data->detail_barang = $request->detail_barang;
        $data->kondisi_terakhir = $request->kondisi_terakhir;
        $data->keterangan = $request->keterangan;

        $files = $request->file('file');
        $fileName = $files->getClientOriginalName();
        $files->move('file_upload/Inventaris Jual', $fileName);
        $data->file = $fileName;
        $data->save();

        for ($i = 1; $i < 10; $i++) {
            # code...
            $harga_tawar = str_replace(['Rp. ', '.'], '', $request->input('harga_tawar_' . $i));
            if ($request->input('nama_' . $i) != '') {
                # code...
                $penawar = new Penawar();
                $penawar->id_inventaris_penjualan = $data->id_inventaris_penjualan;
                $penawar->id_cabang = auth()->user()->id_cabang;
                $penawar->nama = $request->input('nama_' . $i);
                $penawar->nik = $request->input('nik_' . $i);
                $penawar->alamat = $request->input('alamat_' . $i);
                $penawar->harga_tawar = $harga_tawar;
                $penawar->save();
            }
        }

        // Log Activity
        $LogAksi = '(+) Pengajuan Penjualan Inventaris';
        $this->LogActivity($data, $LogAksi);
        // Send Email
        if (auth()->user()->jabatan == 'Analis Area' || auth()->user()->jabatan == 'Staf Area' || auth()->user()->jabatan == 'Sekretariat') {
            $data->update([
                'nama_pincab' => 'Ditarik Oleh User Pembukuan',
                'status_pincab' => '--',
                'tgl_status_pincab' => null,
            ]);

            $userPenerima = User::where('jabatan', 'Pembukuan')->get();
            $url = route('inventaris-penjualan.index');
            $title = 'Terdapat Form Pengajuan Baru!';
            $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
            $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
        } else {
            $userPenerima = User::where('id_cabang', auth()->user()->id_cabang)
                ->where('jabatan', 'Pimpinan Cabang')->first();
            $url = route('inventaris-penjualan.index');
            $title = 'Terdapat Form Pengajuan Baru!';
            $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
            $this->SendEmail($data, $userPenerima, $url, $title, $message);
        }

        return redirect('inventaris-penjualan')->with('AlertSuccess', "Pengajuan Penjualan Inventaris Berhasil Dikirim!");
    }


    public function show(Penjualan $penjualan)
    {
        return view('Page.Inventaris_penjualan.show', compact('penjualan'));
    }


    public function edit(Penjualan $penjualan)
    {
        return view('Page.Inventaris_penjualan.modal-edit', compact('penjualan'), ['title' => 'Penjualan']);
    }


    public function update(Request $request, Penjualan $penjualan)
    {
        $penjualan->id_cabang = auth()->user()->id_cabang;
        $penjualan->nama_kaops = auth()->user()->nama;
        $penjualan->kategori_barang = $request->kategori_barang;
        $penjualan->no_inventaris = $request->no_inventaris;
        $penjualan->detail_barang = $request->detail_barang;
        $penjualan->kondisi_terakhir = $request->kondisi_terakhir;
        $penjualan->keterangan = $request->keterangan;

        if ($request->file('file') != null) {
            $files = $request->file('file');
            $fileName = $files->getClientOriginalName();
            $files->move('file_upload/Inventaris Jual', $fileName);
            $penjualan->file = $fileName;
        }
        $penjualan->save();

        for ($i = 1; $i < 10; $i++) {
            # code...
            $penawar = Penawar::where('id_penawar', $request->input('id_penawar_' . $i))->first();
            $harga_tawar = str_replace(['Rp. ', '.'], '', $request->input('harga_tawar_' . $i));

            // kondisi untuk pwmilihan aksi
            if (!empty($penawar)) {
                # code...
                if ($request->input('aksi_' . $i) == 'Edit') {
                    $penawar->nama = $request->input('nama_' . $i);
                    $penawar->nik = $request->input('nik_' . $i);
                    $penawar->alamat = $request->input('alamat_' . $i);
                    $penawar->harga_tawar = $harga_tawar;
                    $penawar->save();
                } else {
                    $penawar->delete();
                }
            } else {
                if ($request->input('nama_' . $i) != '') {
                    # code...
                    $penawar = new Penawar();
                    $penawar->id_inventaris_penjualan = $penjualan->id_inventaris_penjualan;
                    $penawar->id_cabang = auth()->user()->id_cabang;
                    $penawar->nama = $request->input('nama_' . $i);
                    $penawar->nik = $request->input('nik_' . $i);
                    $penawar->alamat = $request->input('alamat_' . $i);
                    $penawar->harga_tawar = $harga_tawar;
                    $penawar->save();
                }
            }
        }

        // Log Activity
        $LogAksi = '(u) Pengajuan Penjualan Inventaris';
        $this->LogActivity($penjualan, $LogAksi);

        return redirect()->back()->with('inventaris-penjualan')->with('AlertSuccess', "Pengajuan Penjualan Inventaris Berhasil Diupdate!");
    }

    public function Print($idEncrypt)
    {
        $penjualan = Penjualan::where('id_inventaris_penjualan', $idEncrypt)->first();
        $penawar = Penawar::where('id_inventaris_penjualan', $penjualan->id_inventaris_penjualan)->get();
        $pdf = Pdf::loadView(
            'Page.Inventaris_penjualan.print',
            compact('penjualan', 'penawar'),
            ['title' => 'Print']
        );
        $pdf->setPaper('A4', 'potrait')
            ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);
        return $pdf->stream('Data Form.' . $penjualan->kode_form . '.pdf');
    }


    // RESPON APPROVE STATUS PENGAJUAN
    public function ResponApprove(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = Penjualan::where('id_inventaris_penjualan', $ids)->first();
        $jabatan = auth()->user()->jabatan;
        $nama = auth()->user()->nama;

        switch ($jabatan) {
            case 'Kasi Operasional':
                // file uploud
                $file = $request->file_detail_invoice;
                $fileName = $file->getClientOriginalName();
                $file->move('file_upload/Inventaris Jual', $fileName);

                $data->update([
                    'status_akhir' => 'Selesai',
                    'tgl_status_akhir' => now(),
                    'file_invoice_akhir' => $fileName,
                ]);
                break;

            case 'Pimpinan Cabang':
                # code...
                $data->update([
                    'nama_pincab' => $nama,
                    'status_pincab' => 'Approve',
                    'tgl_status_pincab' => now(),
                    'catatan_pincab' => $request->catatan,
                    'status_akhir' => 'Proses'
                ]);

                // Send Email Double
                $userPenerima = User::where('jabatan', 'Pembukuan')->get();
                // pemberitahuan database
                $url = route('inventaris-pengajuan.index');
                $title = 'Terdapat Form Pengajuan Baru!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
                break;

            case 'Pembukuan':
                if ($data->status_pincab != null) {
                    $data->update([
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Approve',
                        'tgl_status_pembukuan' => now(),
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Proses'
                    ]);
                } else {
                    $data->update([
                        'nama_pincab' => 'Ditarik Oleh User Pembukuan',
                        'status_pincab' => '--',
                        'tgl_status_pincab' => now(),
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Approve',
                        'tgl_status_pembukuan' => now(),
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Proses'
                    ]);
                }

                // Send Email Single
                $userPenerima = User::where('jabatan', 'Direktur Operasional')->first();

                // pemberitahuan database
                $url = route('inventaris-penjualan.index');
                $title = 'Terdapat Form Pengajuan Baru!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmail($data, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'Pembukuan')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('inventaris-penjualan.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            case 'Direktur Operasional':
            case 'Direktur Utama':
                $data->update([
                    'nama_dirut' => $nama,
                    'status_dirut' => 'Approve',
                    'tgl_status_dirut' => now(),
                    'catatan_dirops' => $request->catatan,
                    'status_akhir' => 'Proses',

                    // 'nama_dirut' => 'Eko Bambang Setiyoso',
                    // 'status_dirut' => 'Approve',
                    // 'tgl_status_dirut' => now()->addMinutes(rand(0, 60)),
                ]);

                $userPenerima = User::where('jabatan', 'Kasi Operasional')->first();

                // pemberitahuan database
                $status_akhir = 'Approved';
                $url = route('inventaris-penjualan.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Approved!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                break;
        }

        // Log Activity
        $LogAksi = '(cs) Approve Pengajuan Penjualan Inventaris';
        $this->LogActivity($data, $LogAksi);

        return redirect('inventaris-penjualan')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
    }


    // RESPON Reject STATUS PENGAJUAN
    public function ResponReject(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = Penjualan::where('id_inventaris_penjualan', $ids)->first();
        $jabatan = auth()->user()->jabatan;
        $nama = auth()->user()->nama;

        switch ($jabatan) {
            case 'Pimpinan Cabang':
                $data->update([
                    'nama_pincab' => $nama,
                    'status_pincab' => 'Reject',
                    'tgl_status_pincab' => now(),
                    'catatan_pincab' => $request->catatan,
                    'status_akhir' => 'Ditolak',
                    'tgl_status_akhir' => now(),
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('inventaris-penjualan.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                break;

            case 'Pembukuan':
                if ($data->status_pincab != null) {
                    $data->update([
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Reject',
                        'tgl_status_pembukuan' => now(),
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Ditolak',
                        'tgl_status_akhir' => now(),
                    ]);
                } else {
                    $data->update([
                        'nama_pincab' => 'Ditarik Oleh User Pembukuan',
                        'status_pincab' => '--',
                        'tgl_status_pincab' => now(),
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Reject',
                        'tgl_status_pembukuan' => now(),
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Ditolak',
                        'tgl_status_akhir' => now(),
                    ]);
                }
                /// Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('inventaris-penjualan.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'Pembukuan')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('inventaris-penjualan.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            case 'Direktur Operasional':
            case 'Direktur Dirut':
                $data->update([
                    'nama_dirut' => $nama,
                    'status_dirut' => 'Reject',
                    'tgl_status_dirut' => now(),
                    'catatan_dirops' => $request->catatan,
                    'status_akhir' => 'Ditolak',
                    'tgl_status_akhir' => now(),
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('inventaris-penjualan.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Rejected Pengajuan Penjualan Inventaris';
        $this->LogActivity($data, $LogAksi);

        return redirect('inventaris-penjualan')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
    }


    // ==============
    // button pada status data table index
    private function statusNothing($data)
    {
        $status = '';
        $status .= '<div class="dropdown">';
        $status .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $status .= 'Nothing';
        $status .= '</button>';
        $status .= '<div class="dropdown-menu" aria-labelledby="statusDropdown">';
        $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_inventaris_penjualan) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
        $status .= '<a class="dropdown-item reject" href="#" data-toggle="modal" data-target="#modalReject" data-id="' . encrypt($data->id_inventaris_penjualan) . '" data-kode_form="' . $data->kode_form . '">Reject</a>';
        $status .= '</div>';
        $status .= '</div>';
        return $status;
    }


    private function statusAfter($data, $jabatan, $statusDropdown)
    {
        $status = '';
        if ($jabatan == 'Approve') {
            $status .= '<a class="btn btn-success btn-sm disabled">Approve</a>';
        } elseif ($jabatan == 'Reject') {
            $status .= '<a class="btn btn-danger btn-sm disabled">Reject</a>';
        } elseif ($jabatan == '--') {
            $status .= '<a class="btn btn-info btn-sm disabled">Ditarik</a>';
        } elseif ($jabatan == 'Not Needed') {
            $status .= '<a class="btn btn-info btn-sm disabled">NotNeeded</a>';
        } else {
            return $statusDropdown;
        }
        return $status;
    }

    // Log activity
    private function LogActivity($data, $LogAksi)
    {
        $log = new LogActivity();
        $log->id_cabang = auth()->user()->id_cabang;
        $log->nama = auth()->user()->nama;
        $log->email = auth()->user()->email;
        $log->level = auth()->user()->jabatan;
        $log->aksi = $LogAksi;
        $log->kode_form = $data->kode_form;
        $log->created_at = now();
        $log->save();
    }




    // Email single
    private function SendEmail($data, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-pengajuan',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Pengajuan Inventaris');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email single to kaops
    private function SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-status-akhir-inv',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan,
            'status_akhir' => $status_akhir,
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Status Pengajuan');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email single to user lainnya
    private function SendEmailToUserLain($data, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-dikerjakan',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->keperluan
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Status Pengajuan');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email Doubel
    private function SendEmailDobel($data, $userPenerima, $url, $title, $message)
    {
        foreach ($userPenerima as $user) {
            Mail::send('email.notif.notif-pengajuan',  [
                'nama' => $data->nama,
                'kc' => $data->cabang->cabang,
                'nik' => $data->nik,
                'kode_form' => $data->kode_form,
                'keperluan' => $data->keperluan
            ], function ($message) use ($user) {
                $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
                $message->to($user->email);
                $message->subject('Pengajuan Inventaris');
            });
        }
        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }
}
