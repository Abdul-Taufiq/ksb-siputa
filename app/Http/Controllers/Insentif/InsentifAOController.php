<?php

namespace App\Http\Controllers\Insentif;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\MasterInsentif\InsAO;
use App\Models\MasterInsentif\InsAODeb;
use App\Services\EmailServices;
use App\Services\Insentif\InsenAOServices;
use App\Services\UpdateStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class InsentifAOController extends Controller
{
    protected $updateStatus, $emailservices, $insenService;

    private $subjek = 'Pengajuan Surat Tugas NPL';
    private $subjek_status = 'Status | Pengajuan Surat Tugas NPL';

    public function __construct(UpdateStatus $updateStatus, EmailServices $emailservices, InsenAOServices $insenService)
    {
        $this->updateStatus = $updateStatus;
        $this->emailservices = $emailservices;
        $this->insenService = $insenService;
    }


    public function index(Request $request)
    {
        $user = Auth::user();
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();
        $kode = $request->kode;

        if ($request->ajax()) {
            return $this->insenService->index($kode, $user, $awal, $akhir, $request);
        }

        return view('Page-Insentif-AO.index', [
            'title' => 'Pengajuan Insentif AO'
        ]);
    }


    public function getDataKredit(Request $request)
    {
        $nama_ao = $request->get('nama_ao');
        $nama_deb = $request->get('nama_deb');
        $awal = now()->startOfMonth();
        $akhir = now()->endOfMonth();

        $query = DB::connection('ksb_kredit')
            ->table('debitur')
            // Hubungkan tabel debitur ke tb_kredit
            ->join('tb_kredit as kredit', 'debitur.id_debitur', '=', 'kredit.id_debitur')
            // Hubungkan tabel tb_kredit ke tb_persetujuan
            ->join('tb_kredit_persetujuan as persetujuan', 'kredit.id_kredit', '=', 'persetujuan.id_kredit')
            // Pilih kolom spesifik yang Anda inginkan (sertakan nama tabel di depan kolom)
            ->select([
                'debitur.nama_debitur',
                'kredit.asal_kredit',
                'kredit.petugas_referal',
                'kredit.jumlah_disetujui',
                'persetujuan.norek_tabungan',
                'persetujuan.biaya_adm',
                'persetujuan.biaya_survey',
            ])
            // Jika ingin memfilter berdasarkan id_kredit tertentu seperti contoh sebelumnya
            ->where('kredit.id_cabang', auth()->user()->id_cabang)
            ->where('kredit.petugas_penerima', $nama_ao)
            ->where('kredit.status_akhir', 'DISETUJUI')
            ->whereBetween('kredit.tgl_awal', [$awal, $akhir])
            ->where('debitur.nama_debitur', 'LIKE', '%' . $nama_deb . '%');

        // cek route
        if ($request->is('insentif/get-detail-data-kredit')) {
            $data = $query->first(); // hanya satu object
        } else {
            $data = $query->limit(20)->get(); // array of objects
        }

        return response()->json($data);
    }


    public function create()
    {
        return view('Page-Insentif-AO.create-edit', [
            'title' => 'Tambah Pengajuan Insentif AO',
            'tipe' => 'create',
            'insenAo' => null,
            'debca' => null,
        ]);
    }


    public function store(Request $request)
    {
        $data = $this->insenService->store($request);

        $payload = [
            'url' => route('surtug.index'),
            'title' => 'Terdapat Form Pengajuan Baru!',
            'message' => 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!',
            'subjek' => $this->subjek,
            'subjek_status' => $this->subjek_status,
            'jabatan_next' => "Pimpinan Cabang",
            'status_akhir' => 'Proses',
        ];

        $this->updateStatus->updateStatus($request, $data, $payload, 'PROSES');

        // Log Activity
        $LogAksi = '(+) Data Pengajuan Insentif AO';
        $this->LogActivity($data, $LogAksi);

        return redirect(route('ao.index'))->with('AlertSuccess', "Pengajuan Berhasil Dikirim!");
    }


    public function edit($id)
    {
        $ids = base64_decode($id);
        $insenAO = InsAO::findOrFail($ids);
        $debCa = InsAODeb::where('id_insen_ao', $ids)->get();

        return view('Page-Insentif-AO.create-edit', [
            'title' => 'Tambah Pengajuan Insentif AO',
            'tipe' => 'edit',
            'insenAo' => $insenAO,
            'debca' => $debCa,
        ]);
    }


    public function update(Request $req, $id)
    {
        $data = $this->insenService->update($req, $id);

        // Log Activity
        $LogAksi = '(u) Data Pengajuan Insentif AO';
        $this->LogActivity($data, $LogAksi);

        return redirect(route('ao.index'))->with('AlertSuccess', "Pengajuan Berhasil Diupdate!");
    }


    public function show(InsAO $ao)
    {
        $debAo = InsAODeb::where('id_insen_ao', $ao->id)->orderBy('nama', 'asc')->get();

        return view('Page-Insentif-AO.show', [
            'insenAO' => $ao,
            'debAo' => $debAo
        ]);
    }

    public function getStatus(Request $request, $id, $status)
    {
        $ids = Crypt::decrypt($id);
        $data = InsAO::findOrFail($ids);
        $jabatan = auth()->user()->jabatan;

        $payload = [
            'url' => route('ao.index'),
            'title' => 'Terdapat Form Pengajuan Baru!',
            'message' => 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!',
            'subjek' => $this->subjek,
            'subjek_status' => $this->subjek_status,
            'jabatan_next' => null,
            'status_akhir' => 'Ditolak',
        ];

        switch ($jabatan) {
            case 'Pimpinan Cabang':
                if ($status == 'Approve') {
                    $payload['jabatan_next'] = 'Staff Komersial Pusat';
                    $payload['status_akhir'] = 'Proses';
                }

                if ($status != 'Approve') {
                    $this->updateStatus->infoStatusEnd($data, $payload);
                }

                $this->updateStatus->updateStatus($request, $data, $payload, $status);

                break;

            case 'Staff Komersial Pusat':
                if ($status == 'Approve') {
                    $payload['jabatan_next'] = 'SDM';
                    $payload['status_akhir'] = 'Proses';
                }

                if ($status != 'Approve') {
                    $this->updateStatus->infoStatusEnd($data, $payload);
                }

                $this->updateStatus->updateStatus($request, $data, $payload, $status);
                break;

            // case 'Direktur Komersial':
            //     if ($status == 'Approve') {
            //         $payload['jabatan_next'] = 'SDM';
            //         $payload['status_akhir'] = 'Proses';
            //     }

            //     if ($status != 'Approve') {
            //         $this->updateStatus->infoStatusEnd($data, $payload);
            //     }

            //     $this->updateStatus->updateStatus($request, $data, $payload, $status);
            //     break;

            case 'SDM':
                if ($status == 'Approve') {
                    $payload['jabatan_next'] = 'Direktur Operasional';
                    $payload['status_akhir'] = 'Proses';
                }
                $payload['jabatan_sama'] = 'SDM';

                if ($status != 'Approve') {
                    $this->updateStatus->infoStatusEnd($data, $payload);
                }

                $this->updateStatus->updateStatus($request, $data, $payload, $status);
                $this->updateStatus->infoUserLain($data, $payload);
                break;

            case 'Direktur Operasional':
                if ($status == 'Approve') {
                    $payload['jabatan_next'] = 'SDM';
                    $payload['status_akhir'] = 'Selesai';
                }

                if ($status != 'Approve') {
                    $this->updateStatus->infoStatusEnd($data, $payload);
                }

                $this->updateStatus->updateStatus($request, $data, $payload, $status);
                $this->updateStatus->infoStatusEndDouble($data, $payload);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) ' . $status . ' Pengajuan Insentif AO!';
        $this->LogActivity($data, $LogAksi);

        return redirect(route('ao.index'))->with('AlertSuccess', "Berhasil Memperbaruhi Status!");
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
}
