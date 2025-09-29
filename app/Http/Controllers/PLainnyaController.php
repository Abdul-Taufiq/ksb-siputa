<?php

namespace App\Http\Controllers;

use App\Models\Inventaris\BarangBaru;
use App\Models\PLainnya;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotifikasiPengajuan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\LogActivity;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;



class PLainnyaController extends Controller
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
                        $data = PLainnya::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = PLainnya::where('id_cabang', $id_cabang)
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = PLainnya::where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                # Pimpinan Cabang ...
                case 'Pembukuan':
                case 'Internal Audit':
                    if (!empty($request->kode)) {
                        $data = PLainnya::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = PLainnya::whereIn('status_pincab', ['Approve', '--'])
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->get();
                        } elseif (!empty($request->cari)) {
                            $data = PLainnya::where('kode_form', $request->cari)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = PLainnya::whereIn('status_pincab', ['Approve', '--'])
                                ->OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'Direktur Operasional':
                case 'Direktur Utama':
                    if (!empty($request->kode)) {
                        $data = PLainnya::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = PLainnya::where('status_pembukuan', "Edited")
                                ->orwhere('status_pembukuan', 'Approve')
                                ->orwhere('status_tsi', '--')
                                ->orwhere('status_tsi', 'Not Needed')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = PLainnya::where('status_pembukuan', 'Approve')->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'TSI':
                    if (!empty($request->kode)) {
                        $data = PLainnya::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = PLainnya::where('status_dirut', 'Approve')
                                ->orWhere('status_pembukuan', 'Approve')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = PLainnya::where('status_dirut', 'Approve')->orWhere('status_pembukuan', 'Approve')->orderBy('created_at', 'desc')->get();
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
                            break;

                        case 'Direktur Utama':
                            switch ($data->jns_pengajuan) {
                                case 'Upgrade Bandwidth WIFI':
                                    if ($data->status_tsi != null) {
                                        $jabatan = $data->status_dirut;
                                        $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                                        return $statusAfter;
                                    } else {
                                        $status .= '<a class="btn btn-warning btn-sm disabled">NotYet</a>';
                                    }
                                    break;
                                case 'Ganti Provider WIFI':
                                    if ($data->status_tsi != null) {
                                        $jabatan = $data->status_dirut;
                                        $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                                        return $statusAfter;
                                    } else {
                                        $status .= '<a class="btn btn-warning btn-sm disabled">NotYet</a>';
                                    }
                                    break;

                                default:
                                    $jabatan = $data->status_dirut;
                                    $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                                    return $statusAfter;
                                    break;
                            }
                            break;

                        case 'TSI':
                            $jabatan = $data->status_tsi;
                            switch ($data->jns_pengajuan) {
                                case 'Upgrade Bandwidth WIFI':
                                    if ($data->status_pembukuan == 'Approve') {
                                        $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                                        return $statusAfter;
                                    } else {
                                        $status .= '<a class="btn btn-warning btn-sm disabled">NotYet</a>';
                                    }
                                    break;
                                case 'Ganti Provider WIFI':
                                    if ($data->status_pembukuan == 'Approve') {
                                        $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                                        return $statusAfter;
                                    } else {
                                        $status .= '<a class="btn btn-warning btn-sm disabled">NotYet</a>';
                                    }
                                    break;

                                default:
                                    $status .= '<a class="btn btn-warning btn-sm disabled">NotNeed</a>';
                                    break;
                            }
                            break;
                    }

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id . '" id="' . $data->id . '"
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
                            if ($data->status_pincab != null) {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id . '" id="' . $data->id . '"
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

        return view('Page.Lainnya.index', ['title' => 'Pengajuan Lainnya']);
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
            $cek = PLainnya::count();
        }

        if ($cek == 0) {
            $urut = 0001;
            $nomer = $cabang . '/P-LAINY/' . $thn . '/0001';
        } else {
            $ambil = PLainnya::all()->last();
            $cekTahun = substr($ambil->kode_form, -9, 4);
            if ($cekTahun != $thn) {
                $urut = 0001;
                $nomer = $cabang . '/P-LAINY/' . $thn . '/0001';
            } else {
                $urut = substr($ambil->kode_form, -4, 10);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 4, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $cabang . '/P-LAINY/' . $thn . '/' . $urut;
            }
        }


        $data = new PLainnya();
        $data->id_cabang = auth()->user()->id_cabang;
        $data->nama_kaops = auth()->user()->nama;
        $data->kode_form = $nomer;
        $data->jns_pengajuan = $request->jns_pengajuan;
        $data->detail_kerusakan = $request->detail_kerusakan;
        $data->detail_diharapkan = $request->detail_diharapkan;
        $data->keterangan = $request->keterangan;
        $data->status_akhir = 'Created';
        if ($request->file_pendukung != null) {
            $file = $request->file('file_pendukung');
            $fileName = $file->getClientOriginalName();
            $file->move('file_upload/lainnya', $fileName);
            $data->file_pendukung = $fileName;
        }
        $data->save();

        // Log Activity
        $LogAksi = '(+) Pengajuan Lainnya kode = ' . $data->kode_form;
        $this->LogActivity($data, $LogAksi);
        // Send Email
        $userPenerima = User::where('id_cabang', auth()->user()->id_cabang)
            ->where('jabatan', 'Pimpinan Cabang')->first();
        $url = route('pengajuan-lainnya.index');
        $title = 'Terdapat Form Pengajuan Baru!';
        $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
        $this->SendEmail($data, $userPenerima, $url, $title, $message);

        return redirect('pengajuan-lainnya')->with('AlertSuccess', "Pengajuan berhasil Dikirim!");
    }


    public function show(PLainnya $pLainnya)
    {
        return view('Page.Lainnya.show', compact('pLainnya'), ['title' => 'Show Data']);
    }


    public function edit(PLainnya $pLainnya)
    {
        return view('Page.Lainnya.modal-edit', compact('pLainnya'), ['title' => 'Edit Data']);
    }


    public function update(Request $request, PLainnya $pLainnya)
    {
        $pLainnya->jns_pengajuan = $request->jns_pengajuan;
        $pLainnya->detail_kerusakan = $request->detail_kerusakan;
        $pLainnya->detail_diharapkan = $request->detail_diharapkan;
        $pLainnya->keterangan = $request->keterangan;
        $pLainnya->status_akhir = 'Created';
        if ($request->file_pendukung != null) {
            if ($pLainnya->file_pendukung != $request->file_pendukung) {
                $file = $request->file('file_pendukung');
                $fileName = $file->getClientOriginalName();
                $file->move('file_upload/lainnya', $fileName);
                $pLainnya->file_pendukung = $fileName;
            }
        }
        $pLainnya->save();

        // Log Activity
        $LogAksi = '(u) Pengajuan Lainnya kode = ' . $pLainnya->kode_form;
        $this->LogActivity($pLainnya, $LogAksi);
        return redirect('pengajuan-lainnya')->with('AlertSuccess', "Pengajuan berhasil Diubah!");
    }


    public function destroy(PLainnya $pLainnya)
    {
        //
    }


    public function getBarang($id)
    {
        $ids = Crypt::decrypt($id);

        $data = BarangBaru::where('id_inventaris_baru', $ids)->get();

        dd($data);
    }





    // RESPON APPROVE STATUS PENGAJUAN
    public function ResponApprove(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = PLainnya::where('id', $ids)->first();
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
                $url = route('pengajuan-lainnya.index');
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
                // khusus 
                switch ($data->jns_pengajuan) {
                    case 'Upgrade Bandwidth WIFI':
                        $userPenerima = User::where('jabatan', 'TSI')->get();

                        // pemberitahuan database
                        $url = route('pengajuan-lainnya.index');
                        $title = 'Terdapat Form Pengajuan Baru!';
                        $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                        $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);

                        // send email untuk user satunya
                        $userPenerima = User::where('jabatan', 'Pembukuan')
                            ->where('nama', '!=', $nama)->first();
                        // pemberitahuan database
                        $url = route('pengajuan-lainnya.index');
                        $title = 'Pengajuan Sudah Dikerjakan!';
                        $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                        $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                        break;

                    case 'Ganti Provider WIFI':
                        $userPenerima = User::where('jabatan', 'TSI')->get();

                        // pemberitahuan database
                        $url = route('pengajuan-lainnya.index');
                        $title = 'Terdapat Form Pengajuan Baru!';
                        $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                        $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);

                        // send email untuk user satunya
                        $userPenerima = User::where('jabatan', 'Pembukuan')
                            ->where('nama', '!=', $nama)->first();
                        // pemberitahuan database
                        $url = route('pengajuan-lainnya.index');
                        $title = 'Pengajuan Sudah Dikerjakan!';
                        $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                        $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                        break;

                    default:
                        $data->update([
                            'nama_tsi' => 'Tidak Diperlukan',
                            'status_tsi' => 'Not Needed',
                            'tgl_status_tsi' => null,
                            'nama_tsi' => 'Tidak Diperlukan',
                        ]);

                        $userPenerima = User::where('jabatan', 'Direktur Operasional')->first();

                        // pemberitahuan database
                        $url = route('pengajuan-lainnya.index');
                        $title = 'Terdapat Form Pengajuan Baru!';
                        $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                        $this->SendEmail($data, $userPenerima, $url, $title, $message);

                        // send email untuk user satunya
                        $userPenerima = User::where('jabatan', 'Pembukuan')
                            ->where('nama', '!=', $nama)->first();
                        // pemberitahuan database
                        $url = route('pengajuan-lainnya.index');
                        $title = 'Pengajuan Sudah Dikerjakan!';
                        $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                        $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                        break;
                }

                break;

            case 'Direktur Operasional':
            case 'Direktur Utama':
                $data->update([
                    'nama_dirut' => $nama,
                    'status_dirut' => 'Approve',
                    'tgl_status_dirut' => now(),
                    'catatan_dirops' => $request->catatan,
                    'tgl_status_akhir' => now(),
                    'status_akhir' => 'Selesai',
                ]);

                if ($data->id_cabang == 0) {
                    # code...
                    $userPenerima = User::where('jabatan', 'Sekretariat')->first();
                } else {
                    # code...
                    $userPenerima = User::where('jabatan', 'Kasi Operasional')->first();
                }

                // pemberitahuan database
                $status_akhir = 'Approved';
                $url = route('pengajuan-lainnya.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Approved!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);
                break;

            case 'TSI':
                $data->update([
                    'nama_tsi' => $nama,
                    'status_tsi' => 'Approve',
                    'tgl_status_tsi' => now(),
                    'catatan_tsi' => $request->catatan
                ]);
                $userPenerima = User::where('jabatan', 'Direktur Operasional')->first();

                // pemberitahuan database
                $status_akhir = 'Approved';
                $url = route('pengajuan-lainnya.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('pengajuan-lainnya.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Approve Pengajuan Lainnya dgn kode = ' . $data->kode_form;
        $this->LogActivity($data, $LogAksi);

        return redirect('pengajuan-lainnya')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
    }


    // RESPON Reject STATUS PENGAJUAN
    public function ResponReject(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = PLainnya::where('id', $ids)->first();
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
                $url = route('pengajuan-lainnya.index');
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
                $url = route('pengajuan-lainnya.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'Pembukuan')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('pengajuan-lainnya.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            case 'Direktur Operasional':
            case 'Direktur Utama':
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
                $url = route('pengajuan-lainnya.index');
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
                    'tgl_status_akhir' => now(),
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('pengajuan-lainnya.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('pengajuan-lainnya.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Rejected Pengajuan Lainnya dgn kode = ' . $data->kode_form;
        $this->LogActivity($data, $LogAksi);

        return redirect('pengajuan-lainnya')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
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
        $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
        $status .= '<a class="dropdown-item reject" href="#" data-toggle="modal" data-target="#modalReject" data-id="' . encrypt($data->id) . '" data-kode_form="' . $data->kode_form . '">Reject</a>';
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
            $status .= '<a class="btn btn-danger btn-sm disabled">NotNeeded</a>';
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
        Mail::send('email.notif.notif-pengajuan-lainnya',  [
            'kc' => $data->cabang->cabang,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->jns_pengajuan
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Pengajuan Lainnya');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email single to kaops
    private function SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-status-akhir-inv',  [
            'kc' => $data->cabang->cabang,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->jns_pengajuan,
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
        Mail::send('email.notif.notif-dikerjakan-inv',  [
            'kc' => $data->cabang->cabang,
            'kode_form' => $data->kode_form,
            'keperluan' => $data->jns_pengajuan
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
            Mail::send('email.notif.notif-pengajuan-lainnya',  [
                'kc' => $data->cabang->cabang,
                'kode_form' => $data->kode_form,
                'keperluan' => $data->jns_pengajuan
            ], function ($message) use ($user) {
                $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
                $message->to($user->email);
                $message->subject('Pengajuan Lainnya');
            });
        }
        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }
}
