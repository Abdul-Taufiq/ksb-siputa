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
    {{-- Inventaris Penjualan --}}
    <div class="card card-outline card-info">
        <div class="card-header">
            <h6>PENGAJUAN PENJUALAN INVENTARIS</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Cabang</th>
                    <th>Kode Form</th>
                    <th>No Inventaris</th>
                    <th>Detail Barang</th>
                    <th>Detail Penawar</th>
                    <th>Tanggal Selesai</th>
                </thead>
                <tbody>
                    @foreach ($penjualan as $penjualans)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $penjualans->cabang->cabang }}</td>
                            <td>{{ $penjualans->kode_form }}</td>
                            <td>{{ $penjualans->no_inventaris }}</td>
                            <td>
                                - <b>Detail Barang: </b>{!! $penjualans->detail_barang !!}
                                - <b>Kondisi Terakhir: </b> {!! $penjualans->kondisi_terakhir !!}
                                - <b>Keterangan: </b> {!! $penjualans->keterangan !!}
                            </td>
                            <td>
                                @foreach ($penjualans->penawar as $penawar)
                                    - <b>NIK: </b> {{ $penawar->nik }} <br>
                                    - <b>Nama: </b> {{ $penawar->nama }} <br>
                                    - <b>Alamat: </b> {{ $penawar->alamat }} <br>
                                    - <b>Harga: </b> {{ 'Rp ' . number_format($penawar->harga_tawar, 0, ',', '.') }}
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                {{ $penjualans->tgl_status_akhir->translatedFormat('d M Y, H:i') . ' WIB' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card card-outline card-info mb-0"></div>
    </div>

</body>

</html>
