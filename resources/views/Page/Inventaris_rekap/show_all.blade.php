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

    {{-- Inventaris Pengganti --}}
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h6>PENGAJUAN INVENTARIS PENGGANTI</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Cabang</th>
                    <th>Detail Form</th>
                    <th>Detail Barang Diganti</th>
                    <th>Detail Barang Pengganti</th>
                    <th>Qty</th>
                    <th>Tanggal Selesai</th>
                </thead>
                <tbody>
                    @foreach ($pengganti as $penggantis)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $penggantis->cabang->cabang }}</td>
                            <td>
                                - <b>Kode: </b> {{ $penggantis->kode_form }} <br>
                                - <b>Kategori: </b> {{ $penggantis->kategori_barang }} <br>
                                - <b>Keterangan: </b> {{ $penggantis->keterangan }} <br>
                            </td>
                            <td>
                                @foreach ($penggantis->diganti as $barang)
                                    - <b>No Inventaris: </b> {{ $barang->kode_inventaris }}<br>
                                    - <b>No Nilai Buku: </b> {{ $barang->nilai_buku_terakhir }}<br>
                                    - <b>Tgl Pembelian: </b>
                                    {{ $barang->tgl_pembelian->translatedFormat('d M Y') }}<br>
                                    - <b>Kondisi Terakhir: </b> {{ $barang->kondisi_akhir }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($penggantis->BarangBaruPengganti as $barangPengganti)
                                    - <b>Jenis Barang: </b> {{ $barangPengganti->jns_barang }} <br>
                                    - <b>Merk/Type: </b> {{ $barangPengganti->merk . '/' . $barangPengganti->type }}
                                    <br>
                                    - <b>Nama Toko: </b> {{ $barangPengganti->nama_toko }} <br>
                                    - <b>Harga: </b> {{ $barangPengganti->harga }} <br>
                                @endforeach
                            </td>
                            <td>{{ $penggantis->qty }}</td>
                            <td>
                                {{ $penggantis->tgl_status_akhir->translatedFormat('d M Y, H:i') . ' WIB' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>

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
