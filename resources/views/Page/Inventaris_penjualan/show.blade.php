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
                    <td>{{ $penjualan->kode_form }}</td>
                </tr>
                <tr>
                    <th>K.Cabang</th>
                    <td>{{ $penjualan->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Kategori Barang</th>
                    <td>{{ $penjualan->kategori_barang }}</td>
                </tr>
                <tr>
                    <th>Nomor Inventaris</th>
                    <td>{{ $penjualan->no_inventaris }}</td>
                </tr>
                <tr>
                    <th>Detail Barang</th>
                    <td>{!! $penjualan->detail_barang !!}</td>
                </tr>
                <tr>
                    <th>Kondisi Terakhir</th>
                    <td>{!! $penjualan->kondisi_terakhir !!}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{!! $penjualan->keterangan !!}</td>
                </tr>
                <tr>
                    <th>Gambar/File Barang</th>
                    <td>
                        <a href="{{ asset('file_upload/Inventaris Jual/' . $penjualan->file) }}" target="_blank">
                            {{ $penjualan->file ? $penjualan->file : 'null' }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Detail Invoice Penjualan</th>
                    <td>
                        <a href="{{ asset('file_upload/Inventaris Jual/' . $penjualan->file_invoice_akhir) }}"
                            target="_blank">
                            {{ $penjualan->file_invoice_akhir ? $penjualan->file_invoice_akhir : 'null' }}
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>

    <div class="card card-outline card-warning">
        <div class="card-header">
            <h6><b>Data Penawar &rarr;</b></h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Harga Tawaran</th>
                </tr>
                @foreach ($penjualan->penawar as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            {{ $item->harga_tawar ? 'Rp ' . number_format($item->harga_tawar, 0, ',', '.') : 'belum ada data' }}
                        </td>
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
                    <th>Creator</th>
                    <td>
                        {{ $penjualan->nama_kaops }} -
                        {{ $penjualan->created_at ? $penjualan->created_at->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $penjualan->status_pincab }} -
                        {{ $penjualan->tgl_status_pincab ? $penjualan->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pembukuan Approve?</th>
                    <td>
                        {{ $penjualan->status_pembukuan }} -
                        {{ $penjualan->tgl_status_pembukuan ? $penjualan->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Pembukuan</th>
                    <td>{{ $penjualan->catatan_pembukuan }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $penjualan->status_dirops }} -
                        {{ $penjualan->tgl_status_dirops ? $penjualan->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Dirut Approve?</th>
                    <td>
                        {{ $penjualan->status_dirut }} -
                        {{ $penjualan->tgl_status_dirut ? $penjualan->tgl_status_dirut->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $penjualan->catatan_dirops }}</td>
                </tr>

                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $penjualan->status_akhir }} -
                        {{ $penjualan->updated_at ? $penjualan->updated_at->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

            </table>
        </div>
        <div class="card card-outline card-danger mb-0"></div>
    </div>


</body>

</html>
