<?php

namespace App\Http\Controllers\Insentif;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\MasterInsentif\InsPembagian;
use App\Models\MasterInsentif\InsPenyelesaian;
use App\Models\MasterInsentif\InsSurtug;
use App\Models\MasterInsentif\InsSurtugDeb;
use App\Services\Insentif\PembagianServices;
use App\Services\UpdateStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InsentifPenyelesaianController extends Controller
{
    protected $pembagianServices, $updateStatus;

    private $subjek = 'Pengajuan Insentif Penyelesaian NPL';
    private $subjek_status = 'Status | Pengajuan Insentif Penyelesaian NPL';

    public function __construct(PembagianServices $pembagianServices, UpdateStatus $updateStatus)
    {
        $this->pembagianServices = $pembagianServices;
        $this->updateStatus = $updateStatus;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->min)->endOfDay();
        $kode = $request->kode;

        if ($request->ajax()) {
            return $this->pembagianServices->index($kode, $user, $awal, $akhir, $request);
        }

        return view('Page-Insentif-Penyelesaian.index', [
            'title' => 'Insentif Penyelesaian'
        ]);
    }

    public function getNamaForm(Request $request)
    {
        $search = $request->get('q');
        $kode = $request->get('k');

        $surtug = InsSurtug::where('id_cabang', auth()->user()->id_cabang)
            ->where('kode_form', $kode)
            ->first();


        $data = InsSurtugDeb::where('id_surtug', $surtug->id)
            ->where('nama', 'LIKE', "%{$search}%")
            ->orderBy('nama', 'asc')
            ->limit(20) // Batasi hanya mengambil 20 data teratas yang cocok
            ->pluck('nama');

        return response()->json($data);
    }


    public function getDetailForm(Request $request)
    {
        $search = $request->get('q');
        $kode = $request->get('k');

        $surtug = InsSurtug::where('id_cabang', auth()->user()->id_cabang)
            ->where('kode_form', $kode)
            ->first();


        $data = InsSurtugDeb::where('id_surtug', $surtug->id)
            ->where('nama', 'LIKE', "%{$search}%")
            ->orderBy('nama', 'asc')
            ->first();

        return response()->json($data);
    }


    public function create()
    {
        return view('Page-Insentif-Penyelesaian.create-edit', [
            'title' => 'Tambah Penyelesaian NPL',
            'tipe' => 'create',
            'penyelesaian' => null,
            'pembagian' => null
        ]);
    }


    public function store(Request $request)
    {
        $data = $this->pembagianServices->store($request);

        $payload = [
            'url' => route('penyelesaian.index'),
            'title' => 'Terdapat Form Pengajuan Baru!',
            'message' => 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!',
            'subjek' => $this->subjek,
            'subjek_status' => $this->subjek_status,
            'jabatan_next' => "Pimpinan Cabang",
            'status_akhir' => 'Proses',
        ];
        $this->updateStatus->updateStatus($request, $data, $payload, 'PROSES');

        // Log Activity
        $LogAksi = '(+) Data Pengajuan Penyelesaian NPL';
        $this->LogActivity($data, $LogAksi);

        return redirect(route('penyelesaian.index'))->with('AlertSuccess', "Pengajuan Berhasil Dikirim!");
    }


    public function edit($id)
    {
        $ids = base64_decode($id);

        $penyelesaian = InsPenyelesaian::findOrFail($ids);
        $pembagian = InsPembagian::where('id_ins_penyelesaian', $ids)->get();

        return view('Page-Insentif-Penyelesaian.create-edit', [
            'title' => 'Edit Penyelesaian NPL',
            'tipe' => 'edit',
            'penyelesaian' => $penyelesaian,
            'pembagian' => $pembagian
        ]);
    }


    public function update(Request $request, $id)
    {
        $ids = base64_decode($id);

        $data = $this->pembagianServices->update($request, $ids);

        $LogAksi = '(u) Data Pengajuan Penyelesaian NPL';
        $this->LogActivity($data, $LogAksi);

        return redirect(route('penyelesaian.index'))->with('AlertSuccess', 'Data Berhasil Diupdate!');
    }


    public function show($id)
    {
        $insPenyelesaian = InsPenyelesaian::findOrFail($id);
        $pembagian = InsPembagian::where('id_ins_penyelesaian', $insPenyelesaian->id)->get();

        return view('Page-Insentif-Penyelesaian.show', [
            'penyelesaian' => $insPenyelesaian,
            'pembagian' => $pembagian
        ]);
    }


    public function getStatus(Request $request, $id, $status)
    {
        $ids = Crypt::decrypt($id);
        $data = InsPenyelesaian::findOrFail($ids);
        $jabatan = auth()->user()->jabatan;

        $payload = [
            'url' => route('penyelesaian.index'),
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
                    $payload['status_akhir'] = 'Selesai';
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
                    $payload['status_akhir'] = 'Selesai';
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
                    $payload['status_akhir'] = 'Selesai';
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
                    $payload['status_akhir'] = 'Selesai';
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
        $LogAksi = '(cs) ' . $status . ' Pengajuan Penyelesaian NPL!';
        $this->LogActivity($data, $LogAksi);

        return redirect(route('penyelesaian.index'))->with('AlertSuccess', "Berhasil Memperbaruhi Status!");
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
