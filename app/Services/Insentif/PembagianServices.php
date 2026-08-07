<?php

namespace App\Services\Insentif;

use App\Models\MasterInsentif\InsPembagian;
use App\Models\MasterInsentif\InsPenyelesaian;
use App\Models\User;
use App\Services\EmailServices;
use App\Services\StatusAndLogServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

/**
 * Class PembagianServices
 * @package App\Services
 */
class PembagianServices
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
            $query = InsPenyelesaian::query()
                ->when($user->level === 'MEDIUM USER', fn($q) => $q->where('id_cabang', $user->id_cabang));

            // filter
            if (!empty($request->kode)) {
                $data = $query->where('kode_form', $kode);
            } elseif (!empty($request->min)) {
                $data = $query->whereBetween('created_at', [$awal, $akhir]);
            } elseif (!empty($request->id_cabang)) {
                $data = $query->when($request->id_cabang != 99, fn($query) => $query->where('id_cabang', $request->id_cabang));
            } else {
                $data = $query;
            }


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
                                $button .= '<a href="' . route('penyelesaian.edit', base64_encode($data->id)) . '"
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

        $ambil = InsPenyelesaian::where('kode_form', 'LIKE', "%/KSB.$cabang.LDPKB/%")
            ->orderBy('created_at', 'desc')
            ->first();

        if ($ambil === null) {
            $urut = "001";
            $nomer = $urut . '/KSB.' . $cabang . '.LDPKB/' . $bulanRom . '/' . $thn;
        } else {
            $cekTahun = substr($ambil->kode_form, -4, 4);
            if ($cekTahun != $thn) {
                $urut = "001";
                $nomer = $urut . '/KSB.' . $cabang . '.LDPKB/' . $bulanRom . '/' . $thn;
            } else {
                $urut = substr($ambil->kode_form, 0, 3);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 3, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $urut . '/KSB.' . $cabang . '.LDPKB/' . $bulanRom . '/' . $thn;
            }
        }

        $penyelesaian = new InsPenyelesaian();
        $penyelesaian->id_cabang = auth()->user()->id_cabang;
        $penyelesaian->kode_form = $nomer;
        $penyelesaian->kode_form_surtug = $request->kode_form_surtug;
        $penyelesaian->nama = $request->nama;
        $penyelesaian->norek = $request->norek;
        $penyelesaian->plafond = $this->normalizeNumber($request->plafond);
        $penyelesaian->bakidebet = $this->normalizeNumber($request->bakidebet);
        $penyelesaian->tunggakan_pokok = $this->normalizeNumber($request->tunggakan_pokok);
        $penyelesaian->tunggakan_bunga = $this->normalizeNumber($request->tunggakan_bunga);
        $penyelesaian->denda = $this->normalizeNumber($request->denda);
        $penyelesaian->jns_pinjaman = $request->jns_pinjaman;
        $penyelesaian->kolek = $request->kolek;
        $penyelesaian->pemutus_kredit = $request->pemutus_kredit;
        $penyelesaian->nominal_dibayar = $this->normalizeNumber($request->nominal_dibayar);
        $penyelesaian->biaya_pihak_ketiga = $this->normalizeNumber($request->biaya_pihak_ketiga);
        $penyelesaian->dpi_opsi = $request->dpi_opsi;
        $penyelesaian->dpi_persen = $this->normalizeNumber($request->dpi_persen);
        $penyelesaian->dpi = $this->normalizeNumber($request->dpi);
        $penyelesaian->nominal_insentif = $this->normalizeNumber($request->nominal_insentif);
        $penyelesaian->komposisi_insentif = $request->komposisi_insentif;
        $penyelesaian->creator = auth()->user()->nama;
        $penyelesaian->tgl_creator = now();
        $penyelesaian->save();

        // simpan debitur
        for ($i = 1; $i <= 5; $i++) {
            if ($request->has('nama_' . $i) && $request->input('nama_' . $i)) {
                $pembagian = new InsPembagian();
                $pembagian->id_ins_penyelesaian = $penyelesaian->id;
                $pembagian->nama = $request->input('nama_' . $i);
                $pembagian->nik = $request->input('nik_' . $i);
                $pembagian->jabatan = $request->input('jabatan_' . $i);
                $pembagian->persen = $this->normalizeNumber($request->input('persen_' . $i));
                $pembagian->nominal = $this->normalizeNumber($request->input('nominal_' . $i));
                $pembagian->save();
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
            $penyelesaian,
            $user,
            $payload['url'],
            $payload['title'],
            $payload['message'],
            $payload['subjek']
        );

        return $penyelesaian;
    }



    public function update(Request $request, $id)
    {
        $penyelesaian = InsPenyelesaian::findOrFail($id);
        $penyelesaian->kode_form_surtug = $request->kode_form_surtug;
        $penyelesaian->nama = $request->nama;
        $penyelesaian->norek = $request->norek;
        $penyelesaian->plafond = $this->normalizeNumber($request->plafond);
        $penyelesaian->bakidebet = $this->normalizeNumber($request->bakidebet);
        $penyelesaian->tunggakan_pokok = $this->normalizeNumber($request->tunggakan_pokok);
        $penyelesaian->tunggakan_bunga = $this->normalizeNumber($request->tunggakan_bunga);
        $penyelesaian->denda = $this->normalizeNumber($request->denda);
        $penyelesaian->jns_pinjaman = $request->jns_pinjaman;
        $penyelesaian->kolek = $request->kolek;
        $penyelesaian->pemutus_kredit = $request->pemutus_kredit;
        $penyelesaian->nominal_dibayar = $this->normalizeNumber($request->nominal_dibayar);
        $penyelesaian->biaya_pihak_ketiga = $this->normalizeNumber($request->biaya_pihak_ketiga);
        $penyelesaian->dpi_opsi = $request->dpi_opsi;
        $penyelesaian->dpi_persen = $this->normalizeNumber($request->dpi_persen);
        $penyelesaian->dpi = $this->normalizeNumber($request->dpi);
        $penyelesaian->nominal_insentif = $this->normalizeNumber($request->nominal_insentif);
        $penyelesaian->komposisi_insentif = $request->komposisi_insentif;
        $penyelesaian->save();

        // update pembagian
        for ($i = 1; $i <= 5; $i++) {
            if ($request->has('id_pembagian_' . $i) && $request->input('id_pembagian_' . $i)) {
                $pembagian = InsPembagian::where('id', base64_decode($request->input('id_pembagian_' . $i)))->first();

                $pembagian->nama = $request->input('nama_' . $i);
                $pembagian->nik = $request->input('nik_' . $i);
                $pembagian->jabatan = $request->input('jabatan_' . $i);
                $pembagian->persen = $this->normalizeNumber($request->input('persen_' . $i));
                $pembagian->nominal = $this->normalizeNumber($request->input('nominal_' . $i));
                $pembagian->save();
            }
        }

        return $penyelesaian;
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
