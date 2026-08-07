<?php

namespace App\Services\Insentif;

use App\Models\MasterInsentif\InsSurtug;
use App\Models\MasterInsentif\InsSurtugDeb;
use App\Models\User;
use App\Services\EmailServices;
use App\Services\StatusAndLogServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class SurtugServices
 * @package App\Services
 */
class SurtugServices
{
    // load services
    protected $emailServices, $statusAndLogServices;
    public function __construct(EmailServices $emailServices, StatusAndLogServices $statusAndLogServices)
    {
        $this->emailServices = $emailServices;
        $this->statusAndLogServices = $statusAndLogServices;
    }


    public function index($kode, $user, $awal, $akhir, Request $request)
    {
        // pemberitahuan sudah dibaca
        if ($kode != null) {
            $notifikasi = auth()->user()->unreadNotifications
                ->filter(function ($item) use ($kode) {
                    return $item->id === request('id') || $item->data['kode_form'] === $kode;
                })
                ->first();

            $notifikasi?->markAsRead();
        }



        if ($request->ajax()) {
            // query
            $query = InsSurtug::when($user->level === 'MEDIUM USER', fn($q)
            => $q->where('id_cabang', $user->id_cabang));

            // Filter
            if (!empty($request->kode)) {
                $data = $query->where('kode_form', $kode);
            } elseif (!empty($request->min)) {
                $data = $query->whereBetween('created_at', [$awal, $akhir]);
            } elseif (!empty($request->id_cabang)) {
                $data = $query->when($request->id_cabang != 99, fn($query) => $query->where('id_cabang', $request->id_cabang));
            } else {
                $data = $query;
            }


            // return ke data table
            return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->cabang;
                })
                ->addColumn('status', function ($data) use ($user) {
                    $statusDropdown = $this->statusAndLogServices->statusNothing($data->id, $data->kode_form);

                    $status = '';
                    switch ($user->jabatan) {
                        case 'Kasi Operasional':
                        case 'Kasi Komersial':
                            $status .= '<a class="btn btn-success btn-sm disabled">Terkirim</a>';
                            break;

                        case 'Pimpinan Cabang':
                            $jabatan = $data->status_pincab;
                            $before_status = $data->creator;
                            $statusAfter = $this->statusAndLogServices->statusAfter($before_status, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;
                        default:
                            $status .= '<a class="btn btn-info btn-sm disabled">NotNeed</a>';
                            break;
                    }

                    return $status;
                })
                ->addColumn('action', function ($data) use ($user) {
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id . '" id="' . $data->id . '" class="btn btn-info btn-sm detail_data btn-table" data-kode_form="' . $data->kode_form . '">
                                <span class="icon text-white-50">
                                <i class="fa fa-eye"></i>
                                </span>
                            </a>';

                    switch ($user->jabatan) {
                        case 'Kasi Komersial':
                        case 'Kasi Operasional':
                            if ($data->status_pincab != null) {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled btn-table"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a href="' . route('surtug.edit', base64_encode($data->id)) . '"
                                            class="btn btn-warning btn-sm edit btn-table">
                                        <i class="fa fa-edit"></i></a>';
                            }
                            break;

                        default:
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                    }

                    return $button;
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
    }


    public function store(Request $request)
    {
        $cabang = DB::connection('ksb_sdm')
            ->table('cabang')
            ->where('id_cabang', auth()->user()->id_cabang)
            ->value('kode_spk');

        $now = Carbon::now();
        $thn = $now->year;

        $bulanRom = now()->format('m');
        switch ($bulanRom) {
            case 1:
                $bulanRom = "I";
                break;
            case 2:
                $bulanRom = "II";
                break;
            case 3:
                $bulanRom = "III";
                break;
            case 4:
                $bulanRom = "IV";
                break;
            case 5:
                $bulanRom = "V";
                break;
            case 6:
                $bulanRom = "VI";
                break;
            case 7:
                $bulanRom = "VII";
                break;
            case 8:
                $bulanRom = "VIII";
                break;
            case 9:
                $bulanRom = "IX";
                break;
            case 10:
                $bulanRom = "X";
                break;
            case 11:
                $bulanRom = "XI";
                break;
            case 12:
                $bulanRom = "XII";
        }

        $ambil = InsSurtug::where('kode_form', 'LIKE', "%/KSB.$cabang.STPKB/%")
            ->orderBy('created_at', 'desc')
            ->first();

        if ($ambil === null) {
            $urut = "001";
            $nomer = $urut . '/KSB.' . $cabang . '.STPKB/' . $bulanRom . '/' . $thn;
        } else {
            $cekTahun = substr($ambil->kode_form, -4, 4);
            if ($cekTahun != $thn) {
                $urut = "001";
                $nomer = $urut . '/KSB.' . $cabang . '.STPKB/' . $bulanRom . '/' . $thn;
            } else {
                $urut = substr($ambil->kode_form, 0, 3);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 3, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $urut . '/KSB.' . $cabang . '.STPKB/' . $bulanRom . '/' . $thn;
            }
        }

        $surtug = new InsSurtug();
        $surtug->kode_form = $nomer;
        $surtug->id_cabang = auth()->user()->id_cabang;
        if ($request->status_form != 'New') {
            $surtug->kode_form_sebelumnya = $request->kode_form_sebelumnya;
        }
        $surtug->status_form = $request->status_form;
        $surtug->tgl_awal = $request->tgl_awal;
        $surtug->tgl_akhir = $request->tgl_akhir;
        $surtug->nama_pic = $request->nama_pic;
        $surtug->nik_pic = $request->nik_pic;
        $surtug->creator = auth()->user()->nama;
        $surtug->tgl_creator = now();
        $surtug->save();

        // simpan debitur
        for ($i = 1; $i <= 50; $i++) {
            if ($request->has('nama_' . $i) && $request->input('nama_' . $i)) {
                $debitur = new InsSurtugDeb();
                $debitur->id_surtug = $surtug->id;
                $debitur->nama = $request->input('nama_' . $i);
                $debitur->norek = $request->input('norek_' . $i);
                $debitur->kol = $request->input('kol_' . $i);
                $debitur->target = $request->input('target_' . $i);
                $debitur->plafond = $this->normalizeNumber($request->input('plafond_' . $i));
                $debitur->bakidebet = $this->normalizeNumber($request->input('bakidebet_' . $i));
                $debitur->save();
            }
        }

        $user = User::where('id_cabang', auth()->user()->id_cabang)
            ->where('jabatan', 'Pimpinan Cabang')
            ->where('email', 'LIKE', '%@gmail.com%')
            ->where('nama', 'NOT LIKE', 'Dummy%')
            ->first();

        $payload = [
            'url' => route('surtug.index'),
            'title' => 'Terdapat Form Pengajuan Baru!',
            'message' => 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!',
            'subjek' => 'Pengajuan Surat Tugas NPL',
            'subjek_status' => 'Status | Pengajuan Surat Tugas NPL',
            'jabatan_next' => 'Pimpinan Cabang',
            'status_akhir' => 'Selesai',
        ];

        $this->emailServices->SendEmail(
            $surtug,
            $user,
            $payload['url'],
            $payload['title'],
            $payload['message'],
            $payload['subjek']
        );

        return $surtug;
    }



    public function update(Request $request, $id)
    {
        $surtug = InsSurtug::where('id', $id)->first();
        if ($request->status_form != 'New') {
            $surtug->kode_form_sebelumnya = $request->kode_form_sebelumnya;
        }
        $surtug->status_form = $request->status_form;
        $surtug->tgl_awal = $request->tgl_awal;
        $surtug->tgl_akhir = $request->tgl_akhir;
        $surtug->nama_pic = $request->nama_pic;
        $surtug->nik_pic = $request->nik_pic;
        $surtug->creator = auth()->user()->nama;
        $surtug->tgl_creator = now();
        $surtug->save();

        // 
        // update debitur
        for ($i = 1; $i <= 50; $i++) {
            if ($request->filled('id_deb_' . $i) && $request->filled('nama_' . $i)) {
                $debitur = InsSurtugDeb::where('id', base64_decode($request->input('id_deb_' . $i)))->first();
                if ($request->input('aksi_' . $i) == 'Edit') {
                    $debitur->nama = $request->input('nama_' . $i);
                    $debitur->norek = $request->input('norek_' . $i);
                    $debitur->kol = $request->input('kol_' . $i);
                    $debitur->target = $request->input('target_' . $i);
                    $debitur->plafond = $this->normalizeNumber($request->input('plafond_' . $i));
                    $debitur->bakidebet = $this->normalizeNumber($request->input('bakidebet_' . $i));
                    $debitur->save();
                } else {
                    $debitur->delete();
                }
            } else {
                if ($request->filled('nama_' . $i)) {
                    $debitur = new InsSurtugDeb();
                    $debitur->id_surtug = $surtug->id;
                    $debitur->nama = $request->input('nama_' . $i);
                    $debitur->norek = $request->input('norek_' . $i);
                    $debitur->kol = $request->input('kol_' . $i);
                    $debitur->target = $request->input('target_' . $i);
                    $debitur->plafond = $this->normalizeNumber($request->input('plafond_' . $i));
                    $debitur->bakidebet = $this->normalizeNumber($request->input('bakidebet_' . $i));
                    $debitur->save();
                }
            }
        }

        return $surtug;
    }



    // fungsi normal untuk setting number
    function normalizeNumber($value)
    {
        if ($value === '∞') {
            return 0;
        }

        $value = str_replace('.', '', $value); // hapus ribuan
        $value = str_replace(',', '.', $value); // ubah desimal

        // pembulatan
        // return round($value);
        return floatval($value);

        // normalnya
        // $nilai = "49.000,89";
        // $jumlah_pengajuan = str_replace(',', '.', str_replace('.', '', $data['rate_1']));
    }
}
