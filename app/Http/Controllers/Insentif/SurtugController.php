<?php

namespace App\Http\Controllers\Insentif;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\MasterInsentif\InsSurtug;
use App\Models\MasterInsentif\InsSurtugDeb;
use App\Models\User;
use App\Services\EmailServices;
use App\Services\Insentif\SurtugServices;
use App\Services\StatusAndLogServices;
use App\Services\UpdateStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SurtugController extends Controller
{
    protected $surtugServices, $updateStatus, $emailservices;

    private $subjek = 'Pengajuan Surat Tugas NPL';
    private $subjek_status = 'Status | Pengajuan Surat Tugas NPL';

    public function __construct(SurtugServices $surtugServices, UpdateStatus $updateStatus, EmailServices $emailservices)
    {
        $this->surtugServices = $surtugServices;
        $this->updateStatus = $updateStatus;
        $this->emailservices = $emailservices;
    }



    public function index(Request $request)
    {
        $user = Auth::user();
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();
        $kode = $request->kode;

        if ($request->ajax()) {
            return $this->surtugServices->index($kode, $user, $awal, $akhir, $request);
        }


        return view('Page-Insentif-Surtug.index', [
            'title' => 'Surat Tugas NPL'
        ]);
    }


    public function getKodeForm(Request $request)
    {
        $search = $request->get('q');

        $data = InsSurtug::where('id_cabang', auth()->user()->id_cabang)
            ->where('kode_form', 'LIKE', "%{$search}%")
            ->orderBy('kode_form', 'asc')
            ->limit(20) // Batasi hanya mengambil 20 data teratas yang cocok
            ->pluck('kode_form');

        return response()->json($data);
    }


    public function create()
    {
        return view('Page-Insentif-Surtug.create-edit', [
            'title' => 'Tambah Surat Tugas NPL',
            'tipe' => 'create',
            'surtug' => null,
            'debsur' => null
        ]);
    }


    public function store(Request $request)
    {
        $data = $this->surtugServices->store($request);

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
        $LogAksi = '(+) Data Pengajuan Surtug (Surat Tugas)';
        $this->LogActivity($data, $LogAksi);

        return redirect(route('surtug.index'))->with('AlertSuccess', "Pengajuan Berhasil Dikirim!");
    }


    public function show(InsSurtug $surtug)
    {
        $debsur = InsSurtugDeb::where('id_surtug', $surtug->id)->orderBy('nama', 'asc')->get();

        return view('Page-Insentif-Surtug.show', [
            'surtug' => $surtug,
            'debsur' => $debsur
        ]);
    }


    public function edit($id)
    {
        $ids = base64_decode($id);

        $surtug = InsSurtug::findOrFail($ids);
        $debsur = InsSurtugDeb::where('id_surtug', $ids)->orderBy('nama', 'Asc')->get();

        return view('Page-Insentif-Surtug.create-edit', [
            'title' => 'Tambah Surat Tugas NPL',
            'tipe' => 'edit',
            'surtug' => $surtug,
            'debsur' => $debsur,
        ]);
    }


    public function update(Request $request, $id)
    {
        $ids = base64_decode($id);

        $data = $this->surtugServices->update($request, $ids);

        // Log Activity
        $LogAksi = '(u) Data Pengajuan Surtug (Surat Tugas)';
        $this->LogActivity($data, $LogAksi);

        return redirect(route('surtug.index'))->with('AlertSuccess', "Pengajuan Berhasil DiUbah!");
    }


    public function getStatus(Request $request, $id, $status)
    {
        $ids = Crypt::decrypt($id);
        $data = InsSurtug::where('id', $ids)->first();
        $jabatan = auth()->user()->jabatan;

        switch ($jabatan) {
            case 'Pimpinan Cabang':
                // pemberitahuan database
                $payload = [
                    'url' => route('surtug.index'),
                    'title' => 'Terdapat Form Pengajuan Baru!',
                    'message' => 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!',
                    'subjek' => $this->subjek,
                    'subjek_status' => $this->subjek_status,
                    'jabatan_next' => null,
                    'status_akhir' => 'Selesai',
                ];
                $this->updateStatus->updateStatus($request, $data, $payload, $status);

                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) ' . $status . ' Pengajuan Surtug (Surat Tugas)';
        $this->LogActivity($data, $LogAksi);

        return redirect(route('surtug.index'))->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
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
