<?php

namespace App\Http\Controllers;

use App\Models\CabangEmail;
use App\Models\LogActivity;
use App\Models\ShareBiaya;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SharebiayaController extends Controller
{
    public function index(Request $request)
    {
        $jabatan = Auth::user()->jabatan;
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();

        if (request()->ajax()) {
            if (!empty($request->min)) {
                $data = ShareBiaya::whereBetween('tgl_transaksi', [$awal, $akhir])
                    ->OrderBy('created_at', 'DESC')->get();
            } else {
                $data = ShareBiaya::OrderBy('created_at', 'DESC')->get();
            }

            return datatables()->of($data)
                ->addColumn('tgl_transaksi', function ($data) {
                    return $data->tgl_transaksi->translatedFormat('d M Y');
                })
                ->addColumn('nominal', function ($data) {
                    return  $data->nominal;
                })
                ->addColumn('file', function ($data) {
                    if ($data->file_lampiran != NULL) {
                        return '<a href="' . asset('file_upload/ShareBiaya/' . $data->file_lampiran) . '" target="_blank">' . $data->file_lampiran . '</a>';
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function ($data) {
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id . '" id="' . $data->id . '"
                                        class="btn btn-info btn-sm detail_data" data-kc="' . $data->kc . '">
                                        <span class="icon text-white-50">
                                        <i class="fa fa-eye"></i>
                                        </span>
                                    </a>';
                    $button .= '&nbsp;';
                    $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id . '" id="' . $data->id . '"
                                        class="btn btn-warning btn-sm edit" data-kc="' . $data->kc . '">
                                    <i class="fa fa-edit"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        if ($jabatan == 'Pembukuan') {
            return view('Page.ShareBiaya.index', [
                'title' => 'Daftar Transaksi Share Biaya'
            ]);
        } else {
            return view('welcome');
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $share = new ShareBiaya();
        // Konversi array menjadi string dengan koma sebagai pemisah
        // $kc_save = is_array($request->kc) && count($request->kc) > 1 ? implode(', ', $request->kc) : $request->kc[0];
        $kcList = $request->kc; // Tangkap input tanpa mengubah langsung $request

        if (is_array($kcList)) {
            $count = count($kcList);

            if ($count > 1) {
                $lastItem = array_pop($kcList); // Ambil elemen terakhir
                $kc_save = implode(', ', $kcList) . ' dan ' . $lastItem; // Format sesuai kebutuhan
            } else {
                $kc_save = $kcList[0]; // Jika hanya satu item, simpan langsung
            }
        }

        $share->kc = $kc_save;

        $share->tgl_transaksi = $request->tgl_transaksi;
        $share->nominal = $request->nominal;
        $share->keterangan = $request->keterangan;
        if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');
            $fileName = $file->getClientOriginalName();
            $file->move('file_upload/ShareBiaya', $fileName);
            $share->file_lampiran = $fileName;
        } else {
            $share->file_lampiran = NULL;
        }
        $share->creator = auth()->user()->nama;
        $share->save();

        // Log Activity
        $LogAksi = '(+) Share Biaya';
        $this->LogActivity($share, $LogAksi);

        // Send email
        if ($kc_save == 'All Cabang') {
            $penerima = CabangEmail::whereNot('id_cabang', 0)->whereNot('id_cabang', 20)->get();
            foreach ($penerima as $cabang) {
                $this->SendMail($share, $cabang);
            }
        } else {
            foreach ($request->kc as $cabang) {
                $penerima = CabangEmail::where('cabang', $cabang)->first();
                $this->SendMail($share, $penerima);
            }
        }



        return redirect()->route('share-biaya.index')->with('AlertSuccess', 'Data berhasil ditambahkan dan dikirim Email!');
    }


    public function show(ShareBiaya $shareBiaya)
    {
        return view('Page.ShareBiaya.show', compact('shareBiaya'));
    }


    public function edit(ShareBiaya $shareBiaya)
    {
        $file = '<a href="' . asset('file_upload/ShareBiaya/' . $shareBiaya->file_lampiran) . '" target="_blank">' . $shareBiaya->file_lampiran . '</a>';
        $tgl = $shareBiaya->tgl_transaksi->translatedFormat('d F Y');
        return response()->json([
            'status' => 200,
            'data' => $shareBiaya,
            'file' => $file,
            'tgl' => $tgl
        ]);
    }


    public function update(Request $request, ShareBiaya $shareBiaya)
    {
        $kcList = $request->kc; // Tangkap input tanpa mengubah langsung $request

        if (is_array($kcList)) {
            $count = count($kcList);

            if ($count > 1) {
                $lastItem = array_pop($kcList); // Ambil elemen terakhir
                $kc_save = implode(', ', $kcList) . ' dan ' . $lastItem; // Format sesuai kebutuhan
            } else {
                $kc_save = $kcList[0]; // Jika hanya satu item, simpan langsung
            }
        }

        $shareBiaya->kc = $kc_save;
        if (!empty($request->tgl_transaksi)) {
            $shareBiaya->tgl_transaksi = $request->tgl_transaksi;
        }
        if (!empty($request->nominal)) {
            $shareBiaya->nominal = $request->nominal;
        }
        if (!empty($request->file_lampiran)) {
            if ($request->hasFile('file_lampiran')) {
                $file = $request->file('file_lampiran');
                $fileName = $file->getClientOriginalName();
                $file->move('file_upload/ShareBiaya', $fileName);
                $shareBiaya->file_lampiran = $fileName;
            }
        } else {
            $shareBiaya->file_lampiran = NULL;
        }
        if (!empty($request->keterangan)) {
            $shareBiaya->keterangan = $request->keterangan;
        }
        $shareBiaya->save();

        // Log Activity
        $LogAksi = '(u) Share Biaya';
        $this->LogActivity($shareBiaya, $LogAksi);

        return redirect()->route('share-biaya.index')->with('AlertSuccess', 'Data berhasil diupdate dan dikirim Email!');
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
        $log->kode_form = $data->kc;
        $log->created_at = now();
        $log->save();
    }

    private function SendMail($share, $userPenerima)
    {
        Mail::send('email.notif.notif-share', [
            'kc' => $share->kc,
            'tgl_transaksi' => $share->tgl_transaksi->translatedFormat('d F Y'),
            'nominal' => $share->nominal,
            'keterangan' => $share->keterangan,
            'file' =>  $share->file_lampiran,
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email_kaops);
            $message->subject('REMINDER SHARE BIAYA');
        });

        // $data, function ($message) {
        //     $message->from('john@johndoe.com', 'John Doe');
        //     $message->sender('john@johndoe.com', 'John Doe');
        //     $message->to('john@johndoe.com', 'John Doe');
        //     $message->cc('john@johndoe.com', 'John Doe');
        //     $message->bcc('john@johndoe.com', 'John Doe');
        //     $message->replyTo('john@johndoe.com', 'John Doe');
        //     $message->subject('Subject');
        //     $message->priority(3);
        //     $message->attach('pathToFile');
        // });
    }
}
