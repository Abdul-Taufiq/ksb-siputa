<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    <style>
        body {
            font-family: 'JetBrains Mono';
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h6><b>Data Pengajuan &rarr;</b></h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Kode</th>
                    <td>{{ $inventaris->kode_form }}</td>
                </tr>
                <tr>
                    <th>K.Cabang</th>
                    <td>{{ $inventaris->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Kategori Barang</th>
                    <td>{{ $inventaris->kategori_barang }}</td>
                </tr>
                <tr>
                    <th>Jenis Pembelian</th>
                    <td>{{ $inventaris->jns_pembelian }}</td>
                </tr>
                <tr>
                    <th>Qty</th>
                    <td>{{ $inventaris->qty }}</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td>{{ $inventaris->catatan }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $inventaris->keterangan }}</td>
                </tr>
                <tr>
                    <th>Detail Invoice</th>
                    <td>
                        <a href="{{ asset('file_upload/barang_inventaris_baru/Dibeli/' . $inventaris->file_detail_invoice) }}"
                            target="_blank">
                            {{ $inventaris->file_detail_invoice ? $inventaris->file_detail_invoice : 'null' }}
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>

    <div class="card card-outline card-warning">
        <div class="card-header">
            <h6><b>Data Barang (Perbandingan) &rarr;</b></h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Jenis Barang</th>
                    <th>Merk/Type</th>
                    <th>Nama Toko</th>
                    <th>Detail Toko</th>
                    <th>Harga</th>
                    <th>Dipilih?</th>
                </tr>
                @foreach ($barang as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kategori_barang }}</td>
                        <td>{{ $item->jns_barang }}</td>
                        <td>{{ $item->merk }}/{{ $item->type }}</td>
                        <td>{{ $item->nama_toko }}</td>
                        <td>
                            <a href="{{ asset('file_upload/barang_inventaris_baru/' . $item->file_detail_toko) }}"
                                target="_blank">
                                {{ $item->file_detail_toko ? $item->file_detail_toko : 'null' }}
                            </a>
                        </td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->dipilih == null ? '☓' : '✔' }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>

    <div class="card card-outline card-danger">
        <div class="card-header">
            <h6><b>Tracking &rarr;</b></h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Nama Maker</th>
                    <td>
                        {{ $inventaris->nama_kaops }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $inventaris->status_pincab }} -
                        {{ $inventaris->tgl_status_pincab ? $inventaris->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pembukuan Approve?</th>
                    <td>
                        {{ $inventaris->status_pembukuan }} -
                        {{ $inventaris->tgl_status_pembukuan ? $inventaris->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Pembukuan</th>
                    <td>{{ $inventaris->catatan_pembukuan }}</td>
                </tr>
                {{-- <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $inventaris->status_dirops }} -
                        {{ $inventaris->tgl_status_dirops ? $inventaris->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr> --}}
                <tr>
                    <th>Dirut Approve?</th>
                    <td>
                        {{ $inventaris->status_dirut }} -
                        {{ $inventaris->tgl_status_dirut ? $inventaris->tgl_status_dirut->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Dirut</th>
                    <td>{{ $inventaris->catatan_dirops }}</td>
                </tr>

                @if (
                    $inventaris->jns_pembelian != 'Pembelian Dengan Speksifikasi Cabang' &&
                        $inventaris->kategori_barang == 'Elektronik')
                    <tr>
                        <th>TSI Approve?</th>
                        <td>
                            {{ $inventaris->status_tsi }} -
                            {{ $inventaris->tgl_status_tsi ? $inventaris->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' x' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Catatan TSI</th>
                        <td>{!! $inventaris->catatan_tsi !!}</td>
                    </tr>
                @endif

                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $inventaris->status_akhir }} -
                        {{ $inventaris->tgl_status_akhir ? $inventaris->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

            </table>
        </div>
        <div class="card card-outline card-danger mb-0"></div>
    </div>


</body>

</html>
