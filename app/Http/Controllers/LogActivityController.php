<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Notifikasi\Notifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {
        $nama = Auth::user()->nama;
        $email = Auth::user()->email;
        $id_cabang = Auth::user()->id_cabang;
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();

        if (request()->ajax()) {
            if (!empty($request->min)) {
                $data = LogActivity::where('id_cabang', $id_cabang)
                    ->where('email', $email)
                    ->where('nama', $nama)
                    ->whereBetween('created_at', [$awal, $akhir])
                    ->orderBy('created_at', 'desc')->get();
            } else {
                $data = LogActivity::where('id_cabang', $id_cabang)
                    ->where('email', $email)
                    ->where('nama', $nama)
                    ->orderBy('created_at', 'desc')->get();
            }

            return DataTables()->of($data)
                ->addColumn('id_cabang', function ($data) {
                    return $data->cabang->cabang;
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('LogActivity.log-activity', ['title' => 'Log Activity']);
    }


    public function Pemberitahuan()
    {
        return view('LogActivity.pemberitahuan', ['title' => 'Pusat Pemberitahuan']);
    }


    public function MarkAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect('pemberitahuan')->with('AlertSuccess', "Pemberitahuan Berhasil Ditandai Sebagai Sudah Dibaca Semua!");
    }
}
