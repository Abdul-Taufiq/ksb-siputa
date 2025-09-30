<?php

namespace App\Http\Controllers\Inventaris;

use App\Http\Controllers\Controller;
use App\Models\Inventaris\{BarangBaruPengganti, Diganti, InventarisPengganti};
use App\Models\LogActivity;
use App\Models\TSI\PemeliharaanHistory;
use App\Models\User;
use App\Notifications\NotifikasiPengajuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Crypt, DB, Mail, Notification};

class InventarisPenggantiController extends Controller
{
    public function index(Request $request)
    {
        $jabatan = Auth::user()->jabatan;
        $id_cabang = Auth::user()->id_cabang;
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();
        $reqCabang = $request->id_cabang;
        $kode = $request->kode;

        // pemberitahuan sudah dibaca
        if ($kode != null) {
            auth()->user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        }

        if (request()->ajax()) {
            switch ($jabatan) {
                # kaops ...
                case 'Kasi Operasional':
                case 'Kasi Komersial':
                case 'Analis Area':
                case 'Staf Area':
                case 'Sekretariat':
                case 'Kepala Kantor Kas':
                case 'Pimpinan Cabang':
                    if (!empty($request->kode)) {
                        $data = InventarisPengganti::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = InventarisPengganti::where('id_cabang', $id_cabang)
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = InventarisPengganti::where('id_cabang', $id_cabang)
                                ->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                # Pimpinan Cabang ...
                case 'Pembukuan':
                case 'Internal Audit':
                    if (!empty($request->kode)) {
                        $data = InventarisPengganti::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = InventarisPengganti::whereIn('status_pincab', ['Approve', '--'])
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->get();
                        } elseif (!empty($request->cari)) {
                            $data = InventarisPengganti::where('kode_form', $request->cari)
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = InventarisPengganti::whereIn('status_pincab', ['Approve', '--'])
                                ->OrderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'Direktur Operasional':
                case 'Direktur Utama':
                    if (!empty($request->kode)) {
                        $data = InventarisPengganti::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = InventarisPengganti::where('status_pembukuan', "Edited")
                                ->orwhere('status_pembukuan', 'Approve')
                                ->orwhere('status_tsi', '--')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = InventarisPengganti::where('status_pembukuan', 'Approve')->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                case 'TSI':
                    if (!empty($request->kode)) {
                        $data = InventarisPengganti::where('kode_form', $kode)
                            ->OrderBy('created_at', 'desc')->get();
                    } else {
                        if (!empty($request->min)) {
                            $data = InventarisPengganti::where('status_dirops', 'Approve')
                                ->orWhere('status_pembukuan', 'Approve')
                                ->whereBetween('created_at', [$awal, $akhir])
                                ->when($reqCabang != 99, fn($query) => $query->where('id_cabang', $reqCabang))
                                ->orderBy('created_at', 'desc')->get();
                        } else {
                            $data = InventarisPengganti::where('status_dirops', 'Approve')->orWhere('status_pembukuan', 'Approve')->orderBy('created_at', 'desc')->get();
                        }
                    }
                    break;
                default:
                    $data = ['tidak ada data'];
                    break;
            }

            return DataTables()->of($data)
                ->addColumn('id_cabang', function ($data) {
                    return $data->cabang->cabang;
                })
                ->addColumn('status', function ($data) {
                    $statusDropdown = $this->statusNothing($data); //menyimpan ke variable dari status private ke table sini

                    $status = '';
                    switch (auth()->user()->jabatan) {
                        case 'Kasi Operasional':
                        case 'Kasi Komersial':
                        case 'Analis Area':
                        case 'Staf Area':
                        case 'Sekretariat':
                        case 'Kepala Kantor Kas':
                            if ($data->status_akhir == 'Selesai') {
                                $status .= '<a class="btn btn-success btn-sm disabled">Selesai</a>';
                            } elseif ($data->status_dirops == 'Not Needed' && $data->jns_pembelian == 'Pembelian Dengan Speksifikasi Cabang') {
                                $status = '';
                                $status .= '<div class="dropdown">';
                                $status .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                $status .= 'Nothing';
                                $status .= '</button>';
                                $status .= '<div class="dropdown-menu" aria-labelledby="statusDropdown">';
                                $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_inventaris_pengganti) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
                                $status .= '</div>';
                                $status .= '</div>';
                            } elseif ($data->status_dirops == 'Approve' && $data->jns_pembelian == 'Pembelian Dengan Speksifikasi Cabang') {
                                $status = '';
                                $status .= '<div class="dropdown">';
                                $status .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                $status .= 'Nothing';
                                $status .= '</button>';
                                $status .= '<div class="dropdown-menu" aria-labelledby="statusDropdown">';
                                $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_inventaris_pengganti) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
                                $status .= '</div>';
                                $status .= '</div>';
                            } elseif ($data->status_dirops == 'Approve' && $data->jns_pembelian == 'Pembelian Dengan Speksifikasi KPM' && $data->kategori_barang != 'Elektronik') {
                                $status = '';
                                $status .= '<div class="dropdown">';
                                $status .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                $status .= 'Nothing';
                                $status .= '</button>';
                                $status .= '<div class="dropdown-menu" aria-labelledby="statusDropdown">';
                                $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_inventarispengganti) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
                                $status .= '</div>';
                                $status .= '</div>';
                            } else {
                                $status .= '<a class="btn btn-success btn-sm disabled">Terkirim</a>';
                            }
                            break;

                        case 'Pimpinan Cabang':
                            $jabatan = $data->status_pincab;
                            $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;

                        case 'Pembukuan':
                            $jabatan = $data->status_pembukuan;
                            $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                            return $statusAfter;
                            break;

                        case 'Direktur Operasional':
                            // if ($data->status_tsi != null) {
                            //     $jabatan = $data->status_dirops;
                            //     $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                            //     return $statusAfter;
                            // } else {
                            $status .= '<a class="btn btn-info btn-sm disabled">NotNeeded</a>';
                            // }
                            break;

                        case 'Direktur Utama':
                            if ($data->status_dirops != null) {
                                $status .= '<a class="btn btn-success btn-sm disabled">Finish</a>';
                            } else if ($data->status_tsi != null) {
                                $jabatan = $data->status_dirut;
                                $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                                return $statusAfter;
                            } else {
                                $status .= '<a class="btn btn-warning btn-sm disabled">NotYet</a>';
                            }
                            break;

                        case 'TSI':
                            $jabatan = $data->status_tsi;
                            if ($data->jns_pembelian == 'Pembelian Dengan Speksifikasi KPM' && $data->kategori_barang == 'Elektronik') {
                                if ($data->status_dirut == 'Approve') {
                                    $statusAfter = $this->statusAfter($data, $jabatan, $statusDropdown);
                                    return $statusAfter;
                                } elseif ($jabatan == 'Sended') {
                                    $status .= '<a class="btn btn-info btn-sm disabled">Sended</a>';
                                } elseif ($data->status_tsi == 'Not Needed') {
                                    $status .= '<a class="btn btn-danger btn-sm disabled">NotNeeded</a>';
                                } else {
                                    $status .= '<a class="btn btn-warning btn-sm disabled">NotYet</a>';
                                }
                            } else {
                                $status .= '<a class="btn btn-danger btn-sm disabled">NotNeeded</a>';
                            }
                            break;
                    }

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a data-toggle="modal" data-target="#myModal' . $data->id_inventaris_pengganti . '" id="' . $data->id_inventaris_pengganti . '"
                                        class="btn btn-info btn-sm detail_data" data-kode_form="' . $data->kode_form . '">
                                        <span class="icon text-white-50">
                                        <i class="fa fa-eye"></i>
                                        </span>
                                    </a>';
                    $button .= '&nbsp;';

                    # code pembagian user Aksi
                    switch (auth()->user()->jabatan) {
                        # Kaops...
                        case 'Kasi Operasional':
                        case 'Kasi Komersial':
                        case 'Analis Area':
                        case 'Staf Area':
                        case 'Sekretariat':
                        case 'Kepala Kantor Kas':
                            if ($data->status_pincab == "Approve" || $data->status_pincab == "Reject" || $data->status_pembukuan != null) {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            } else {
                                $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_inventaris_pengganti . '" id="' . $data->id_inventaris_pengganti . '"
                                                class="btn btn-warning btn-sm edit" data-kode_form="' . $data->kode_form . '">
                                            <i class="fa fa-edit"></i></a>';
                                $button .= '&nbsp;';
                            }
                            break;
                        # Pincab...
                        case 'Pimpinan Cabang':
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                        # Pembukuan, Dirops & TSi...
                        case 'Pembukuan':
                        case 'Direktur Operasional':
                        case 'Direktur Utama':
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            break;
                        case 'TSI':
                            if ($data->jns_pembelian == 'Pembelian Dengan Speksifikasi KPM' && $data->kategori_barang == 'Elektronik') {
                                # code...
                                if ($data->status_tsi == "Approve" || $data->status_tsi == "Reject") {
                                    $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                                } else {
                                    $button .= '<a data-toggle="modal" data-target="#modalEdit' . $data->id_inventaris_pengganti . '" id="' . $data->id_inventaris_pengganti . '"
                                                    class="btn btn-warning btn-sm edit" data-kode_form="' . $data->kode_form . '">
                                                <i class="fa fa-edit"></i></a>';
                                    $button .= '&nbsp;';
                                }
                            } else {
                                $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="fa fa-edit"></i></a>';
                            }
                            break;
                    }
                    return $button;
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('Page.Inventaris_pengganti.index', ['title' => 'Pengajuan Inventaris Pengganti']);
    }


    public function create()
    {
        return view('Page.Inventaris_pengganti.create', ['title' => 'Tambah Pengajuan Inventaris Pengganti']);
    }


    public function store(Request $request)
    {
        $cabang = DB::connection('mysql') // Assuming 'mysql' is the default connection in your database.php configuration
            ->table('tb_cabang')
            // ->select('kode', 'nama_pincab') // jika ada select tertentu diakhiri ->first() atau get()
            ->where('id_cabang', auth()->user()->id_cabang)
            ->value('kode');
        // dd($cabang);
        $now = Carbon::now();
        $thn = $now->year;

        if ($thn == 2023) {
            $cek = 0;
        } else {
            $cek = InventarisPengganti::count();
        }

        if ($cek == 0) {
            $urut = 0001;
            $nomer = $cabang . '/INV-GNT/' . $thn . '/0001';
        } else {
            $ambil = InventarisPengganti::all()->last();
            $cekTahun = substr($ambil->kode_form, -9, 4);
            if ($cekTahun != $thn) {
                $urut = 0001;
                $nomer = $cabang . '/INV-GNT/' . $thn . '/0001';
            } else {
                $urut = substr($ambil->kode_form, -4, 10);
                $urut = (int)$urut + 1;
                $urut = str_pad($urut, 4, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                $nomer = $cabang . '/INV-GNT/' . $thn . '/' . $urut;
            }
        }

        $data = new InventarisPengganti();
        $data->kode_form = $nomer;
        $data->nama_kaops = auth()->user()->nama;
        $data->id_cabang = auth()->user()->id_cabang;
        $data->kategori_barang = $request->kategori_barang;
        $data->jns_pembelian = $request->jns_pembelian;
        $data->qty = $request->qty;
        $data->catatan = $request->catatan;
        $data->keterangan = $request->keterangan;
        $data->created_at = now();
        $data->save();

        if ($request->jns_pembelian == 'Pembelian Dengan Speksifikasi Cabang') {
            // data pembanding
            BarangBaruPengganti::where('id_inventaris_pengganti', $data->id_inventaris_pengganti)->delete();
            for ($i = 1; $i < 50; $i++) {
                if ($request->input('jns_barang_' . $i) != '') {
                    $barang = new BarangBaruPengganti();
                    $barang->id_inventaris_pengganti = $data->id_inventaris_pengganti;
                    $barang->kategori_barang = $request->kategori_barang;
                    $barang->jns_barang = $request->input('jns_barang_' . $i);
                    $barang->merk = $request->input('merk_' . $i);
                    $barang->type = $request->input('type_' . $i);
                    $barang->nama_toko = $request->input('nama_toko_' . $i);
                    $barang->harga = $request->input('harga_pembelian_' . $i);

                    // file uploud
                    // Mengelola file yang diunggah
                    if ($request->hasFile('file_detail_toko_' . $i)) {
                        $file = $request->file('file_detail_toko_' . $i);
                        $fileName = $file->getClientOriginalName();
                        $file->move('file_upload/barang_inventaris_pengganti', $fileName);
                        $barang->file_detail_toko = $fileName;
                    }
                    $barang->save();
                }
            }
        }

        for ($i = 1; $i < 50; $i++) {
            if ($request->input('kode_inventaris_' . $i) != '') {
                $diganti = new Diganti();
                $diganti->id_inventaris_pengganti = $data->id_inventaris_pengganti;
                $diganti->kode_inventaris = $request->input('kode_inventaris_' . $i);
                $diganti->nilai_buku_terakhir = $request->input('nilai_buku_terakhir_' . $i);
                $diganti->tgl_pembelian = Carbon::createFromFormat('d-m-Y', $request->input('tgl_pembelian_' . $i))->format('Y-m-d');
                $diganti->kondisi_akhir = $request->input('kondisi_terakhir_' . $i);
                $diganti->save();
            }
        }

        // Log Activity
        $LogAksi = '(+) Pengajuan Inventaris Pengganti Baru';
        $this->LogActivity($data, $LogAksi);
        // Send Email
        if (auth()->user()->jabatan == 'Analis Area' || auth()->user()->jabatan == 'Staf Area' || auth()->user()->jabatan == 'Sekretariat') {
            $data->update([
                'nama_pincab' => 'Ditarik Oleh User Pembukuan',
                'status_pincab' => '--',
                'tgl_status_pincab' => null,
            ]);

            $userPenerima = User::where('jabatan', 'Pembukuan')->get();
            $url = route('inventaris-pengganti.index');
            $title = 'Terdapat Form Pengajuan Baru!';
            $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
            $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
        } else {
            $userPenerima = User::where('id_cabang', auth()->user()->id_cabang)
                ->where('jabatan', 'Pimpinan Cabang')->first();
            $url = route('inventaris-pengganti.index');
            $title = 'Terdapat Form Pengajuan Baru!';
            $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
            $this->SendEmail($data, $userPenerima, $url, $title, $message);
        }

        return redirect('inventaris-pengganti')->with('AlertSuccess', "Pengajuan Inventaris Pengganti Baru Berhasil Dikirim!");
    }


    public function show(InventarisPengganti $inventarisPengganti)
    {
        $diganti = Diganti::where('id_inventaris_pengganti', $inventarisPengganti->id_inventaris_pengganti)->get();
        $barang = BarangBaruPengganti::where('id_inventaris_pengganti', $inventarisPengganti->id_inventaris_pengganti)->get();
        $perbaikan_histories = [];

        foreach ($diganti as $digantiItem) {
            $perbaikan_history = PemeliharaanHistory::where('kode_inventaris', $digantiItem->kode_inventaris)->get();
            $perbaikan_histories[] = $perbaikan_history;
        }

        return view('Page.Inventaris_pengganti.show', compact('inventarisPengganti', 'barang', 'diganti', 'perbaikan_histories'), ['title' => 'Show Data']);
    }



    public function Print($idEncrypt)
    {
        $inventarisPengganti = InventarisPengganti::where('id_inventaris_pengganti', $idEncrypt)->first();
        $diganti = Diganti::where('id_inventaris_pengganti', $idEncrypt)->get();
        $barang = BarangBaruPengganti::where('id_inventaris_pengganti', $idEncrypt)->get();
        $perbaikan_histories = [];

        foreach ($diganti as $digantiItem) {
            $perbaikan_history = PemeliharaanHistory::where('kode_inventaris', $digantiItem->kode_inventaris)->get();
            $perbaikan_histories[] = $perbaikan_history;
        }


        $pdf = Pdf::loadView(
            'Page.Inventaris_pengganti.print',
            compact('inventarisPengganti', 'barang', 'diganti', 'perbaikan_histories'),
            ['title' => 'Print']
        );
        $pdf->setPaper('A4', 'potrait')
            ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);
        return $pdf->stream('Data Form.' . $inventarisPengganti->kode_form . '.pdf');
    }


    public function edit(InventarisPengganti $inventarisPengganti)
    {
        $barang = BarangBaruPengganti::where('id_inventaris_pengganti', $inventarisPengganti->id_inventaris_pengganti)
            ->get();
        $diganti = Diganti::where('id_inventaris_pengganti', $inventarisPengganti->id_inventaris_pengganti)->get();
        $inventaris = $inventarisPengganti;

        if (auth()->user()->jabatan == 'TSI') {
            # code...
            return view(
                'Page.Inventaris_pengganti.modal-edit-tsi',
                compact('inventarisPengganti', 'barang', 'diganti'),
                ['title' => 'ddd']
            );
        } else {
            return view(
                'Page.Inventaris_pengganti.modal-edit',
                compact('inventarisPengganti', 'barang', 'diganti'),
                ['title' => 'ddd']
            );
        }
    }


    public function update(Request $request, InventarisPengganti $inventarisPengganti)
    {
        $data = $inventarisPengganti;
        $data->kategori_barang = $request->kategori_barang;
        $data->jns_pembelian = $request->jns_pembelian;
        $data->qty = $request->qty;
        $data->catatan = $request->catatan;
        $data->keterangan = $request->keterangan;
        $data->updated_at = now();
        $data->save();

        if ($request->jns_pembelian == 'Pembelian Dengan Speksifikasi Cabang') {
            // data pembanding
            BarangBaruPengganti::where('id_inventaris_pengganti', $data->id_inventaris_pengganti)->delete();
            for ($i = 1; $i < 50; $i++) {
                if ($request->input('jns_barang_' . $i) != '') {
                    if ($request->input('aksi_diganti_' . $i) != 'Hapus') {
                        $barang = new BarangBaruPengganti();
                        $barang->id_inventaris_pengganti = $data->id_inventaris_pengganti;
                        $barang->kategori_barang = $request->kategori_barang;
                        $barang->jns_barang = $request->input('jns_barang_' . $i);
                        $barang->merk = $request->input('merk_' . $i);
                        $barang->type = $request->input('type_' . $i);
                        $barang->nama_toko = $request->input('nama_toko_' . $i);
                        $barang->harga = $request->input('harga_pembelian_' . $i);

                        // file uploud
                        // Mengelola file yang diunggah
                        if ($request->hasFile('file_detail_toko_' . $i)) {
                            $file = $request->file('file_detail_toko_' . $i);
                            $fileName = $file->getClientOriginalName();
                            $file->move('file_upload/barang_inventaris_baru', $fileName);
                            $barang->file_detail_toko = $fileName;
                        } else {
                            $barang->file_detail_toko =  $request->input('detail_toko_old_' . $i);
                        }
                        $barang->save();
                    }
                }
            }
        }

        Diganti::where('id_inventaris_pengganti', $data->id_inventaris_pengganti)->delete();
        for ($i = 1; $i < 50; $i++) {
            if ($request->input('kode_inventaris_' . $i) != '') {
                if ($request->input('aksi_diganti_' . $i) != 'Hapus') {
                    # code...
                    $diganti = new Diganti();
                    $diganti->id_inventaris_pengganti = $data->id_inventaris_pengganti;
                    $diganti->kode_inventaris = $request->input('kode_inventaris_' . $i);
                    $diganti->nilai_buku_terakhir = $request->input('nilai_buku_terakhir_' . $i);
                    $diganti->tgl_pembelian = Carbon::createFromFormat('d-m-Y', $request->input('tgl_pembelian_' . $i))->format('Y-m-d');
                    $diganti->kondisi_akhir = $request->input('kondisi_terakhir_' . $i);
                    $diganti->save();
                }
            }
        }

        // Log Activity
        $LogAksi = '(u) Pengajuan Inventaris Pengganti Baru';
        $this->LogActivity($data, $LogAksi);

        return redirect()->back()->with('AlertSuccess', "Pengajuan Inventaris Pengganti Baru Berhasil DiPerbaruhi!");
    }



    public function UpdateTSI(Request $request, InventarisPengganti $inventarisPengganti)
    {
        $data = $inventarisPengganti;
        if (auth()->user()->jabatan == 'TSI') {
            $data->status_tsi = 'Sended';
            $data->tgl_status_tsi = now();
            $data->catatan_tsi = $request->catatan_tsi;
            $data->save();

            // data pembanding
            if ($request->input('jns_barang_1') != '') {
                BarangBaruPengganti::where('id_inventaris_pengganti', $data->id_inventaris_pengganti)->delete();
                for ($i = 1; $i < 50; $i++) {
                    if ($request->input('jns_barang_' . $i) != '') {
                        $barang = new BarangBaruPengganti();
                        $barang->id_inventaris_pengganti = $data->id_inventaris_pengganti;
                        $barang->kategori_barang = $data->kategori_barang;
                        $barang->jns_barang = $request->input('jns_barang_' . $i);
                        $barang->merk = $request->input('merk_' . $i);
                        $barang->type = $request->input('type_' . $i);
                        $barang->nama_toko = $request->input('nama_toko_' . $i);
                        $barang->harga = $request->input('harga_pembelian_' . $i);

                        // file uploud
                        // Mengelola file yang diunggah
                        if ($request->hasFile('file_detail_toko_' . $i)) {
                            $file = $request->file('file_detail_toko_' . $i);
                            $fileName = $file->getClientOriginalName();
                            $file->move('file_upload/barang_inventaris_pengganti', $fileName);
                            $barang->file_detail_toko = $fileName;
                        }

                        $barang->save();
                    }
                }
            }

            $userPenerima = User::where('jabatan', 'Direktur Operasional')->first();

            // pemberitahuan database
            $url = route('inventaris-pengganti.index');
            $title = 'Terdapat Form Pengajuan Baru!';
            $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
            $this->SendEmail($data, $userPenerima, $url, $title, $message);
        }

        // Log Activity
        $LogAksi = '(u) Pengajuan Inventaris Pengganti Baru';
        $this->LogActivity($data, $LogAksi);

        return redirect()->back()->with('AlertSuccess', "Pengajuan Inventaris Pengganti Baru Berhasil DiPerbaruhi!");
    }


    public function getBarang($Id)
    {
        $ids = Crypt::decrypt($Id);
        $barang = BarangBaruPengganti::where('id_inventaris_pengganti', $ids)->get();
        $barangForPincab = BarangBaruPengganti::where('id_inventaris_pengganti', $ids)->get();
        $inventaris = InventarisPengganti::where('id_inventaris_pengganti', $ids)->first();

        $hargaArray = [];
        foreach ($barangForPincab as $item) {
            $harga = str_replace(['Rp. ', '.'], '', $item->harga);
            $hargaArray[] = (int) $harga; // Konversi ke integer
        }

        if ($barangForPincab->isNotEmpty()) {
            # code...
            $terkecil = min($hargaArray);
        } else {
            # code...
            $terkecil = 0;
        }


        return response()->json([
            'status' => 200,
            'data' => $barang,
            'harga_terkecil' => $terkecil,
            'inventaris' => $inventaris
        ]);
    }




    // RESPON APPROVE STATUS PENGAJUAN
    public function ResponApprove(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = InventarisPengganti::where('id_inventaris_pengganti', $ids)->first();
        $jabatan = auth()->user()->jabatan;
        $nama = auth()->user()->nama;

        switch ($jabatan) {
            case 'Kasi Operasional':
            case 'Sekretariat':
                // file uploud
                $file = $request->file_detail_invoice;
                $fileName = $file->getClientOriginalName();
                $file->move('file_upload/barang_inventaris_pengganti/Dibeli', $fileName);

                $data->update([
                    'status_akhir' => 'Selesai',
                    'tgl_status_akhir' => now(),
                    'file_detail_invoice' => $fileName,
                ]);
                break;
            case 'Pimpinan Cabang':
                if ($data->jns_pembelian == 'Pembelian Dengan Speksifikasi Cabang') {
                    $barangForPincab = BarangBaruPengganti::where('id_inventaris_pengganti', $ids)->get();

                    $hargaArray = [];
                    foreach ($barangForPincab as $item) {
                        $harga = str_replace(['Rp. ', '.'], '', $item->harga);
                        $hargaArray[] = (int) $harga; // Konversi ke integer
                    }
                    $terkecil = min($hargaArray);

                    if ($terkecil < 1000000) {
                        # code...
                        $pembanding = BarangBaruPengganti::where('id_barang_pembanding_pengganti', $request->pembanding_dipilih)->update([
                            'dipilih' => 'True'
                        ]);

                        $data->update([
                            'nama_pincab' => $nama,
                            'status_pincab' => 'Approve',
                            'tgl_status_pincab' => now(),
                            'catatan_pimpin_cabang' => $request->catatan,
                            'status_akhir' => 'Selesai',
                            'status_pembukuan' => 'Not Needed',
                            'status_dirops' => 'Not Needed',
                            'status_tsi' => 'Not Needed',
                        ]);
                    } else {
                        # code...
                        $data->update([
                            'nama_pincab' => $nama,
                            'status_pincab' => 'Approve',
                            'tgl_status_pincab' => now(),
                            'catatan_pincab' => $request->catatan,
                            'status_akhir' => 'Proses'
                        ]);

                        // Send Email Double
                        $userPenerima = User::where('jabatan', 'Pembukuan')->get();
                        // pemberitahuan database
                        $url = route('inventaris-pengajuan.index');
                        $title = 'Terdapat Form Pengajuan Baru!';
                        $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                        $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
                    }
                } else {
                    # code...
                    $data->update([
                        'nama_pincab' => $nama,
                        'status_pincab' => 'Approve',
                        'tgl_status_pincab' => now(),
                        'catatan_pincab' => $request->catatan,
                        'status_akhir' => 'Proses'
                    ]);

                    // Send Email Double
                    $userPenerima = User::where('jabatan', 'Pembukuan')->get();
                    // pemberitahuan database
                    $url = route('inventaris-pengajuan.index');
                    $title = 'Terdapat Form Pengajuan Baru!';
                    $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                    $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
                }
                break;

            case 'Pembukuan':
                if ($data->status_pincab != null) {
                    $data->update([
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Approve',
                        'tgl_status_pembukuan' => now(),
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Proses'
                    ]);
                } else {
                    $data->update([
                        'nama_pincab' => 'Ditarik Oleh User Pembukuan',
                        'status_pincab' => '--',
                        'tgl_status_pincab' => now(),
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Approve',
                        'tgl_status_pembukuan' => now(),
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Proses'
                    ]);
                }
                // khusus 
                if ($data->jns_pembelian == 'Pembelian Dengan Speksifikasi KPM' && $data->kategori_barang == 'Elektronik') {
                    $userPenerima = User::where('jabatan', 'TSI')->get();

                    // pemberitahuan database
                    $url = route('inventaris-pengganti.index');
                    $title = 'Terdapat Form Pengajuan Baru!';
                    $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                    $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);

                    // send email untuk user satunya
                    $userPenerima = User::where('jabatan', 'Pembukuan')
                        ->where('nama', '!=', $nama)->first();
                    // pemberitahuan database
                    $url = route('inventaris-pengganti.index');
                    $title = 'Pengajuan Sudah Dikerjakan!';
                    $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                    $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                } else {
                    $data->update([
                        'nama_tsi' => 'Tidak Diperlukan',
                        'status_tsi' => 'Not Needed',
                        'tgl_status_tsi' => null,
                        'nama_tsi' => 'Tidak Diperlukan',
                    ]);

                    $userPenerima = User::where('jabatan', 'Direktur Operasional')->first();

                    // pemberitahuan database
                    $url = route('inventaris-pengganti.index');
                    $title = 'Terdapat Form Pengajuan Baru!';
                    $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                    $this->SendEmail($data, $userPenerima, $url, $title, $message);

                    // send email untuk user satunya
                    $userPenerima = User::where('jabatan', 'Pembukuan')
                        ->where('nama', '!=', $nama)->first();
                    // pemberitahuan database
                    $url = route('inventaris-pengganti.index');
                    $title = 'Pengajuan Sudah Dikerjakan!';
                    $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                    $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                }
                break;

            case 'Direktur Utama':
                $pembanding = BarangBaruPengganti::where('id_barang_pembanding_pengganti', $request->pembanding_dipilih)->update([
                    'dipilih' => 'True'
                ]);
                $data->update([
                    // 'nama_dirops' => $nama,
                    // 'status_dirops' => 'Approve',
                    // 'tgl_status_dirops' => now(),
                    'catatan_dirops' => $request->catatan,
                    'status_akhir' => 'Proses',

                    'nama_dirut' => 'Eko Bambang Setiyoso',
                    'status_dirut' => 'Approve',
                    'tgl_status_dirut' => now(),
                    // 'tgl_status_dirut' => now()->addMinutes(rand(0, 60)),
                ]);

                if ($data->jns_pembelian == 'Pembelian Dengan Speksifikasi KPM' && $data->kategori_barang == 'Elektronik') {
                    // Send Email Double
                    $userPenerima = User::where('jabatan', 'TSI')->get();
                    // pemberitahuan database
                    $url = route('inventaris-pengganti.index');
                    $title = 'Terdapat Form Pengajuan Baru!';
                    $message = 'Pengajuan Tersebut Memerlukan Tindak Lanjut dari Anda!';
                    $this->SendEmailDobel($data, $userPenerima, $url, $title, $message);
                } else {
                    if ($data->id_cabang == 0) {
                        # code...
                        $userPenerima = User::where('jabatan', 'Sekretariat')->first();
                    } else {
                        # code...
                        $userPenerima = User::where('jabatan', 'Kasi Operasional')->first();
                    }

                    // pemberitahuan database
                    $status_akhir = 'Approved';
                    $url = route('inventaris-pengganti.index');
                    $title = 'Pengajuan Telah Selesai!';
                    $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Approved!';
                    $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);
                }
                break;

            case 'TSI':
                // file uploud
                $file = $request->file_detail_invoice;
                $fileName = $file->getClientOriginalName();
                $file->move('file_upload/barang_inventaris_pengganti/Dibeli', $fileName);

                $data->update([
                    'nama_tsi' => $nama,
                    'status_tsi' => 'Approve',
                    'tgl_status_tsi' => now(),
                    'tgl_status_akhir' => now(),
                    'status_akhir' => 'Selesai',
                    'file_detail_invoice' => $fileName,
                    'catatan_tsi' => (empty($data->catatan_tsi)
                        ? $request->catatan . "<b> Added at: " . now()->format('d-m-Y, H:i') . "</b>"
                        : "&rarr; " . $data->catatan_tsi . "<br> &rarr; " . $request->catatan . "<b> Added at: " . now()->format('d-m-Y, H:i') . "</b>")
                ]);
                $userPenerima = User::where('jabatan', 'Kasi Operasional')->first();

                // pemberitahuan database
                $status_akhir = 'Approved';
                $url = route('inventaris-pengganti.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Approved!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('inventaris-pengganti.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Approve Pengajuan Inventaris Pengganti';
        $this->LogActivity($data, $LogAksi);

        return redirect('inventaris-pengganti')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
    }


    // RESPON Reject STATUS PENGAJUAN
    public function ResponReject(Request $request, $idEncrypt)
    {
        $ids = Crypt::decrypt($idEncrypt);
        $data = InventarisPengganti::where('id_inventaris_pengganti', $ids)->first();
        $jabatan = auth()->user()->jabatan;
        $nama = auth()->user()->nama;

        switch ($jabatan) {
            case 'Pimpinan Cabang':
                $data->update([
                    'nama_pincab' => $nama,
                    'status_pincab' => 'Reject',
                    'tgl_status_pincab' => now(),
                    'catatan_pincab' => $request->catatan,
                    'status_akhir' => 'Ditolak',
                    'tgl_status_akhir' => now(),
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('inventaris-pengganti.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                break;

            case 'Pembukuan':
                if ($data->status_pincab != null) {
                    $data->update([
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Reject',
                        'tgl_status_pembukuan' => now(),
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Ditolak',
                        'tgl_status_akhir' => now(),
                    ]);
                } else {
                    $data->update([
                        'nama_pincab' => 'Ditarik Oleh User Pembukuan',
                        'status_pincab' => '--',
                        'tgl_status_pincab' => now(),
                        'nama_pembukuan' => $nama,
                        'status_pembukuan' => 'Reject',
                        'tgl_status_pembukuan' => now(),
                        'catatan_pembukuan' => $request->catatan,
                        'status_akhir' => 'Ditolak',
                        'tgl_status_akhir' => now(),
                    ]);
                }
                /// Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('inventaris-pengganti.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'Pembukuan')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('inventaris-pengganti.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            case 'Direktur Utama':
                $data->update([
                    // 'nama_dirops' => $nama,
                    // 'status_dirops' => 'Reject',
                    // 'tgl_status_dirops' => now(),
                    // 'catatan_dirops' => $request->catatan,
                    // 'status_akhir' => 'Ditolak',
                    // 'tgl_status_akhir' => now(),
                    'nama_dirut' => $nama,
                    'status_dirut' => 'Reject',
                    'tgl_status_dirut' => now(),
                    'catatan_dirops' => $request->catatan,
                    'status_akhir' => 'Ditolak',
                    'tgl_status_akhir' => now(),
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('inventaris-pengganti.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);
                break;

            case 'TSI':
                $data->update([
                    'nama_tsi' => $nama,
                    'status_tsi' => 'Reject',
                    'tgl_status_tsi' => now(),
                    'catatan_tsi' => $request->catatan,
                    'tgl_status_akhir' => now(),
                    'status_akhir' => 'Ditolak',
                    'tgl_status_akhir' => now(),
                ]);
                // Send Email Single to Kaops cabang
                $userPenerima = User::where('id_cabang', $data->id_cabang)
                    ->where('jabatan', 'Kasi Operasional')->first();
                $status_akhir = 'Rejected';
                // pemberitahuan database
                $url = route('inventaris-pengganti.index');
                $title = 'Pengajuan Telah Selesai!';
                $message = 'Pengajuan Tersebut Telah Selesai Dengan Status: Rejected!';
                $this->SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message);

                // send email untuk user satunya
                $userPenerima = User::where('jabatan', 'TSI')
                    ->where('nama', '!=', $nama)->first();
                // pemberitahuan database
                $url = route('inventaris-pengganti.index');
                $title = 'Pengajuan Sudah Dikerjakan!';
                $message = 'Pengajuan Tersebut Sudah DiHandle oleh Saudara ' . auth()->user()->nama . '!';
                $this->SendEmailToUserLain($data, $userPenerima, $url, $title, $message);
                break;

            default:
                # code...
                break;
        }

        // Log Activity
        $LogAksi = '(cs) Rejected Pengajuan Inventaris Pengganti';
        $this->LogActivity($data, $LogAksi);

        return redirect('inventaris-pengganti')->with('AlertSuccess', "Pengajuan Berhasil Dilakukan Perubahan Status!");
    }



    // ==============
    // button pada status data table index
    private function statusNothing($data)
    {
        $status = '';
        $status .= '<div class="dropdown">';
        $status .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $status .= 'Nothing';
        $status .= '</button>';
        $status .= '<div class="dropdown-menu" aria-labelledby="statusDropdown">';
        $status .= '<a class="dropdown-item approve" href="#" data-toggle="modal" data-target="#modalApprove" data-id="' . encrypt($data->id_inventaris_pengganti) . '" data-kode_form="' . $data->kode_form . '">Approve</a>';
        $status .= '<a class="dropdown-item reject" href="#" data-toggle="modal" data-target="#modalReject" data-id="' . encrypt($data->id_inventaris_pengganti) . '" data-kode_form="' . $data->kode_form . '">Reject</a>';
        $status .= '</div>';
        $status .= '</div>';
        return $status;
    }


    private function statusAfter($data, $jabatan, $statusDropdown)
    {
        $status = '';
        if ($jabatan == 'Approve') {
            $status .= '<a class="btn btn-success btn-sm disabled">Approve</a>';
        } elseif ($jabatan == 'Reject') {
            $status .= '<a class="btn btn-danger btn-sm disabled">Reject</a>';
        } elseif ($jabatan == 'Not Needed') {
            $status .= '<a class="btn btn-danger btn-sm disabled">NotNeeded</a>';
        } elseif ($jabatan == '--') {
            $status .= '<a class="btn btn-success btn-sm disabled">Ditarik</a>';
        } else {
            return $statusDropdown;
        }
        return $status;
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




    // Email single
    private function SendEmail($data, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-pengajuan-inv',  [
            'kc' => $data->cabang->cabang,
            'kode_form' => $data->kode_form,
            'keperluan' => "Pengajuan Inventaris",
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Pengajuan Inventaris Pengganti');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email single to kaops
    private function SendEmailToKaops($data, $status_akhir, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-status-akhir-inv',  [
            'kc' => $data->cabang->cabang,
            'kode_form' => $data->kode_form,
            'keperluan' => "Pengajuan Inventaris",
            'status_akhir' => $status_akhir,
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Status Pengajuan');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email single to user lainnya
    private function SendEmailToUserLain($data, $userPenerima, $url, $title, $message)
    {
        Mail::send('email.notif.notif-dikerjakan-inv',  [
            'kc' => $data->cabang->cabang,
            'kode_form' => $data->kode_form,
            'keperluan' => "Pengajuan Inventaris",
        ], function ($message) use ($userPenerima) {
            $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
            $message->to($userPenerima->email);
            $message->subject('Status Pengajuan');
        });

        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }

    // Email Doubel
    private function SendEmailDobel($data, $userPenerima, $url, $title, $message)
    {
        foreach ($userPenerima as $user) {
            Mail::send('email.notif.notif-pengajuan-inv',  [
                'kc' => $data->cabang->cabang,
                'kode_form' => $data->kode_form,
                'keperluan' => "Pengajuan Inventaris",
            ], function ($message) use ($user) {
                $message->from('tsiksb@bprkusumasumbing.com', 'KSB | Si-PUTa');
                $message->to($user->email);
                $message->subject('Pengajuan Inventaris Pengganti');
            });
        }
        // pemberitahuan database
        Notification::send($userPenerima, new NotifikasiPengajuan($data, $url, $title, $message));
    }
}
