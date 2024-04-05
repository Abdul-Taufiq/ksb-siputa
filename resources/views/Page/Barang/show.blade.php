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
            <h6><b>Data Data &rarr;</b></h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>K.Cabang</th>
                    <td>{{ $barang->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Kode Inventaris</th>
                    <td>{{ $barang->kode_inventaris }}</td>
                </tr>
                <tr>
                    <th>Kode Barang</th>
                    <td>{{ $barang->kode_barang }}</td>
                </tr>
                <tr>
                    <th>Jenis Barang</th>
                    <td>{{ $barang->jns_barang }}</td>
                </tr>
                <tr>
                    <th>Merk</th>
                    <td>{{ $barang->merk }}</td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>{{ $barang->type }}</td>
                </tr>
                <tr>
                    <th>Posisi</th>
                    <td>{{ $barang->posisi }}</td>
                </tr>

                <tr>
                    <th>Detail Speksifikasi</th>
                    <td>{!! $barang->speksifikasi !!}</td>
                </tr>
                <tr>
                    <th>Tanggal Pembelian</th>
                    <td>{{ $barang->tgl_pembelian ? $barang->tgl_pembelian->translatedFormat('d F Y') : ' ' }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>

    <div class="card card-outline card-warning">
        <div class="card-header">
            <h6><b>History Pemeliharaan Barang &rarr;</b></h6>
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
                @foreach ($perbaikan_histories as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor iterasi dari loop luar -->
                        <td>{{ $data->kode_inventaris }}</td>
                        <td>{!! $data->detail_kerusakan !!}</td>
                        <td>{!! $data->detail_perbaikan !!}</td>
                        <td>{{ $data->tgl_dilaksanakan ? $data->tgl_dilaksanakan->translatedFormat('d F Y') : ' ' }}
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>

</body>

</html>
