<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <!-- Theme style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        body {
            font-family: 'JetBrains Mono';
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <b style="font-size: 14px;">Data Form </b>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 35%">Kode Form</th>
                            <td>: {{ $penyelesaian->kode_form }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 35%">Kode Form Surtug</th>
                            <td>: {{ $penyelesaian->kode_form_surtug }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <strong>DATA DEBITUR</strong>
            <div class="row mb-2">
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 35%">Nama Debitur</th>
                            <td>: {{ $penyelesaian->nama }}</td>
                        </tr>
                        <tr>
                            <th>Norek</th>
                            <td>: {{ $penyelesaian->norek }}
                            </td>
                        </tr>
                        <tr>
                            <th>Plafond</th>
                            <td>:
                                {{ 'Rp' . number_format($penyelesaian->plafond, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Baki Debet</th>
                            <td>:
                                {{ 'Rp' . number_format($penyelesaian->bakidebet, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Tunggakan Pokok</th>
                            <td>:
                                {{ 'Rp' . number_format($penyelesaian->tunggakan_pokok, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Tunggakan Bunga</th>
                            <td>:
                                {{ 'Rp' . number_format($penyelesaian->tunggakan_bunga, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 35%">Denda</th>
                            <td>:
                                {{ 'Rp' . number_format($penyelesaian->denda, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Jns Pinjaman</th>
                            <td>: {{ $penyelesaian->jns_pinjaman }}</td>
                        </tr>
                        <tr>
                            <th>Kolek</th>
                            <td>: {{ $penyelesaian->kolek }}</td>
                        </tr>
                        <tr>
                            <th>Pemutus Kredit</th>
                            <td>: {{ $penyelesaian->pemutus_kredit }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <br>
            <strong>PERHITUNGAN INSENTIF</strong>
            <div class="row mb-2">
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 35%">Nominal Dibayar</th>
                            <td>:
                                {{ 'Rp' . number_format($penyelesaian->nominal_dibayar, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Biaya Jasa Pihak Ketiga</th>
                            <td>:
                                {{ 'Rp' . number_format($penyelesaian->biaya_pihak_ketiga, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Dasar Perhitungan Insentif (opsi)</th>
                            <td>:
                                {{ $penyelesaian->dpi_opsi }} | {{ $penyelesaian->dpi_persen }}%
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 35%">Dasar Perhitungan Insentif</th>
                            <td>:
                                {{ 'Rp' . number_format($penyelesaian->dpi, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Perhitungan Insentif</th>
                            <td>
                                {{ $penyelesaian->dpi_persen }}% x
                                {{ 'Rp' . number_format($penyelesaian->dpi, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Nominal Insentif</th>
                            <td>
                                {{ 'Rp' . number_format($penyelesaian->nominal_insentif, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <br>
            <strong>KOMPOSISI PEMBAGIAN</strong>
            <table class="table table-sm table-responsive table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 5%">NO</th>
                        <th style="width: 30%">NAMA PETUGAS</th>
                        <th style="width: 20%">NIK</th>
                        <th style="width: 15%">JABATAN</th>
                        <th style="width: 10%">%</th>
                        <th style="width: 20%">NOMINAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembagian as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>
                                {{ number_format($item->persen, 0, ',', '.') . '%' }}
                            </td>
                            <td>
                                {{ 'Rp' . number_format($item->nominal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <br>

    <div class="card">
        <div class="card-header">
            <b style="font-size: 14px;">Tracking </b>
        </div>
        <div class="card-body">
            <table class="table table-sm table-responsive table-striped">
                <tr>
                    <th style="width: 10%">#</th>
                    <th style="width: 1%"></th>
                    <th style="width: 25%">Nama</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 15%">Tanggal Status</th>
                    <th>Catatan</th>
                </tr>
                <tr>
                    <th>Creator</th>
                    <td>:</td>
                    <td>
                        {{ $penyelesaian->creator }}
                    </td>
                    <td>Sended</td>
                    <td>
                        {{ $penyelesaian->created_at->format('d-m-Y | H:i') }}
                    </td>
                    <td>-</td>
                </tr>
                <tr>
                    <th>Pincab</th>
                    <td>:</td>
                    <td>
                        {{ $penyelesaian->nama_pincab ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->status_pincab ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->tgl_status_pincab?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                    </td>
                    <td>
                        {{ $penyelesaian->catatan_pincab }}
                    </td>
                </tr>
                <tr>
                    <th>Komersial</th>
                    <td>:</td>
                    <td>
                        {{ $penyelesaian->nama_komersial ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->status_komersial ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->tgl_status_komersial?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                    </td>
                    <td>
                        {{ $penyelesaian->catatan_komersial }}
                    </td>
                </tr>
                <tr>
                    <th>Dirkom</th>
                    <td>:</td>
                    <td>
                        {{ $penyelesaian->nama_dirkom ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->status_dirkom ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->tgl_status_dirkom?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                    </td>
                    <td>
                        {{ $penyelesaian->catatan_dirkom }}
                    </td>
                </tr>
                <tr>
                    <th>SDM</th>
                    <td>:</td>
                    <td>
                        {{ $penyelesaian->nama_sdm ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->status_sdm ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->tgl_status_sdm?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                    </td>
                    <td>
                        {{ $penyelesaian->catatan_sdm }}
                    </td>
                </tr>
                <tr>
                    <th>Dirops</th>
                    <td>:</td>
                    <td>
                        {{ $penyelesaian->nama_dirops ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->status_dirops ?? '-' }}
                    </td>
                    <td>
                        {{ $penyelesaian->tgl_status_dirops?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                    </td>
                    <td>
                        {{ $penyelesaian->catatan_dirops }}
                    </td>
                </tr>
            </table>

            <strong style="margin-left: 5px">Status Akhir : {{ $penyelesaian->status_akhir ?? 'Proses' }} </strong>
        </div>
    </div>
</body>

</html>
