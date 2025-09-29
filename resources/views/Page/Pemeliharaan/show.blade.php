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
                    <td>{{ $pemeliharaan->kode_form }}</td>
                </tr>
                <tr>
                    <th>K.Cabang</th>
                    <td>{{ $pemeliharaan->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Kode Inventaris</th>
                    <td>{{ $pemeliharaan->kode_inventaris }} - {{ $pemeliharaan->detail_barang }}</td>
                </tr>
                <tr>
                    <th>Detail Kendala</th>
                    <td>{!! $pemeliharaan->detail_kendala !!}</td>
                </tr>
                <tr>
                    <th>Detail Perbaikan</th>
                    <td>{!! $pemeliharaan->detail_perbaikan !!}</td>
                </tr>
                <tr>
                    <th>Keputusan TSI</th>
                    <td>{{ $pemeliharaan->keputusan_tsi }}</td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>

    <br>
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h6><b>History Pemeliharaan Barang &rarr;</b></h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Kode Inventaris</th>
                    <th>Detail Inventaris</th>
                    <th>Detail Kerusakan</th>
                    <th>Detail Perbaikan</th>
                    <th>Tanggal Dilaksanakan</th>
                </tr>
                @foreach ($history as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor iterasi dari loop luar -->
                        <td>{{ $data->kode_inventaris }}</td>
                        <td>{{ $data->detail_barang }}</td>
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


    <br>
    <div class="card card-outline card-danger">
        <div class="card-header">
            <h6><b>Tracking &rarr;</b></h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Nama Maker</th>
                    <td>
                        {{ $pemeliharaan->nama_kaops }}
                    </td>
                </tr>

                <tr>
                    <th>TSI Approve?</th>
                    <td>
                        {{ $pemeliharaan->status_tsi }} -
                        {{ $pemeliharaan->tgl_status_tsi ? $pemeliharaan->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td>{{ $pemeliharaan->catatan_tsi }}</td>
                </tr>

                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $pemeliharaan->status_akhir }} -
                        {{ $pemeliharaan->tgl_status_akhir ? $pemeliharaan->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>
                        {{ $pemeliharaan->created_at ? $pemeliharaan->created_at->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

            </table>
        </div>
        <div class="card card-outline card-danger mb-0"></div>
    </div>


</body>

</html>
