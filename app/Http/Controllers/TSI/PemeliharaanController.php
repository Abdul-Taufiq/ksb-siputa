<?php

namespace App\Http\Controllers\TSI;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\TSI\Pemeliharaan;
use App\Models\TSI\PemeliharaanHistory;
use App\Models\User;
use App\Notifications\NotifikasiPengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Crypt, DB, Mail, Notification};

class PemeliharaanController extends Controller
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
                case 'Analis Area':
                case 'Staf Area':
                case 'Pimpinan Cabang':
                    if (!empty($request->kode)) {
                        $data = Pemeliharaan::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Pemeliharaan::where('id_cabang', $id_cabang)
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Pemeliharaan::where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                    # Pimpinan Cabang ...
                case 'Pembukuan':
                    if (!empty($request->kode)) {
                        $data = Pemeliharaan::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Pemeliharaan::whereBetween('created_at', [$awal, $akhir])
                                ->get();
                        } elseif (!empty($request->cari)) {
                            $data = Pemeliharaan::where('kode_form', $request->cari)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Pemeliharaan::OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'Direktur Operasional':
                    if (!empty($request->kode)) {
                        $data = Pemeliharaan::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Pemeliharaan::whereBetween('created_at', [$awal, $akhir])
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Pemeliharaan::orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'TSI':
                    if (!empty($request->kode)) {
                        $data = Pemeliharaan::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = Pemeliharaan::whereBetween('created_at', [$awal, $akhir])
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = Pemeliharaan::orderBy('created_at', 'desc')->get();
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
                            $status .= '<a class="btn btn-secondary btn-sm disabled">NotNeed</a>';
                            break;

                        case 'Pembukuan':
                            $status .= '<a class="btn btn-secondary btn-sm disabled">NotNeed</a>';
                            break;

                        case 'Direktur Operasional':
                            $status .= '<a class="btn btn-secondary btn-sm disabled">NotNeed</a>';
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
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id_pemeliharaan . '" id="' . $data->id_pemeliharaan . '"
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
                        case 'Kepala Kantor Kas':
                            if ($data->status_pincab == "Approve" || $data->status_pincab == "Reject") {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_pemeliharaan . '" id="' . $data->id_pemeliharaan . '"
                                                class="btn btn-warning btn-sm edit" data-kode_form="' . $data->kode_form . '">
                                            <i class="fa fa-edit"></i></a>';
                                $button .= '&nbsp;';
                            }
                            break;
                            # Pincab...
                        case 'Pimpinan Cabang':
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                            # Pembukuan, Dirops & TSi...
                        case 'Pembukuan':
                        case 'Direktur Operasional':
                        case 'TSI':
                            if ($data->jns_pembelian == 'Pembelian Dengan Speksifikasi KPM' && $data->kategori_barang == 'Elektronik') {
                                # code...
                                if ($data->status_tsi == "Approve" || $data->status_tsi == "Reject") {
                                    $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                                } else {
                                    $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_pemeliharaan . '" id="' . $data->id_pemeliharaan . '"
                                                    class="btn btn-warning btn-sm edit" data-kode_form="' . $data->kode_form . '">
                                                <i class="fa fa-edit"></i></a>';
                                    $button .= '&nbsp;';
                                }
                            } else {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            }
                            break;
                    }
                    return $button;
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('Page.Pemeliharaan.index', ['title' => 'Pengajuan Pemeliharaan']);
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
            $cek = Pemeliharaan::count();
        }

        if ($cek == 0) {
            $urut = 0001;
            $nomer = $cabang . '/TSI-TRB/' . $thn . '/0001';
        } else {
            $ambil = Pemeliharaan::all()->last();
            $cekTahun = substr($ambil->kode_form, -9, 4);
            if ($cekTahun != $thn) {
                $urut = 0001;
                $nomer = $cabang . '/TSI-TRB/' . $thn . '/0001';
            } else {
                $urut = substr($ambil->kode_form, -4, 10);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 4, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $cabang . '/TSI-TRB/' . $thn . '/' . $urut;
            }
        }

        $data = new Pemeliharaan();
        $data->kode_form = $nomer;
        $data->nama_kaops = auth()->user()->nama;
        $data->id_cabang = auth()->user()->id_cabang;
        $data->kode_inventaris = $request->kode_inventaris;
        $data->detail_kendala = $request->detail_kendala;
        $data->save();

        $history = new PemeliharaanHistory();
        $history->id_cabang = auth()->user()->id_cabang;
        $history->id_pemeliharaan = $data->id_pemeliharaan;
        $history->kode_inventaris = $data->kode_inventaris;
        $history->save();

        // Log Activity
        $LogAksi = '(+) Pengajuan Pemeliharaan Perangkat';
        $this->LogActivity($data, $LogAksi);
        // Send Email
        $userPenerima = User::where('jabatan', 'TSI')->get();
        $url = route('pemeliharaan-perangkat.index');
        $title = 'Terdapat Form Pengajuan Baru!';
        $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
        $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);

        return redirect('pemeliharaan-perangkat')->with('AlertSuccess', "Pengajuan Pemeliharaan Perangkat Berhasil Dikirim!");
    }


    public function show(Pemeliharaan $pemeliharaan)
    {
        $history = PemeliharaanHistory::where('kode_inventaris', $pemeliharaan->kode_inventaris)->get();

        return view('Page.Pemeliharaan.show', compact('pemeliharaan', 'history'), ['title' => 'Show Data']);
    }


    public function edit(Pemeliharaan $pemeliharaan)
    {
        return response()->json([
            'status' => 200,
            'data' => $pemeliharaan
        ]);
    }


    public function update(Request $request, Pemeliharaan $pemeliharaan)
    {
        $pemeliharaan->kode_inventaris = $request->kode_inventaris_edit;
        $pemeliharaan->detail_kendala = $request->detail_kendala_edit;
        $pemeliharaan->save();

        $history = PemeliharaanHistory::where('id_pemeliharaan', $pemeliharaan->id_pemeliharaan)->first();
        $history->kode_inventaris = $pemeliharaan->kode_inventaris;
        $history->save();

        // Log Activity
        $LogAksi = '(u) Edit Pengajuan Pemeliharaan Perangkat';
        $this->LogActivity($pemeliharaan, $LogAksi);

        return redirect('pemeliharaan-perangkat')->with('AlertSuccess', "Pengajuan Berhasil Diedit!");
    }


    public function destroy(Pemeliharaan $pemeliharaan)
    {
        //
    }




    // RESPON APPROVE STATUS PENGAJUAN
    public function ResponApprove(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = Pemeliharaan::where('id_pemeliharaan', $ids)->first();
        $history = PemeliharaanHistory::where('id_pemeliharaan', $ids)->first();
        $jabatan = auth()->user()->jabatan;
        $nama = auth()->user()->nama;

        switch ($jabatan) {
            case 'TSI':
                $data->update([
                    'nama_tsi' => $nama,
                    'status_tsi' => 'Approve',
                    'tgl_status_tsi' => now(),
                    'tgl_status_akhir' => now(),
                    'status_akhir' => 'Selesai',
                    'keputusan_tsi' => $request->keputusan_tsi,
                    'detail_perbaikan' => $request->detail_perbaikan,
                    'catatan_tsi' => $request->catatan
                ]);

                $history->update([
                    'detail_kerusakan' => $request->detail_kerusakan,
                    'detail_perbaikan' => $request->detail_perbaikan,
                    'tgl_dilaksanakan' => now()
                ]);

                $userPenerima = User::where('jabatan', 'Kasi Operasional')->first();

                // pemberitahuan database
                $status_akhir = 'Approved';
                $url = route('pemeliharaan-perangkat.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Approved!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('pemeliharaan-perangkat.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Approve Pengajuan Inventaris';
        $this->LogActivity($data, $LogAksi);

        return redirect('pemeliharaan-perangkat')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
    }


    // RESPON Reject STATUS PENGAJUAN
    public function ResponReject(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = Pemeliharaan::where('id_pemeliharaan', $ids)->first();
        $jabatan = auth()->user()->jabatan;
        $nama = auth()->user()->nama;

        switch ($jabatan) {
            case 'TSI':
                $data->update([
                    'nama_tsi' => $nama,
                    'status_tsi' => 'Reject',
                    'tgl_status_tsi' => now(),
                    'keputusan_tsi' => $request->keputusan_tsi,
                    'catatan_tsi' => $request->catatan,
                    'keputusan_tsi' => $request->keputusan_tsi,
                    'tgl_status_akhir' => now(),
                    'status_akhir' => 'Ditolak',
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('pemeliharaan-perangkat.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('pemeliharaan-perangkat.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Rejected Pengajuan Inventaris';
        $this->LogActivity($data, $LogAksi);

        return redirect('pemeliharaan-perangkat')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
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
        $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_pemeliharaan) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
        $status .= '<a class="dropdown-item reject" href="#" data-toggle="modal" data-target="#modalReject" data-id="' . encrypt($data->id_pemeliharaan) . '" data-kode_form="' . $data->kode_form . '">Reject</a>';
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
        Mail::send('email.notif.notif-status-akhir',  [
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
