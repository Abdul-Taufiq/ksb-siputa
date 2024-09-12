<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        body {
            font-family: 'JetBrains Mono';
            font-size: 12px;
        }

        table td {
            vertical-align: top;
        }

        .border {
            width: 100%;
            border: 1px solid #ddd;
        }

        .border th {
            text-align: center;
            border: 1px solid #ddd;
        }

        .border td {
            border: 1px solid #ddd;
        }

        table {
            width: 100%;
            font-size: 8pt;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <h5>REKAP INVENTARIS</h5>
    <br>
    {{-- Inventaris Baru --}}
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h6>PENGAJUAN INVENTARIS BARU</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Cabang</th>
                    <th>Detail Form</th>
                    <th>Detail Barang</th>
                    <th>Qty</th>
                    <th>Tanggal Selesai</th>
                </thead>
                <tbody>
                    @foreach ($pembelian as $pembelians)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pembelians->cabang->cabang }}</td>
                            <td>
                                - <b>Kode: </b> {{ $pembelians->kode_form }} <br>
                                - <b>Kategori: </b> {{ $pembelians->kategori_barang }} <br>
                                - <b>Keterangan: </b> {{ $pembelians->keterangan }} <br>
                            </td>
                            <td>
                                @foreach ($pembelians->BarangBaru as $barang)
                                    - <b>Jenis Barang: </b> {{ $barang->jns_barang }} <br>
                                    - <b>Merk/Type: </b> {{ $barang->merk . '/' . $barang->type }} <br>
                                    - <b>Nama Toko: </b> {{ $barang->nama_toko }} <br>
                                    - <b>Harga: </b> {{ $barang->harga }} <br>
                                @endforeach
                            </td>
                            <td>{{ $pembelians->qty }}</td>
                            <td>
                                {{ $pembelians->tgl_status_akhir->translatedFormat('d M Y, H:i') . ' WIB' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>

</body>

</html>
