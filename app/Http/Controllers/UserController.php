<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cabang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderby('nama', 'asc')->get();
        $jumlah_user = $data->count();
        return view(
            'user.user',
            compact('data', 'jumlah_user'),
            [
                "title" => "Daftar Kontak"
            ],
            [
                'data' => $data
            ]
        );
    }

    // search
    public function search(Request $request)
    {
        $data = User::where('nama', 'Like', '%%' . $request->cari . '%%')
            ->orWhere('jabatan', 'Like', '%%' . $request->cari . '%%')
            ->orderby('nama', 'asc')
            ->get();
        $jumlah_user = $data->count();
        return view(
            'user.user',
            compact('data', 'jumlah_user'),
            [
                "title" => "Daftar Kontak"
            ],
            [
                'data' => $data
            ]
        );
    }

    public function show(User $user)
    {
        return view('user.chat', compact('user'), ['title' => 'Show Data']);
    }



    public function profil()
    {
        return view('user.profile', [
            "title" => "My Profile"
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|max:5024',
        ], [
            // PESAN ERROR
            'gambar.image' => 'File Harus Berformat Gambar!',
            'gambar.max' => 'File Terlalu Besar! Maximal 5 MB',
        ]);


        //mengambil data file yang diupload
        $gambar = $request->file('gambar');
        //mengambil nama file
        $fileName = $gambar->getClientOriginalName();
        //memindahkan file ke folder tujuan
        $gambar->move('file_upload/foto profil', $fileName);
        // $gambar->storeAs('file_upload',$gambar->getClientOriginalName());

        DB::table('users')->where('id', Auth::user()->id)
            ->update([
                'gambar' => $fileName,
                'updated_at' => now(),
            ]);

        return redirect('/home')->with('status', 'Foto Profil Berhasil Diubah!');
    }
}
