<?php

namespace App\Http\Controllers\TSI;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\TSI\BantuanTSI;
use App\Models\TSI\PemeliharaanHistory;
use App\Models\User;
use App\Notifications\NotifikasiPengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class BantuanTSIController extends Controller
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
            # code pembagian user
            switch ($jabatan) {
                case 'Kasi Operasional':
                case 'Kasi Komersial':
                case 'Kepala Kantor Kas':
                case 'Pimpinan Cabang':
                case 'Analis Area':
                case 'Staf Area':
                    if (!empty($request->kode)) {
                        $data = BantuanTSI::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = BantuanTSI::where('id_cabang', $id_cabang)
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->get();
                        } else {
                            $data = BantuanTSI::where('id_cabang', $id_cabang)
                                ->OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;

                case 'Pembukuan':
                case 'Internal Audit':
                    if (!empty($request->kode)) {
                        $data = BantuanTSI::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = BantuanTSI::whereIn('status_pincab', ['Approve', '--', 'Ditarik'])
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->get();
                        } elseif (!empty($request->cari)) {
                            $data = BantuanTSI::where('kode_form', $request->cari)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = BantuanTSI::whereIn('status_pincab', ['Approve', '--', 'Ditarik'])
                                ->OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;

                case 'SDM':
                    if (!empty($request->kode)) {
                        $data = BantuanTSI::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = BantuanTSI::whereIn('status_pembukuan', ['Approve', '--', 'Ditarik'])
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->get();
                        } elseif (!empty($request->cari)) {
                            $data = BantuanTSI::where('kode_form', $request->cari)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = BantuanTSI::whereIn('status_pembukuan', ['Approve', '--', 'Ditarik'])
                                ->OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;

                case 'Direktur Operasional':
                    if (!empty($request->kode)) {
                        $data = BantuanTSI::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = BantuanTSI::where('status_sdm', 'Approve')->whereBetween('created_at', [$awal, $akhir])
                                ->get();
                        } else {
                            $data = BantuanTSI::where('status_sdm', 'Approve')->OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;

                case 'TSI':
                    if (!empty($request->kode)) {
                        $data = BantuanTSI::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = BantuanTSI::where('status_sdm', 'Approve')->whereBetween('created_at', [$awal, $akhir])
                                ->get();
                        } else {
                            $data = BantuanTSI::where('status_sdm', 'Approve')->OrderBy('created_at', 'desc')->get();
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
                        case 'Kepala Kantor Kas':
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

                        case 'SDM':
                            $jabatan = $data->status_sdm;
                            $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;

                        case 'Direktur Operasional':
                            $status .= '<a class="btn btn-success btn-sm disabled">NotAct</a>';
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
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id_bantuan . '" id="' . $data->id_bantuan . '"
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
                            if ($data->status_pincab == "Approve" || $data->status_pincab == "Reject") {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_bantuan . '" id="' . $data->id_bantuan . '"
                                            class="btn btn-warning btn-sm edit" data-kode_form="' . $data->kode_form . '">
                                        <i class="fa fa-edit"></i></a>';
                                $button .= '&nbsp;';
                            }
                            break;
                            # area...
                        case 'Analis Area':
                        case 'Staf Area':
                            if ($data->status_sdm != null) {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a href="/tsi-permohonan/' . $data->id_bantuan . '/edit" data-toggle="tooltip" 
                                        data-original-title="Edit" class="edit btn btn-warning btn-sm edit-post">
                                        <i class="fa fa-edit"></i></a>';
                                $button .= '&nbsp;';
                            }
                            break;
                            # Pincab...
                        case 'Pimpinan Cabang':
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                            # SDM, Dirops & TSi...
                        case 'SDM':
                        case 'Direktur Operasional':
                        case 'TSI':
                        case 'Pembukuan':
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                    }
                    return $button;
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('Page.BantuanTSI.index', ['title' => 'Permohonan Bantuan TSI']);
    }



    public function create()
    {
        //
    }



    public function store(Request $request)
    {
        // NEW INPUT
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
            $cek = BantuanTSI::count();
        }

        if ($cek == 0) {
            $urut = 0001;
            $nomer = $cabang . '/TSI-BNT/' . $thn . '/0001';
        } else {
            $ambil = BantuanTSI::all()->last();
            $cekTahun = substr($ambil->kode_form, -9, 4);
            if ($cekTahun != $thn) {
                $urut = 0001;
                $nomer = $cabang . '/TSI-BNT/' . $thn . '/0001';
            } else {
                $urut = substr($ambil->kode_form, -4, 10);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 4, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $cabang . '/TSI-BNT/' . $thn . '/' . $urut;
            }
        }

        $data = new BantuanTSI();
        $data->kode_form = $nomer;
        $data->id_cabang = auth()->user()->id_cabang;
        $data->nama_kaops = auth()->user()->nama;
        $data->detail_permasalahan = $request->detail_permasalahan;
        $data->save();

        // Log Activity
        $LogAksi = '(+) Pengajuan Permohonan Bantuan TSI';
        $this->LogActivity($data, $LogAksi);

        // Send Email
        if (auth()->user()->jabatan == 'Analis Area' || auth()->user()->jabatan == 'Staf Area') {
            $data->update([
                'nama_pincab' => 'Ditarik',
                'status_pincab' => '--',
                'tgl_status_pincab' => null,
            ]);

            $userPenerima = User::where('jabatan', 'Pembukuan')->where('nama', 'Sigid Setiyawan')->first();
            $url = route('user-email-pengajuan.index');
            $title = 'Terdapat Form Pengajuan Baru!';
            $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
            $this->SendEmail($data, $userPenerima, $url, $title, $message);
        } else {
            $userPenerima = User::where('id_cabang', auth()->user()->id_cabang)
                ->where('jabatan', 'Pimpinan Cabang')->first();
            $url = route('user-email-pengajuan.index');
            $title = 'Terdapat Form Pengajuan Baru!';
            $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
            $this->SendEmail($data, $userPenerima, $url, $title, $message);
        }

        return redirect('tsi-permohonan')->with('AlertSuccess', "Pengajuan Berhasil Dikirimkan!");
    }



    public function show(BantuanTSI $bantuanTSI)
    {
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        return view('Page.BantuanTSI.show', compact('bantuanTSI'));
    }



    public function edit(BantuanTSI $bantuanTSI)
    {
        return response()->json([
            'status' => 200,
            'data' => $bantuanTSI
        ]);
    }



    public function update(Request $request, BantuanTSI $bantuanTSI)
    {
        $bantuanTSI->detail_permasalahan = $request->detail_permasalahan_edit;
        $bantuanTSI->updated_at = now();
        $bantuanTSI->save();

        // Log Activity
        $LogAksi = '(u) Pengajuan Permohonan Bantuan TSI';
        $data = $bantuanTSI;
        $this->LogActivity($data, $LogAksi);

        return redirect('tsi-permohonan')->with('AlertSuccess', "Data Berhasil Diupdate!");
    }



    public function destroy(BantuanTSI $bantuanTSI)
    {
        //
    }





    // RESPON APPROVE STATUS PENGAJUAN
    public function ResponApprove(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = BantuanTSI::where('id_bantuan', $ids)->first();
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
                $userPenerima = User::where('jabatan', 'Pembukuan')->where('nama', 'Sigid Setiyawan')->first();
                $url = route('user-email-pengajuan.index');
                $title = 'Terdapat Form Pengajuan Baru!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmail($data, $userPenerima, $url, $title, $message);
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
                        'nama_pincab' => 'Ditarik Oleh User pembukuan',
                        'status_pincab' => '--',
                        'tgl_status_pincab' => now(),
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Approve',
                        'tgl_status_pembukuan' => now(),
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Proses'
                    ]);
                }

                // Send Email Double
                $userPenerima = User::where('jabatan', 'SDM')->get();
                // pemberitahuan database
                $url = route('tsi-permohonan.index');
                $title = 'Terdapat Form Pengajuan Baru!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
                break;

            case 'SDM':
                $data->update([
                    'nama_sdm' => $nama,
                    'status_sdm' => 'Approve',
                    'tgl_status_sdm' => now(),
                    'catatan_sdm' => $request->catatan,
                    'status_akhir' => 'Proses'
                ]);
                // Send Email Double
                $userPenerima = User::where('jabatan', 'TSI')->get();
                // pemberitahuan database0
                $url = route('tsi-permohonan.index');
                $title = 'Terdapat Form Pengajuan Baru!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'SDM')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('tsi-permohonan.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            case 'TSI':
                $data->update([
                    'nama_tsi' => $nama,
                    'status_tsi' => 'Approve',
                    'tgl_status_tsi' => now(),
                    'catatan_tsi' => $request->catatan,
                    'tgl_status_akhir' => now(),
                    'status_akhir' => 'Selesai',
                    'detail_kerusakan' => $request->detail_kerusakan,
                    'detail_perbaikan' => $request->detail_perbaikan,
                    'tgl_pelaksanaan' => now()
                ]);

                $history = new PemeliharaanHistory();
                $history->id_cabang = $data->id_cabang;
                $history->kode_inventaris = $request->kode_inventaris;
                $history->detail_kerusakan = $request->detail_kerusakan;
                $history->detail_perbaikan = $request->detail_perbaikan;
                $history->tgl_dilaksanakan =  now();
                $history->save();

                // Send Email Single to Kaops cabang
                $status_akhir = 'Approved';
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                // pemberitahuan database
                $url = route('tsi-permohonan.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Approved!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('tsi-permohonan.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Approve Permohonan Bantuan TSI';
        $this->LogActivity($data, $LogAksi);

        return redirect('tsi-permohonan')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
    }


    // RESPON Reject STATUS PENGAJUAN
    public function ResponReject(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = BantuanTSI::where('id_bantuan', $ids)->first();
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
                $url = route('tsi-permohonan.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                break;

            case 'SDM':
                if ($data->status_pincab != null) {
                    $data->update([
                        'nama_sdm' => $nama,
                        'status_sdm' => 'Reject',
                        'tgl_status_sdm' => now(),
                        'catatan_sdm' => $request->catatan,
                        'status_akhir' => 'Ditolak',
                        'tgl_status_akhir' => now(),
                    ]);
                } else {
                    $data->update([
                        'nama_pincab' => 'Ditarik Oleh User SDM',
                        'status_pincab' => '--',
                        'tgl_status_pincab' => now(),
                        'nama_sdm' => $nama,
                        'status_sdm' => 'Reject',
                        'tgl_status_sdm' => now(),
                        'catatan_sdm' => $request->catatan,
                        'status_akhir' => 'Ditolak',
                        'tgl_status_akhir' => now(),
                    ]);
                }
                /// Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('tsi-permohonan.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'SDM')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('tsi-permohonan.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            case 'Direktur Operasional':
                $data->update([
                    'nama_tsi' => $nama,
                    'status_tsi' => 'Reject',
                    'tgl_status_tsi' => now(),
                    'catatan_tsi' => $request->catatan,
                    'status_akhir' => 'Ditolak',
                    'tgl_status_akhir' => now(),
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('tsi-permohonan.index');
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
                $url = route('tsi-permohonan.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('tsi-permohonan.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Rejected Permohonan Bantuan TSI';
        $this->LogActivity($data, $LogAksi);

        return redirect('tsi-permohonan')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
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
        $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_bantuan) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
        $status .= '<a class="dropdown-item reject" href="#" data-toggle="modal" data-target="#modalReject" data-id="' . encrypt($data->id_bantuan) . '" data-kode_form="' . $data->kode_form . '">Reject</a>';
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
        } elseif ($jabatan == 'Ditarik') {
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
            'keperluan' => $data->keperluan
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Pengajuan User Baru (Email)');
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
            'keperluan' => $data->keperluan,
            'status_akhir' => $status_akhir,
            'pelanggaran' => '-'
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
                $message->subject('Pengajuan User Baru (Email)');
            });
        }
        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }
}
