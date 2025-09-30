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

        #footer {
            position: fixed;
            left: 20px;
            bottom: 0;
            text-align: center;
        }

        #footer .page:after {
            content: "Halaman " counter(page);
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
    {{-- penomoran halaman --}}
    <div id="footer">
        <p class="page">
    </div>

    {{-- Header --}}
    <table style="width: 100%; margin-top: -20px">
        <tr>
            <td style="width: 25%">
                <img style="width: 65px;"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/icon_logo.png'))) }}">
            </td>
            <td style="width: 50%; text-align: center; ">
                <h5 style="margin-top: 20px">REKAP INVENTARIS</h5>
            </td>
            <td style="width: 25%">&nbsp;</td>
        </tr>
    </table>
    <br>
    {{-- end header --}}

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

    {{-- TTD --}}
    <br>
    <div style="page-break-inside: avoid">
        <div style="text-align: center;">
            Parakan,
            {{ now()->translatedFormat('d F Y') }} <br>
            <b>PT BPR KUSUMA SUMBING</b>
        </div>
        <table style="width: 100%; text-align: center; font-size: 11pt">
            <tr>
                <td style="width: 45%;   padding: 3px 0; text-align: center;">
                    <b>Kepala Bidang Operasional</b>
                </td>
                <td style="padding: 4px 0; width: 55%; text-align: center;">
                    <b>Direktur Utama</b>
                </td>
            </tr>
            <tr style="text-align: center;">
                <td style="width: 45%;   padding: 3px 0; text-align: center;">
                    <br><br><br><br><br>
                    (<b>Sigid Setiyawan</b>)
                </td>
                <td style="padding: 4px 0; width: 55%; text-align: center;">
                    <br><br><br><br><br>
                    (<b>Eko Bambang Setiyoso</b>)
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
