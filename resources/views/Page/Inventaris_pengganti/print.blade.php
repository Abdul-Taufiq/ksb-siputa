<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    <style>
        body {
            font-family: 'JetBrains Mono';
            font-size: 8pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid;
            text-align: center;
            vertical-align: center;
            height: 10px;
        }

        .spesial th,
        .spesial td {
            border-bottom: 1px solid #ddd;
            text-align: left;
            vertical-align: center;
            height: 15px;
        }

        .spesial {
            width: 70%;

        }
    </style>
</head>

<body>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3><b>Data Pengajuan </b></h3>
            <hr>
        </div>
        <div class="card-body">
            <table class="spesial">
                <tr>
                    <th>Kode</th>
                    <td>{{ $inventarisPengganti->kode_form }}</td>
                </tr>
                <tr>
                    <th>K.Cabang</th>
                    <td>{{ $inventarisPengganti->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Kategori Barang</th>
                    <td>{{ $inventarisPengganti->kategori_barang }}</td>
                </tr>
                <tr>
                    <th>Jenis Pembelian</th>
                    <td>{{ $inventarisPengganti->jns_pembelian }}</td>
                </tr>
                <tr>
                    <th>Qty</th>
                    <td>{{ $inventarisPengganti->qty }}</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td>{{ $inventarisPengganti->catatan }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $inventarisPengganti->keterangan }}</td>
                </tr>
                <tr>
                    <th>Detail Invoice</th>
                    <td>
                        <a href="{{ asset('file_upload/barang_inventaris_pengganti/Dibeli/' . $inventarisPengganti->file_detail_invoice) }}"
                            target="_blank">
                            {{ $inventarisPengganti->file_detail_invoice ? $inventarisPengganti->file_detail_invoice : 'null' }}
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>

    <br>
    <div class="card card-outline card-secondary">
        <div class="card-header">
            <h3><b>Data Barang Yang Akan Diganti </b></h3>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Kode Inventaris</th>
                    <th>Nilai Buku Terakhir</th>
                    <th>Kondisi Akhir</th>
                    <th>Tanggal Pembelian</th>
                </tr>
                @foreach ($diganti as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->kode_inventaris }}</td>
                        <td>{{ $data->nilai_buku_terakhir }}</td>
                        <td>{{ $data->kondisi_akhir }}</td>
                        <td>{{ $data->tgl_pembelian ? $data->tgl_pembelian->translatedFormat('d F Y') : ' ' }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="card card-outline card-secondary mb-0"></div>
    </div>

    <br>
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3><b>History Pemeliharaan Barang</b></h3>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Kode Inventaris</th>
                    <th>Detail Kerusakan</th>
                    <th>Detail Perbaikan</th>
                    <th>Tanggal Dilaksanakan</th>
                </tr>
                @foreach ($perbaikan_histories as $perbaikan_history)
                    @foreach ($perbaikan_history as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor iterasi dari loop luar -->
                            <td>{{ $data->kode_inventaris }}</td>
                            <td>{!! $data->detail_kerusakan !!}</td>
                            <td>{!! $data->detail_perbaikan !!}</td>
                            <td>{{ $data->tgl_dilaksanakan ? $data->tgl_dilaksanakan->translatedFormat('d F Y') : ' ' }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach

            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>

    <br>
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3><b>Data Barang (Perbandingan) </b></h3>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Jenis Barang</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Nama Toko</th>
                    <th>Detail Toko</th>
                    <th>Harga</th>
                </tr>
                @foreach ($barang as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kategori_barang }}</td>
                        <td>{{ $item->jns_barang }}</td>
                        <td>{{ $item->merk }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->nama_toko }}</td>
                        <td>
                            <a href="{{ asset('file_upload/barang_inventaris_pengganti/' . $item->file_detail_toko) }}"
                                target="_blank">
                                {{ $item->file_detail_toko ? $item->file_detail_toko : 'null' }}
                            </a>
                        </td>
                        <td>{{ $item->harga }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="card card-outline card-success mb-0"></div>
    </div>

    <br>
    <div class="card card-outline card-danger">
        <div class="card-header">
            <h3><b>Tracking</b></h3>
            <hr>
        </div>
        <div class="card-body">
            <table class="spesial">
                <tr>
                    <th>Creator</th>
                    <td>
                        {{ $inventarisPengganti->nama_kaops }} -
                        {{ $inventarisPengganti->created_at ? $inventarisPengganti->created_at->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $inventarisPengganti->status_pincab }} -
                        {{ $inventarisPengganti->tgl_status_pincab ? $inventarisPengganti->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pembukuan Approve?</th>
                    <td>
                        {{ $inventarisPengganti->status_pembukuan }} -
                        {{ $inventarisPengganti->tgl_status_pembukuan ? $inventarisPengganti->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Pembukuan</th>
                    <td>{{ $inventarisPengganti->catatan_pembukuan }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $inventarisPengganti->status_dirops }} -
                        {{ $inventarisPengganti->tgl_status_dirops ? $inventarisPengganti->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $inventarisPengganti->catatan_dirops }}</td>
                </tr>

                @if (
                    $inventarisPengganti->jns_pembelian != 'Pembelian Dengan Speksifikasi Cabang' &&
                        $inventarisPengganti->kategori_barang == 'Elektronik')
                    <tr>
                        <th>TSI Approve?</th>
                        <td>
                            {{ $inventarisPengganti->status_tsi }} -
                            {{ $inventarisPengganti->tgl_status_tsi ? $inventarisPengganti->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' x' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Catatan TSI</th>
                        <td>{!! $inventarisPengganti->catatan_tsi !!}</td>
                    </tr>
                @endif

                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $inventarisPengganti->status_akhir }} -
                        {{ $inventarisPengganti->tgl_status_akhir ? $inventarisPengganti->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

            </table>
        </div>
        <div class="card card-outline card-danger mb-0"></div>
    </div>


</body>

</html>
