<?php

namespace App\Http\Controllers\TSI;

use App\Http\Controllers\Controller;
use App\Models\TSI\Barang;
use App\Models\TSI\PemeliharaanHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemeliharaanHistoryController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->jabatan == 'TSI') {
            $awal = Carbon::parse($request->min)->startOfDay();
            $akhir = Carbon::parse($request->max)->endOfDay();
            $id_cabang = auth()->user()->id_cabang;
            $barang = Barang::orderBy('created_at', 'desc')->get();

            if (request()->ajax()) {
                if (!empty($request->min)) {
                    $data = PemeliharaanHistory::whereBetween('created_at', [$awal, $akhir])
                        ->orderBy('created_at', 'desc')->get();
                } else {
                    $data = PemeliharaanHistory::orderBy('created_at', 'desc')->get();
                }

                return DataTables()->of($data)
                    ->addColumn('id_cabang', function ($data) {
                        return $data->cabang->cabang;
                    })
                    ->addColumn('action', function ($data) {
                        $button = '<a data-toggle="modal" data-target="#myModal' . $data->id_pemeliharaan_history . '" id="' . $data->id_pemeliharaan_history . '"
                                            class="btn btn-info btn-sm detail_data" data-kode_form="' . $data->kode_form . '">
                                            <span class="icon text-white-50">
                                            <i class="fa fa-eye"></i>
                                            </span>
                                        </a>';
                        $button .= '&nbsp;';
                        $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_pemeliharaan_history . '" id="' . $data->id_pemeliharaan_history . '"
                                        class="btn btn-warning btn-sm edit" data-kode_form="' . $data->kode_form . '">
                                    <i class="fa fa-edit"></i></a>';
                        $button .= '&nbsp;';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('Page.Pemeliharaan-History.index', compact('barang'), ['title' => 'Pemeliharaan History']);
        } else {
            return view('errors.minimal');
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = new PemeliharaanHistory();
        $data->id_cabang = $request->cabang;
        $data->kode_inventaris = $request->kode_inventaris;
        $data->detail_kerusakan = $request->detail_kerusakan;
        $data->detail_perbaikan = $request->detail_perbaikan;
        $data->tgl_dilaksanakan = now();
        $data->save();

        return redirect()->back()->with('AlertSuccess', "Perangkat Berhasil Disimpan!");
    }


    public function show(PemeliharaanHistory $pemeliharaanHistory)
    {
        $history = $pemeliharaanHistory;
        return view('Page.Pemeliharaan-History.show', compact('history'), ['title' => 'show data']);
    }


    public function edit(PemeliharaanHistory $pemeliharaanHistory)
    {
        return response()->json([
            'status' => 200,
            'data' => $pemeliharaanHistory
        ]);
    }


    public function update(Request $request, PemeliharaanHistory $pemeliharaanHistory)
    {
        $pemeliharaanHistory->id_cabang = $request->cabang_edit;
        $pemeliharaanHistory->kode_inventaris = $request->kode_inventaris_edit;
        $pemeliharaanHistory->detail_kerusakan = $request->detail_kerusakan_edit;
        $pemeliharaanHistory->detail_perbaikan = $request->detail_perbaikan_edit;
        $pemeliharaanHistory->save();

        return redirect()->back()->with('AlertSuccess', "Perangkat Berhasil Diubah!");
    }


    public function destroy(PemeliharaanHistory $pemeliharaanHistory)
    {
        //
    }
}
