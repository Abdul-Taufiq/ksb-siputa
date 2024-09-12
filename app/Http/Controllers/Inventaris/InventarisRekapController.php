<?php

namespace App\Http\Controllers\Inventaris;

use App\Http\Controllers\Controller;
use App\Models\Inventaris\Inventaris;
use App\Models\Inventaris\InventarisPengganti;
use App\Models\Inventaris\InventarisPenjualan as Penjualan;
use App\Models\User;
use App\Policies\UserPolicy;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventarisRekapController extends Controller
{
    public function Index()
    {
        $this->authorize('viewRekap', User::class);
        return view('Page.Inventaris_rekap.index', ['title' => 'Inventaris Rekap']);
    }


    public function ShowRekap($min, $max, $id_cabang, $pilih_laporan)
    {
        $this->authorize('viewRekap', User::class);

        // config tgl
        $awal = Carbon::parse($min)->startOfDay();
        if ($max == '11-11-1111') {
            $akhir = Carbon::parse(now())->endOfDay();
        } else {
            $akhir = Carbon::parse($max)->endOfDay();
        }

        // filter cabang
        if ($id_cabang == '99') {
            // switch jenis laporan
            switch ($pilih_laporan) {
                case 'All':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    return view('Page.Inventaris_rekap.show_all', compact('pembelian', 'pengganti', 'penjualan'), ['title' => 'Inventaris']);
                    break;

                case 'Pembelian Baru':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    return view('Page.Inventaris_rekap.show_pembelian_baru', compact('pembelian'), ['title' => 'Inventaris']);
                    break;

                case 'Pembelian Pengganti':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    return view('Page.Inventaris_rekap.show_pembelian_pengganti', compact('pengganti'), ['title' => 'Inventaris']);
                    break;

                case 'Penjualan Inventaris':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('created_at', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('created_at', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    return view('Page.Inventaris_rekap.show_penjualan', compact('penjualan'), ['title' => 'Inventaris']);
                    break;
            }
        } else {
            // switch jenis laporan
            switch ($pilih_laporan) {
                case 'All':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    return view('Page.Inventaris_rekap.show_all', compact('pembelian', 'pengganti', 'penjualan'), ['title' => 'Inventaris']);
                    break;

                case 'Pembelian Baru':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    return view('Page.Inventaris_rekap.show_pembelian_baru', compact('pembelian'), ['title' => 'Inventaris']);
                    break;

                case 'Pembelian Pengganti':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    return view('Page.Inventaris_rekap.show_pembelian_pengganti', compact('pengganti'), ['title' => 'Inventaris']);
                    break;

                case 'Penjualan Inventaris':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('created_at', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('created_at', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    return view('Page.Inventaris_rekap.show_penjualan', compact('penjualan'), ['title' => 'Inventaris']);
                    break;
            }
        }
    }


    public function PrintRekap($min, $max, $id_cabang, $pilih_laporan)
    {
        $this->authorize('viewRekap', User::class);
        // config tgl
        $awal = Carbon::parse($min)->startOfDay();
        if ($max == '11-11-1111') {
            $akhir = Carbon::parse(now())->endOfDay();
        } else {
            $akhir = Carbon::parse($max)->endOfDay();
        }

        // filter cabang
        if ($id_cabang == '99') {
            // switch jenis laporan
            switch ($pilih_laporan) {
                case 'All':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    $pdf = Pdf::loadView('Page.Inventaris_rekap.print_all', compact('pembelian', 'pengganti', 'penjualan'));
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('Laporan Inventaris ' . $pilih_laporan . '-' . $id_cabang . '.pdf');
                    break;

                case 'Pembelian Baru':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    $pdf = Pdf::loadView('Page.Inventaris_rekap.print_pembelian_baru', compact('pembelian'));
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('Laporan Inventaris ' . $pilih_laporan . '-' . $id_cabang . '.pdf');
                    break;

                case 'Pembelian Pengganti':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    $pdf = Pdf::loadView('Page.Inventaris_rekap.print_pembelian_pengganti', compact('pengganti'));
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('Laporan Inventaris ' . $pilih_laporan . '-' . $id_cabang . '.pdf');
                    break;

                case 'Penjualan Inventaris':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    $pdf = Pdf::loadView('Page.Inventaris_rekap.print_penjualan', compact('penjualan'));
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('Laporan Inventaris ' . $pilih_laporan . '-' . $id_cabang . '.pdf');
                    break;
            }
        } else {
            // switch jenis laporan
            switch ($pilih_laporan) {
                case 'All':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();

                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    $pdf = Pdf::loadView('Page.Inventaris_rekap.print_all', compact('pembelian', 'pengganti', 'penjualan'));
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('Laporan Inventaris ' . $pilih_laporan . '-' . $id_cabang . '.pdf');
                    break;

                case 'Pembelian Baru':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Baru
                        $pembelian = Inventaris::with(['BarangBaru' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    $pdf = Pdf::loadView('Page.Inventaris_rekap.print_pembelian_baru', compact('pembelian'));
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('Laporan Inventaris ' . $pilih_laporan . '-' . $id_cabang . '.pdf');
                    break;

                case 'Pembelian Pengganti':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Pembelian Pengganti
                        $pengganti = InventarisPengganti::with(['BarangBaruPengganti' => function ($query) {
                            $query->where('dipilih', 'True');
                        }, 'diganti'])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    $pdf = Pdf::loadView('Page.Inventaris_rekap.print_pembelian_pengganti', compact('pengganti'));
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('Laporan Inventaris ' . $pilih_laporan . '-' . $id_cabang . '.pdf');
                    break;

                case 'Penjualan Inventaris':
                    // setting tanggal akhir apakah null apa tidak
                    if ($max == '11-11-1111') {
                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }
                    // jika max tidak null 
                    else {
                        // Penjualan
                        $penjualan = Penjualan::with(['penawar' => function ($query) {
                            $query->where('dipilih', 'True');
                        }])
                            ->whereBetween('tgl_status_akhir', [$awal, $akhir])
                            ->where('id_cabang', $id_cabang)
                            ->where('status_akhir', 'Selesai')
                            ->orderBy('tgl_status_akhir', 'desc')->get();
                    }

                    $pdf = Pdf::loadView('Page.Inventaris_rekap.print_penjualan', compact('penjualan'));
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('Laporan Inventaris ' . $pilih_laporan . '-' . $id_cabang . '.pdf');
                    break;
            }
        }
    }
}
