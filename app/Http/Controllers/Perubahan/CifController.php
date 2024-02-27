<?php

namespace App\Http\Controllers\Perubahan;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\Perubahan\Cif;
use App\Models\User;
use App\Notifications\NotifikasiPengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CifController extends Controller
{
    public function index(Request $request)
    {
        $jabatan = Auth::user()->jabatan;
        $id_cabang = Auth::user()->id_cabang;
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();
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
                case 'Kepala Kantor Kas':
                case 'Pimpinan Cabang':
                    if (!empty($request->kode)) {
                        $data = Cif::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Cif::where('id_cabang', $id_cabang)
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Cif::where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                    # Pimpinan Cabang ...
                case 'Pembukuan':
                    if (!empty($request->kode)) {
                        $data = Cif::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Cif::whereIn('status_pincab', ['Approve', '--'])
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->get();
                        } elseif (!empty($request->cari)) {
                            $data = Cif::where('kode_form', $request->cari)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Cif::whereIn('status_pincab', ['Approve', '--'])
                                ->OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'Direktur Operasional':
                    if (!empty($request->kode)) {
                        $data = Cif::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Cif::where('status_pembukuan', "Edited")
                                ->orwhere('status_pembukuan', 'Approve')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Cif::where('status_pembukuan', 'Approve')->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'TSI':
                    if (!empty($request->kode)) {
                        $data = Cif::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Cif::where('status_dirops', 'Approve')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Cif::where('status_dirops', 'Approve')->orderBy('created_at', 'desc')->get();
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
                        case 'Kepala Kantor Kas':
                        case 'Kasi Komersial':
                            $status .= '<a class="btn btn-success btn-sm disabled">Terkirim</a>';
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
                            $jabatan = $data->status_dirops;
                            $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;

                        case 'TSI':
                            $jabatan = $data->status_tsi;
                            $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;
                    }

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id_cif . '" id="' . $data->id_cif . '"
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
                        case 'Kepala Kantor Kas':
                            if ($data->status_pincab == "Approve" || $data->status_pincab == "Reject") {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_cif . '" id="' . $data->id_cif . '"
                                                class="btn btn-warning btn-sm edit" data-kode_form="' . $data->kode_form . '">
                                            <i class="fa fa-edit"></i></a>';
                                $button .= '&nbsp;';
                            }
                            break;
                            # Pincab...
                        case 'Pimpinan Cabang':
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                            # SDM, Dirops & TSi...
                        case 'Pembukuan':
                        case 'Direktur Operasional':
                        case 'TSI':
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                    }
                    return $button;
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('Page.Perubahan.MasterCif.index', ['title' => 'Perubahan Transaksi Master CIF']);
    }


    public function create()
    {
        //
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
            $cek = Cif::count();
        }

        if ($cek == 0) {
            $urut = 0001;
            $nomer = $cabang . '/PRT-CIF/' . $thn . '/0001';
        } else {
            $ambil = Cif::all()->last();
            $cekTahun = substr($ambil->kode_form, -9, 4);
            if ($cekTahun != $thn) {
                $urut = 0001;
                $nomer = $cabang . '/PRT-CIF/' . $thn . '/0001';
            } else {
                $urut = substr($ambil->kode_form, -4, 10);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 4, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $cabang . '/PRT-CIF/' . $thn . '/' . $urut;
            }
        }

        $data = new Cif();
        $data->kode_form = $nomer;
        $data->id_cabang = auth()->user()->id_cabang;
        $data->nama_kaops = auth()->user()->nama;
        $data->jns_cif = $request->jns_cif;
        $data->no_cif_utama = $request->no_cif_utama;
        $data->nama_nasabah = $request->nama_nasabah;

        if ($request->jns_cif == 'Merger CIF') {
            $data->alasan = $request->alasan;
            $gambar = $request->file('ktp');
            $fileName = $gambar->getClientOriginalName();
            $gambar->move('file_upload/perubahan data', $fileName);
            $data->ktp = $fileName;
            $data->nama_ibu = $request->nama_ibu;

            switch ($request) {
                case $request->no_cif_merger_5 != '':
                    $data->no_cif_merger = $request->no_cif_merger_1 . ', ' . $request->no_cif_merger_2
                        . ', ' . $request->no_cif_merger_3 . ', ' . $request->no_cif_merger_5;
                    break;
                case $request->no_cif_merger_4 != '':
                    $data->no_cif_merger = $request->no_cif_merger_1 . ', ' . $request->no_cif_merger_2
                        . ', ' . $request->no_cif_merger_3 . ', ' . $request->no_cif_merger_4;
                    break;
                case $request->no_cif_merger_3 != '':
                    $data->no_cif_merger = $request->no_cif_merger_1 . ', ' . $request->no_cif_merger_2
                        . ', ' . $request->no_cif_merger_3;
                    break;
                case $request->no_cif_merger_2 != '':
                    $data->no_cif_merger = $request->no_cif_merger_1 . ', ' . $request->no_cif_merger_2;
                    break;
                case $request->no_cif_merger_1 != '':
                    $data->no_cif_merger = $request->no_cif_merger_1;
                    break;
            }
        } else {
            $gambar = $request->file('ktp');
            $fileName = $gambar->getClientOriginalName();
            $gambar->move('file_upload/perubahan data', $fileName);
            $data->ktp = $fileName;
            $data->nama_ibu = $request->nama_ibu;
            $data->alasan = '-';
            $data->no_cif_merger = '-';
        }

        $data->keterangan = $request->keterangan;
        $data->created_at = now();
        $data->save();

        // Log Activity
        $LogAksi = '(+) Pengajuan Perubahan Transaksi CIF';
        $this->LogActivity($data, $LogAksi);
        // Send Email
        $userPenerima = User::where('id_cabang', auth()->user()->id_cabang)
            ->where('jabatan', 'Pimpinan Cabang')->first();
        $url = route('perubahan-cif.index');
        $title = 'Terdapat Form Pengajuan Baru!';
        $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
        $this->SendEmail($data, $userPenerima, $url, $title, $message);

        return redirect('perubahan-cif')->with('AlertSuccess', "Pengajuan Perubahan Transaksi Berhasil Dikirim!");
    }


    public function show(Cif $cif)
    {
        return view('Page.Perubahan.MasterCif.show', compact('cif'), ['title' => 'Show Data']);
    }


    public function edit(Cif $cif)
    {
        return response()->json([
            'status' => 200,
            'data' => $cif
        ]);
    }


    public function update(Request $request, Cif $cif)
    {
        $cif->jns_cif = $request->jns_cif;
        $cif->no_cif_utama = $request->no_cif_utama;
        $cif->nama_nasabah = $request->nama_nasabah;

        if ($request->jns_cif == 'Merger CIF') {
            $cif->alasan = $request->alasan;
            $cif->nama_ibu = '-';
            $cif->ktp = '-';
            $cif->no_cif_merger = $request->no_cif_merger;
        } else {
            if ($cif->ktp == $request->ktp) {
                $cif->ktp = $cif->ktp;
            } else {
                $gambar = $request->file('ktp');
                $fileName = $gambar->getClientOriginalName();
                $gambar->move('file_upload/perubahan data', $fileName);
                $cif->ktp = $fileName;
            }

            $cif->nama_ibu = $request->nama_ibu;
            $cif->alasan = '-';
            $cif->no_cif_merger = '-';
        }

        $cif->keterangan = $request->keterangan;
        $cif->updated_at = now();
        $cif->save();

        // Log Activity
        $LogAksi = '(+) Update Perubahan Transaksi CIF';
        $this->LogActivity($cif, $LogAksi);

        return redirect('perubahan-cif')->with('AlertSuccess', "Pengajuan Perubahan Transaksi Berhasil Di Edit!");
    }


    public function destroy(Cif $cif)
    {
        //
    }




    // RESPON APPROVE STATUS PENGAJUAN
    public function ResponApprove(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = Cif::where('id_cif', $ids)->first();
        $jabatan = auth()->user()->jabatan;
        $nama = auth()->user()->nama;

        switch ($jabatan) {
            case 'Pimpinan Cabang':
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
                $url = route('perubahan-cif.index');
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
                        'pelanggaran_pembukuan' => $request->pelanggaran,
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
                        'pelanggaran_pembukuan' => $request->pelanggaran,
                        'status_akhir' => 'Proses'
                    ]);
                }
                // Send Email Single
                $userPenerima = User::where('jabatan', 'Direktur Operasional')->first();
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Terdapat Form Pengajuan Baru!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmail($data, $userPenerima, $url, $title, $message);
                // send email untuk user satunya

                $userPenerima = User::where('jabatan', 'Pembukuan')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            case 'Direktur Operasional':
                $data->update([
                    'nama_dirops' => $nama,
                    'status_dirops' => 'Approve',
                    'tgl_status_dirops' => now(),
                    'catatan_dirops' => $request->catatan,
                    'pelanggaran_dirops' => $request->pelanggaran,
                    'status_akhir' => 'Proses'
                ]);
                // Send Email Double
                $userPenerima = User::where('jabatan', 'TSI')->get();
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Terdapat Form Pengajuan Baru!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
                break;

            case 'TSI':
                $data->update([
                    'nama_tsi' => $nama,
                    'status_tsi' => 'Approve',
                    'tgl_status_tsi' => now(),
                    'catatan_tsi' => $request->catatan,
                    'tgl_status_akhir' => now(),
                    'status_akhir' => 'Selesai'
                ]);
                // Send Email Single to Kaops cabang
                $status_akhir = 'Approved';
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Approved!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Approve Pengajuan Perubahan Transaksi (CIF)';
        $this->LogActivity($data, $LogAksi);

        return redirect('perubahan-cif')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
    }


    // RESPON Reject STATUS PENGAJUAN
    public function ResponReject(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = Cif::where('id_cif', $ids)->first();
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
                    'tgl_status_akhir' => now()
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('perubahan-cif.index');
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
                        'pelanggaran_pembukuan' => $request->pelanggaran,
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Ditolak',
                        'tgl_status_akhir' => now()
                    ]);
                } else {
                    $data->update([
                        'nama_pincab' => 'Ditarik Oleh User Pembukuan',
                        'status_pincab' => '--',
                        'tgl_status_pincab' => now(),
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Reject',
                        'tgl_status_pembukuan' => now(),
                        'pelanggaran_pembukuan' => $request->pelanggaran,
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Ditolak',
                        'tgl_status_akhir' => now()
                    ]);
                }
                /// Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'Pembukuan')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            case 'Direktur Operasional':
                $data->update([
                    'nama_dirops' => $nama,
                    'status_dirops' => 'Reject',
                    'tgl_status_dirops' => now(),
                    'pelanggaran_dirops' => $request->pelanggaran,
                    'catatan_dirops' => $request->catatan,
                    'status_akhir' => 'Ditolak',
                    'tgl_status_akhir' => now()
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);
                break;

            case 'TSI':
                $data->update([
                    'nama_tsi' => $nama,
                    'status_tsi' => 'Reject',
                    'tgl_status_tsi' => now(),
                    'catatan_tsi' => $request->catatan,
                    'tgl_status_akhir' => now(),
                    'status_akhir' => 'Ditolak',
                    'tgl_status_akhir' => now()
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('perubahan-cif.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Rejected Pengajuan Perubahan Transaksi (CIF)';
        $this->LogActivity($data, $LogAksi);

        return redirect('perubahan-cif')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
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
        $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_cif) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
        $status .= '<a class="dropdown-item reject" href="#" data-toggle="modal" data-target="#modalReject" data-id="' . encrypt($data->id_cif) . '" data-kode_form="' . $data->kode_form . '">Reject</a>';
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
            $status .= '<a class="btn btn-success btn-sm disabled">Ditarik</a>';
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
            'keperluan' => "Perubahan Transaksi (CIF)"
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Pengajuan Perubahan Transaksi (CIF)');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email single to kaops
    private function SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-status-akhir',  [
            'nama' => $data->nama,
            'kc' => $data->cabang->cabang,
            'nik' => $data->nik,
            'kode_form' => $data->kode_form,
            'keperluan' => "Perubahan Transaksi (CIF)",
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
            'keperluan' => "Perubahan Transaksi (CIF)"
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
                'keperluan' => "Perubahan Transaksi (CIF)"
            ], function ($message) use ($user) {
                $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
                $message->to($user->email);
                $message->subject('Pengajuan Perubahan Transaksi (CIF)');
            });
        }
        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }
}
