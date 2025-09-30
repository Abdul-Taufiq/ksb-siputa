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
                    <th style="width: 3%">#</th>
                    <th style="width: 17%">Detail Form</th>
                    <th style="width: 30%;">Detail Barang</th>
                    <th style="width: 40%;">Detail Penawar</th>
                    <th style="width: 10%">Tanggal Selesai</th>
                </thead>
                <tbody>
                    @if ($penjualan->isEmpty())
                        <tr>
                            <td colspan="6">Tidak ada data</td>
                        </tr>
                    @else
                        @foreach ($penjualan as $penjualans)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    - <b>{{ $penjualans->cabang->cabang }}</b><br>
                                    - <b>Kode: </b> {{ $penjualans->kode_form }} <br>
                                </td>
                                <td>
                                    - <b>No Inventaris: </b> {{ $penjualans->no_inventaris }} <br>
                                    - <b>Detail Barang: </b>{!! $penjualans->detail_barang !!}
                                    - <b>Kondisi Terakhir: </b> {!! $penjualans->kondisi_terakhir !!}
                                    - <b>Keterangan: </b> {!! $penjualans->keterangan !!}
                                </td>
                                <td>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 2%;">#</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Harga Tawar</th>
                                                <th>Dipilih?</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($penjualans->penawar as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->nik }}</td>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->alamat }}</td>
                                                    <td>{{ 'Rp ' . number_format($data->harga_tawar, 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ $data->dipilih == null ? 'x' : 'v' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    {{ $penjualans->tgl_status_akhir->translatedFormat('d M Y, H:i') . ' WIB' }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card card-outline card-info mb-0"></div>
    </div>

</body>

</html>
