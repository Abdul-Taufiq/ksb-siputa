<?php

namespace App\Http\Controllers\Pembatalan;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\Pembatalan\Akuntansi;
use App\Models\User;
use App\Notifications\NotifikasiPengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class AkuntansiController extends Controller
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
                case 'Kepala Kantor Kas':
                case 'Sekretariat':
                case 'Pimpinan Cabang':
                    if (!empty($request->kode)) {
                        $data = Akuntansi::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Akuntansi::where('id_cabang', $id_cabang)
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Akuntansi::where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                # Pimpinan Cabang ...
                case 'Pembukuan':
                case 'Internal Audit':
                    if (!empty($request->kode)) {
                        $data = Akuntansi::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Akuntansi::whereIn('status_pincab', ['Approve', '--'])
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->get();
                        } elseif (!empty($request->cari)) {
                            $data = Akuntansi::where('kode_form', $request->cari)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Akuntansi::whereIn('status_pincab', ['Approve', '--'])
                                ->OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'Direktur Operasional':
                    if (!empty($request->kode)) {
                        $data = Akuntansi::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Akuntansi::where('status_pembukuan', "SendedToDirops")
                                ->orwhere('status_pembukuan', 'Approve')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Akuntansi::where('status_pembukuan', "SendedToDirops")->orwhere('status_pembukuan', 'Approve')->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'TSI':
                    if (!empty($request->kode)) {
                        $data = Akuntansi::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Akuntansi::where('status_dirops', 'Approve')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Akuntansi::where('status_dirops', 'Approve')->orderBy('created_at', 'desc')->get();
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
                        case 'Kepala Kantor Kas':
                        case 'Sekretariat':
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
                            $status .= '<a class="btn btn-secondary btn-sm disabled">NotAct</a>';
                            break;
                    }

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id_akuntansi . '" id="' . $data->id_akuntansi . '"
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
                        case 'Sekretariat':
                            if ($data->status_pincab != null) {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_akuntansi . '" id="' . $data->id_akuntansi . '"
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

        return view('Page.Pembatalan.Akuntansi.index', ['title' => 'Pembatalan Transaksi Akuntansi']);
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
            $cek = Akuntansi::count();
        }

        if ($cek == 0) {
            $urut = 0001;
            $nomer = $cabang . '/BTT-AKS/' . $thn . '/0001';
        } else {
            $ambil = Akuntansi::all()->last();
            $cekTahun = substr($ambil->kode_form, -9, 4);
            if ($cekTahun != $thn) {
                $urut = 0001;
                $nomer = $cabang . '/BTT-AKS/' . $thn . '/0001';
            } else {
                $urut = substr($ambil->kode_form, -4, 10);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 4, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $cabang . '/BTT-AKS/' . $thn . '/' . $urut;
            }
        }

        $data = new Akuntansi();
        $data->kode_form = $nomer;
        $data->nama_kaops = auth()->user()->nama;
        $data->id_cabang = auth()->user()->id_cabang;
        $data->jns_akuntansi = $request->jns_akuntansi;
        $data->id_transaksi = $request->id_transaksi;
        $data->nominal = $request->nominal;
        $data->user = $request->user;
        $data->alasan = $request->alasan;
        $data->keterangan = $request->keterangan;
        $data->created_at = now();
        $data->save();

        // Log Activity
        $LogAksi = '(+) Pengajuan Pembatalan Transaksi Akuntansi';
        $this->LogActivity($data, $LogAksi);

        if (auth()->user()->jabatan == 'Sekretariat') {
            $data->update([
                'nama_pincab' => 'Ditarik Oleh User Pembukuan',
                'status_pincab' => '--',
                'tgl_status_pincab' => null,
            ]);

            $userPenerima = User::where('jabatan', 'Pembukuan')->get();
            $url = route('pembatalan-akuntansi.index');
            $title = 'Terdapat Form Pengajuan Baru!';
            $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
            $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
        } else {
            // Send Email
            $userPenerima = User::where('id_cabang', auth()->user()->id_cabang)
                ->where('jabatan', 'Pimpinan Cabang')->first();
            $url = route('pembatalan-akuntansi.index');
            $title = 'Terdapat Form Pengajuan Baru!';
            $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
            $this->SendEmail($data, $userPenerima, $url, $title, $message);
        }


        return redirect('pembatalan-akuntansi')->with('AlertSuccess', "Pengajuan Pembatalan Transaksi Berhasil Dikirim!");
    }


    public function show(Akuntansi $akuntansi)
    {
        return view('Page.Pembatalan.Akuntansi.show', compact('akuntansi'), ['title' => 'Show Data']);
    }


    public function edit(Akuntansi $akuntansi)
    {
        return response()->json([
            'status' => 200,
            'data' => $akuntansi
        ]);
    }


    public function update(Request $request, Akuntansi $akuntansi)
    {
        $akuntansi->jns_akuntansi = $request->jns_akuntansi;
        $akuntansi->id_transaksi = $request->id_transaksi;
        $akuntansi->nominal = $request->nominal;
        $akuntansi->user = $request->user;
        $akuntansi->alasan = $request->alasan;
        $akuntansi->keterangan = $request->keterangan;
        $akuntansi->updated_at = now();
        $akuntansi->save();

        // Log Activity
        $LogAksi = '(u) Edit Pengajuan Pembatalan Transaksi Akuntansi';
        $this->LogActivity($akuntansi, $LogAksi);

        return redirect('pembatalan-akuntansi')->with('AlertSuccess', "Pengajuan Pembatalan Transaksi Berhasil Di Edit!");
    }


    public function destroy(Akuntansi $akuntansi)
    {
        //
    }



    // RESPON APPROVE STATUS PENGAJUAN
    public function ResponApprove(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = Akuntansi::where('id_akuntansi', $ids)->first();
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
                // Log Activity
                $LogAksi = '(cs) Approve Pengajuan Pembatalan Transaksi (Akuntansi)';
                $this->LogActivity($data, $LogAksi);
                // Send Email Double
                $userPenerima = User::where('jabatan', 'Pembukuan')->get();
                // pemberitahuan database
                $url = route('pembatalan-akuntansi.index');
                $title = 'Terdapat Form Pengajuan Baru!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
                break;

            case 'Pembukuan':
                if ($data->status_pembukuan == null) {
                    if ($data->status_pincab != null) {
                        $data->update([
                            'nama_pembukuan' => $nama,
                            'status_pembukuan' => 'SendedToDirops',
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
                            'status_pembukuan' => 'SendedToDirops',
                            'tgl_status_pembukuan' => now(),
                            'catatan_pembukuan' => $request->catatan,
                            'pelanggaran_pembukuan' => $request->pelanggaran,
                            'status_akhir' => 'Proses'
                        ]);
                    }
                    // Log Activity
                    $LogAksi = '(cs) SendedToDirops Pengajuan Pembatalan Transaksi (Akuntansi)';
                    $this->LogActivity($data, $LogAksi);
                    // Send Email Single
                    $userPenerima = User::where('jabatan', 'Direktur Operasional')->first();
                    // pemberitahuan database
                    $url = route('pembatalan-akuntansi.index');
                    $title = 'Terdapat Form Pengajuan Baru!';
                    $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                    $this->SendEmail($data, $userPenerima, $url, $title, $message);
                    // send email untuk user satunya

                    $userPenerima = User::where('jabatan', 'Pembukuan')
                        ->where('nama', '!=', $nama)->first();
                    // pemberitahuan database
                    $url = route('pembatalan-akuntansi.index');
                    $title = 'Pengajuan Sudah Dikerjakan!';
                    $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                    $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                } else {
                    $data->update([
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Approve',
                        'tgl_status_pembukuan' => now(),
                        'status_akhir' => 'Selesai',
                        'tgl_status_akhir' => now(),
                    ]);
                    // Log Activity
                    $LogAksi = '(cs) Approve Pengajuan Pembatalan Transaksi (Akuntansi)';
                    $this->LogActivity($data, $LogAksi);
                    // Send Email Single to Kaops cabang
                    $status_akhir = 'Approved';
                    $userPenerima = User::where('jabatan', 'Kasi Operasional')->first();
                    // pemberitahuan database
                    $url = route('pembatalan-akuntansi.index');
                    $title = 'Pengajuan Telah Selesai!';
                    $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Approved!';
                    $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);
                    // send email untuk user satunya

                    $userPenerima = User::where('jabatan', 'Pembukuan')
                        ->where('nama', '!=', $nama)->first();
                    // pemberitahuan database
                    $url = route('pembatalan-akuntansi.index');
                    $title = 'Pengajuan Sudah Dikerjakan!';
                    $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                    $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                }
                break;

            case 'Direktur Operasional':
                $data->update([
                    'nama_dirops' => $nama,
                    'status_dirops' => 'Approve',
                    'tgl_status_dirops' => now(),
                    'catatan_dirops' => $request->catatan,
                    'pelanggaran_dirops' => $request->pelanggaran,
                    'status_akhir' => 'Proses',

                    'nama_dirut' => 'Eko Bambang Setiyoso',
                    'status_dirut' => 'Approve',
                    'tgl_status_dirut' => now()->addMinutes(rand(0, 60)),
                ]);
                // Log Activity
                $LogAksi = '(cs) Approve Pengajuan Pembatalan Transaksi (Akuntansi)';
                $this->LogActivity($data, $LogAksi);
                // Send Email Double
                $userPenerima = User::where('jabatan', 'Pembukuan')->get();
                // pemberitahuan database
                $url = route('pembatalan-akuntansi.index');
                $title = 'Perlu Menindaklanjuti Pengajuan!';
                $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        return redirect('pembatalan-akuntansi')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
    }


    // RESPON Reject STATUS PENGAJUAN
    public function ResponReject(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = Akuntansi::where('id_akuntansi', $ids)->first();
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
                $url = route('pembatalan-akuntansi.index');
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
                $url = route('pembatalan-akuntansi.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'Pembukuan')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('pembatalan-akuntansi.index');
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
                $url = route('pembatalan-akuntansi.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Rejected Pengajuan Pembatalan Transaksi (Akuntansi)';
        $this->LogActivity($data, $LogAksi);

        return redirect('pembatalan-akuntansi')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
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
        $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_akuntansi) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
        $status .= '<a class="dropdown-item reject" href="#" data-toggle="modal" data-target="#modalReject" data-id="' . encrypt($data->id_akuntansi) . '" data-kode_form="' . $data->kode_form . '">Reject</a>';
        $status .= '</div>';
        $status .= '</div>';
        return $status;
    }


    private function statusAfter($data, $jabatan, $statusDropdown)
    {
        if (auth()->user()->jabatan == 'Pembukuan') {
            $status = '';
            if ($jabatan == 'Approve') {
                $status .= '<a class="btn btn-success btn-sm disabled">Approve</a>';
            } elseif ($jabatan == 'Reject') {
                $status .= '<a class="btn btn-danger btn-sm disabled">Reject</a>';
            } elseif ($jabatan == 'SendedToDirops' && $data->status_dirops == null) {
                $status .= '<a class="btn btn-info btn-sm disabled">SendedToDirops</a>';
            } elseif ($data->status_dirops == 'Approve') {
                $status .= '<div class="dropdown">';
                $status .= '<button class="btn btn-sm btn-info dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $status .= 'SendedToDirops';
                $status .= '</button>';
                $status .= '<div class="dropdown-menu" aria-labelledby="statusDropdown">';
                $status .= '<a class="dropdown-item" href="/pembatalan-akuntansi-approve/' . encrypt($data->id_akuntansi)  . '" onclick="return confirm(\'Approve data sebagai Selesai?\')">Approve</a>';
                $status .= '<a class="dropdown-item" href="/pembatalan-akuntansi-Reject/' . encrypt($data->id_akuntansi)  . '" onclick="return confirm(\'Reject data sebagai Selesai?\')">Reject</a>';
                $status .= '</div>';
                $status .= '</div>';
            } else {
                $status .= '<div class="dropdown">';
                $status .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $status .= 'Nothing';
                $status .= '</button>';
                $status .= '<div class="dropdown-menu" aria-labelledby="statusDropdown">';
                $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_akuntansi) . '" data-kode_form="' . $data->kode_form . '">SendToDirops</a>';
                $status .= '<a class="dropdown-item reject" href="#" data-toggle="modal" data-target="#modalReject" data-id="' . encrypt($data->id_akuntansi) . '" data-kode_form="' . $data->kode_form . '">Reject</a>';
                $status .= '</div>';
                $status .= '</div>';
            }
            return $status;
        } else {
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
        if (auth()->user()->jabatan == 'Direktur Operasional') {
            Mail::send('email.notif.notif-to-pembukuan',  [
                'nama' => $data->nama,
                'kc' => $data->cabang->cabang,
                'nik' => $data->nik,
                'kode_form' => $data->kode_form,
                'keperluan' => "Pembatalan Transaksi (Akuntansi)"
            ], function ($message) use ($userPenerima) {
                $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
                $message->to($userPenerima->email);
                $message->subject('Perlu Tindak Lanjut Transaksi (Akuntansi)');
            });
        } else {
            Mail::send('email.notif.notif-pengajuan',  [
                'nama' => $data->nama,
                'kc' => $data->cabang->cabang,
                'nik' => $data->nik,
                'kode_form' => $data->kode_form,
                'keperluan' => "Pembatalan Transaksi (Akuntansi)"
            ], function ($message) use ($userPenerima) {
                $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
                $message->to($userPenerima->email);
                $message->subject('Pengajuan Pembatalan Transaksi (Akuntansi)');
            });
        }


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
            'keperluan' => "Pembatalan Transaksi (Akuntansi)",
            'status_akhir' => $status_akhir,
            'pelanggaran' => ($status_akhir == 'Approved') ? $data->pelanggaran_dirops : null,
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
            'keperluan' => "Pembatalan Transaksi (Akuntansi)"
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
                'keperluan' => "Pembatalan Transaksi (Akuntansi)"
            ], function ($message) use ($user) {
                $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
                $message->to($user->email);
                $message->subject('Pengajuan Pembatalan Transaksi (Akuntansi)');
            });
        }
        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }
}
