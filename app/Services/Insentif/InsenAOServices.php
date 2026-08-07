<?php

namespace App\Services\Insentif;

use App\Models\MasterInsentif\InsAO;
use App\Models\MasterInsentif\InsAODeb;
use App\Models\User;
use App\Services\EmailServices;
use App\Services\StatusAndLogServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class InsenAOServices
 * @package App\Services
 */
class InsenAOServices
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
            $query = InsAO::when($user->level === 'MEDIUM USER', fn($q)
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

                        case 'Staff Komersial Pusat':
                            $jabatan = $data->status_komersial;
                            $before_status = $data->status_pincab;
                            $statusAfter = $this->statusAndLogServices->statusAfter($before_status, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;

                        case 'Direktur Komersial':
                            // $jabatan = $data->status_dirkom;
                            // $before_status = $data->status_komersial;
                            // $statusAfter = $this->statusAndLogServices->statusAfter($before_status, $jabatan, $statusDropdown);
                            // return $statusAfter;
                            $status .= '<a class="btn btn-success btn-sm disabled">NotNeed</a>';
                            break;

                        case 'SDM':
                            $jabatan = $data->status_sdm;
                            $before_status = $data->status_dirkom;
                            $statusAfter = $this->statusAndLogServices->statusAfter($before_status, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;

                        case 'Direktur Operasional':
                            $jabatan = $data->status_dirops;
                            $before_status = $data->status_sdm;
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
                            if ($data->status_komersial != null) {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled btn-table"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a href="' . route('ao.edit', base64_encode($data->id)) . '"
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

        $ambil = InsAO::where('kode_form', 'LIKE', "%/KSB.$cabang.INSAO/%")
            ->orderBy('created_at', 'desc')
            ->first();

        if ($ambil === null) {
            $urut = "001";
            $nomer = $urut . '/KSB.' . $cabang . '.INSAO/' . $bulanRom . '/' . $thn;
        } else {
            $cekTahun = substr($ambil->kode_form, -4, 4);
            if ($cekTahun != $thn) {
                $urut = "001";
                $nomer = $urut . '/KSB.' . $cabang . '.INSAO/' . $bulanRom . '/' . $thn;
            } else {
                $urut = substr($ambil->kode_form, 0, 3);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 3, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $urut . '/KSB.' . $cabang . '.INSAO/' . $bulanRom . '/' . $thn;
            }
        }

        $insenAO = new InsAO();
        $insenAO->id_cabang = auth()->user()->id_cabang;
        $insenAO->kode_form = $nomer;
        $insenAO->nama_ao = $request->nama_ao;
        $insenAO->periode = $request->periode;
        $insenAO->target = $this->normalizeNumber($request->target);
        $insenAO->total_nominal = $this->normalizeNumber($request->total_nominal);
        $insenAO->total_biaya_adm = $this->normalizeNumber($request->total_biaya_adm);
        $insenAO->total_biaya_survey = $this->normalizeNumber($request->total_biaya_survey);
        $insenAO->total_biaya_admin_survey = $this->normalizeNumber($request->total_biaya_admin_survey);
        $insenAO->total_referal = $this->normalizeNumber($request->total_referal);
        $insenAO->pencapaian = $this->normalizeNumber($request->pencapaian);
        $insenAO->pencapaian_persen = $this->normalizeNumber($request->pencapaian_persen);
        $insenAO->pencapaian_status = $request->pencapaian_status;
        $insenAO->par = $this->normalizeNumber($request->par);
        $insenAO->par_persen = $this->normalizeNumber($request->par_persen);
        $insenAO->par_status = $request->par_status;
        $insenAO->npl_lampau = $this->normalizeNumber($request->npl_lampau);
        $insenAO->npl_lampau_persen = $this->normalizeNumber($request->npl_lampau_persen);
        $insenAO->npl_lampau_status = $request->npl_lampau_status;
        $insenAO->npl_insentif = $this->normalizeNumber($request->npl_insentif);
        $insenAO->npl_insentif_persen = $this->normalizeNumber($request->npl_insentif_persen);
        $insenAO->npl_insentif_status = $request->npl_insentif_status;
        $insenAO->hasil = $request->hasil;
        $insenAO->perhitungan_insentif = $this->normalizeNumber($request->perhitungan_insentif);
        $insenAO->pinalti_par = $this->normalizeNumber($request->pinalti_par);
        $insenAO->pinalti_masa_kerja = $this->normalizeNumber($request->pinalti_masa_kerja);
        $insenAO->insentif_referal = $this->normalizeNumber($request->insentif_referal);
        $insenAO->insentif_final = $this->normalizeNumber($request->insentif_final);
        $insenAO->creator = auth()->user()->nama;
        $insenAO->tgl_creator = now();
        $insenAO->save();

        for ($i = 1; $i <= 30; $i++) {
            if ($request->has('nama_' . $i) && $request->input('nama_' . $i)) {
                $aoDeb = new InsAODeb();
                $aoDeb->id_insen_ao = $insenAO->id;
                $aoDeb->tgl_realisasi = $request->input('tgl_realisasi_' . $i);
                $aoDeb->nama = $request->input('nama_' . $i);
                $aoDeb->norek = $request->input('norek_' . $i);
                $aoDeb->nominal = $this->normalizeNumber($request->input('nominal_' . $i));
                $aoDeb->biaya_adm = $this->normalizeNumber($request->input('biaya_adm_' . $i));
                $aoDeb->biaya_survey = $this->normalizeNumber($request->input('biaya_survey_' . $i));
                $aoDeb->total_adm_survey = $this->normalizeNumber($request->input('total_adm_survey_' . $i));
                $aoDeb->status_referal = $request->input('status_referal_' . $i);
                $aoDeb->nama_referal = $request->input('nama_referal_' . $i);
                $aoDeb->insentif_referal = $this->normalizeNumber($request->input('insentif_referal_' . $i));
                $aoDeb->putusan = $request->input('putusan_' . $i);
                $aoDeb->save();
            }
        }


        // send email
        $user = User::where('id_cabang', auth()->user()->id_cabang)
            ->where('jabatan', 'Pimpinan Cabang')
            ->where('email', 'LIKE', '%@gmail.com%')
            ->where('nama', 'NOT LIKE', 'Dummy%')
            ->first();

        $payload = [
            'url' => route('surtug.index'),
            'title' => 'Terdapat Form Pengajuan Baru!',
            'message' => 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!',
            'subjek' => 'Pengajuan Penyelesaian NPL',
            'subjek_status' => 'Status | Pengajuan Penyelesaian NPL',
            'jabatan_next' => 'Pimpinan Cabang',
            'status_akhir' => 'Selesai',
        ];

        $this->emailServices->SendEmail(
            $insenAO,
            $user,
            $payload['url'],
            $payload['title'],
            $payload['message'],
            $payload['subjek']
        );

        return $insenAO;
    }


    public function update(Request $request, $id)
    {
        $insenAO = InsAO::findOrFail(base64_decode($id));
        $insenAO->nama_ao = $request->nama_ao;
        $insenAO->periode = $request->periode;
        $insenAO->target = $this->normalizeNumber($request->target);
        $insenAO->total_nominal = $this->normalizeNumber($request->total_nominal);
        $insenAO->total_biaya_adm = $this->normalizeNumber($request->total_biaya_adm);
        $insenAO->total_biaya_survey = $this->normalizeNumber($request->total_biaya_survey);
        $insenAO->total_biaya_admin_survey = $this->normalizeNumber($request->total_biaya_admin_survey);
        $insenAO->total_referal = $this->normalizeNumber($request->total_referal);
        $insenAO->pencapaian = $this->normalizeNumber($request->pencapaian);
        $insenAO->pencapaian_persen = $this->normalizeNumber($request->pencapaian_persen);
        $insenAO->pencapaian_status = $request->pencapaian_status;
        $insenAO->par = $this->normalizeNumber($request->par);
        $insenAO->par_persen = $this->normalizeNumber($request->par_persen);
        $insenAO->par_status = $request->par_status;
        $insenAO->npl_lampau = $this->normalizeNumber($request->npl_lampau);
        $insenAO->npl_lampau_persen = $this->normalizeNumber($request->npl_lampau_persen);
        $insenAO->npl_lampau_status = $request->npl_lampau_status;
        $insenAO->npl_insentif = $this->normalizeNumber($request->npl_insentif);
        $insenAO->npl_insentif_persen = $this->normalizeNumber($request->npl_insentif_persen);
        $insenAO->npl_insentif_status = $request->npl_insentif_status;
        $insenAO->hasil = $request->hasil;
        $insenAO->perhitungan_insentif = $this->normalizeNumber($request->perhitungan_insentif);
        $insenAO->pinalti_par = $this->normalizeNumber($request->pinalti_par);
        $insenAO->pinalti_masa_kerja = $this->normalizeNumber($request->pinalti_masa_kerja);
        $insenAO->insentif_referal = $this->normalizeNumber($request->insentif_referal);
        $insenAO->insentif_final = $this->normalizeNumber($request->insentif_final);
        $insenAO->creator = auth()->user()->nama;
        $insenAO->tgl_creator = now();
        $insenAO->save();

        for ($i = 1; $i <= 30; $i++) {
            if ($request->has('nama_' . $i) && $request->input('nama_' . $i)) {
                if ($request->has('id_debca_' . $i) && $request->input('id_debca_' . $i)) {
                    $aoDeb = InsAODeb::findOrFail(base64_decode($request->input('id_debca_' . $i)));
                    if ($request->input('aksi_' . $i) == 'Edit') {
                        $aoDeb->tgl_realisasi = $request->input('tgl_realisasi_' . $i);
                        $aoDeb->nama = $request->input('nama_' . $i);
                        $aoDeb->norek = $request->input('norek_' . $i);
                        $aoDeb->nominal = $this->normalizeNumber($request->input('nominal_' . $i));
                        $aoDeb->biaya_adm = $this->normalizeNumber($request->input('biaya_adm_' . $i));
                        $aoDeb->biaya_survey = $this->normalizeNumber($request->input('biaya_survey_' . $i));
                        $aoDeb->total_adm_survey = $this->normalizeNumber($request->input('total_adm_survey_' . $i));
                        $aoDeb->status_referal = $request->input('status_referal_' . $i);
                        $aoDeb->nama_referal = $request->input('nama_referal_' . $i);
                        $aoDeb->insentif_referal = $this->normalizeNumber($request->input('insentif_referal_' . $i));
                        $aoDeb->putusan = $request->input('putusan_' . $i);
                        $aoDeb->save();
                    } else {
                        $aoDeb->delete();
                    }
                } else {
                    $aoDeb = new InsAODeb();
                    $aoDeb->id_insen_ao = $insenAO->id;
                    $aoDeb->tgl_realisasi = $request->input('tgl_realisasi_' . $i);
                    $aoDeb->nama = $request->input('nama_' . $i);
                    $aoDeb->norek = $request->input('norek_' . $i);
                    $aoDeb->nominal = $this->normalizeNumber($request->input('nominal_' . $i));
                    $aoDeb->biaya_adm = $this->normalizeNumber($request->input('biaya_adm_' . $i));
                    $aoDeb->biaya_survey = $this->normalizeNumber($request->input('biaya_survey_' . $i));
                    $aoDeb->total_adm_survey = $this->normalizeNumber($request->input('total_adm_survey_' . $i));
                    $aoDeb->status_referal = $request->input('status_referal_' . $i);
                    $aoDeb->nama_referal = $request->input('nama_referal_' . $i);
                    $aoDeb->insentif_referal = $this->normalizeNumber($request->input('insentif_referal_' . $i));
                    $aoDeb->putusan = $request->input('putusan_' . $i);
                    $aoDeb->save();
                }
            }
        }

        return $insenAO;
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
