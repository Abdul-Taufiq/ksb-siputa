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

    {{-- Inventaris Baru --}}
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h6>PENGAJUAN INVENTARIS BARU</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th style="width: 2%">#</th>
                    <th style="width: 25%">Detail Form</th>
                    <th style="width: 59%">Detail Pembanding</th>
                    <th style="width: 4%">Qty</th>
                    <th style="width: 10%">Tanggal Selesai</th>
                </thead>
                <tbody>
                    @if ($pembelian->isEmpty())
                        <tr>
                            <td colspan="6">Tidak ada data</td>
                        </tr>
                    @else
                        @foreach ($pembelian as $pembelians)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    - <b>{{ $pembelians->cabang->cabang }} </b> <br>
                                    - <b>Kode: </b> {{ $pembelians->kode_form }} <br>
                                    - <b>Kategori: </b> {{ $pembelians->kategori_barang }} <br>
                                    - <b>Keterangan: </b> {{ $pembelians->keterangan }} <br>
                                </td>
                                <td>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kategori/Jns</th>
                                                <th>Merk/Type</th>
                                                <th>Nama/Detail Toko</th>
                                                <th>Harga</th>
                                                <th>Dipilih?</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pembelians->BarangBaru as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->kategori_barang }}/
                                                        {{ $data->jns_barang }}
                                                    </td>
                                                    <td>{{ $data->merk }}/{{ $data->type }}</td>
                                                    <td>{{ $data->nama_toko }} /
                                                        <a href="{{ asset('file_upload/barang_inventaris_pengganti/' . $data->file_detail_toko) }}"
                                                            target="_blank">
                                                            {{ $data->file_detail_toko ? $data->file_detail_toko : 'null' }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $data->harga }}</td>
                                                    <td>{{ $data->dipilih == null ? 'x' : 'v' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </td>
                                <td>{{ $pembelians->qty }}</td>
                                <td>
                                    {{ $pembelians->tgl_status_akhir->translatedFormat('d M Y, H:i') . ' WIB' }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
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
