<?php

namespace App\Http\Controllers\TSI;

use App\Http\Controllers\Controller;
use App\Models\TSI\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();
        $level = auth()->user()->level;
        $id_cabang = auth()->user()->id_cabang;

        if (request()->ajax()) {
            if ($level == 'SUPER USER' || $level == 'DIREKTUR') {
                if (!empty($request->min)) {
                    $data = Barang::whereBetween('created_at', [$awal, $akhir])
                        ->orderBy('created_at', 'desc')->get();
                } else {
                    $data = Barang::orderBy('created_at', 'desc')->get();
                }
            } else {
                if (!empty($request->min)) {
                    $data = Barang::where('id_cabang', $id_cabang)->whereBetween('created_at', [$awal, $akhir])
                        ->orderBy('created_at', 'desc')->get();
                } else {
                    $data = Barang::where('id_cabang', $id_cabang)->orderBy('created_at', 'desc')->get();
                }
            }

            return DataTables()->of($data)
                ->addColumn('id_cabang', function ($data) {
                    return $data->cabang->cabang;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id_barang_elektronik . '" id="' . $data->id_barang_elektronik . '"
                                            class="btn btn-info btn-sm detail_data" data-kode_form="' . $data->kode_form . '">
                                            <span class="icon text-white-50">
                                            <i class="fa fa-eye"></i>
                                            </span>
                                        </a>';
                    $button .= '&nbsp;';
                    if (auth()->user()->jabatan == 'TSI') {
                        $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_barang_elektronik . '" id="' . $data->id_barang_elektronik . '"
                                            class="btn btn-warning btn-sm edit" data-kode_form="' . $data->kode_form . '">
                                        <i class="fa fa-edit"></i></a>';
                        $button .= '&nbsp;';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('Page.Barang.index', ['title' => 'Barang']);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $cabang = DB::connection('ksb_sdm') // Assuming 'mysql' is the default connection in your database.php configuration
            ->table('cabang')
            // ->select('kode', 'nama_pincab') // jika ada select tertentu diakhiri ->first() atau get()
            ->where('id_cabang', $request->cabang)
            ->value('kode_brg');
        // dd($cabang);
        switch ($request->jns_barang) {
            case 'Komputer':
                $brg = '01';
                break;
            case 'Laptop':
                $brg = '02';
                break;
            case 'Printer':
                $brg = '03';
                break;
            case 'Lainnya (Jaringan)':
                $brg = '04';
                break;
        }

        $now = Carbon::now();
        $thn = $now->year;
        $bln = $now->format('m');

        $cek = Barang::where('kode_barang', 'like', $cabang . '-' . $thn . '%')->count();

        if ($cek == 0) {
            $urut = 1;
        } else {
            $ambil = Barang::where('kode_barang', 'like', $cabang . '-' . $thn . '%')->latest()->first()->kode_barang;
            $urut = (int)substr($ambil, -3) + 1;
        }

        $urut = str_pad($urut, 3, '0', STR_PAD_LEFT);
        $nomer = $cabang . '-' . $thn . $bln . $brg . '-' . $urut;

        $data = new Barang();
        $data->id_cabang = $request->cabang;
        $data->kode_inventaris = $request->kode_inventaris;
        if ($request->kode_barang == '-') {
            $data->kode_barang = $nomer;
        } else {
            $data->kode_barang = $request->kode_barang;
        }
        $data->jns_barang = $request->jns_barang;
        $data->merk = $request->merk;
        $data->type = $request->type;
        $data->posisi = $request->posisi;
        $data->ip_address = $request->ip_address;
        $data->speksifikasi = $request->speksifikasi;
        $data->tgl_pembelian = $request->tgl_pembelian;
        $data->save();

        return redirect()->back()->with('AlertSuccess', "Berhasil !");
    }


    public function show(Barang $barang)
    {
        return view('Page.Barang.show', compact('barang'), ['title' => 'Show Data']);
    }


    public function edit(Barang $barang)
    {
        return response()->json([
            'status' => 200,
            'data' => $barang
        ]);
    }


    public function update(Request $request, Barang $barang)
    {
        $barang->id_cabang = $request->cabang_edit;
        $barang->kode_inventaris = $request->kode_inventaris_edit;
        $barang->kode_barang = $request->kode_barang_edit;
        $barang->jns_barang = $request->jns_barang_edit;
        $barang->merk = $request->merk_edit;
        $barang->type = $request->type_edit;
        $barang->posisi = $request->posisi_edit;
        $barang->ip_address = $request->ip_address_edit;
        $barang->speksifikasi = $request->speksifikasi_edit;
        $barang->tgl_pembelian = $request->tgl_pembelian_edit;
        $barang->save();

        return redirect()->back()->with('AlertSuccess', "Berhasil !");
    }


    public function destroy(Barang $barang)
    {
        //
    }
}
