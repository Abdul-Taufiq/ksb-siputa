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

        table td {
            font-size: 12px;
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
                            <td>: {{ $insenAO->kode_form }}</td>
                        </tr>
                        <tr>
                            <th style="width: 35%">Periode</th>
                            <td>: {{ $insenAO->periode }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 35%">Nama AO</th>
                            <td>: {{ $insenAO->nama_ao }}
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 35%">Target</th>
                            <td>: {{ 'Rp' . number_format($insenAO->target, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <br>
            <strong>DATA DEBITUR</strong>
            <div class="row mb-2">
                <div class="col-md-12">
                    <table class="table table-sm table-responsive table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th style="width: 10%">TGL REALISASI</th>
                                <th>DATA DEBITUR</th>
                                <th>NOMINAL (Rp)</th>
                                <th>BIAYA (Rp)</th>
                                <th style="width: 15%">STATUS / NAMA REFERAL</th>
                                <th style="width: 10%">INSENTIF REFERAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($debAo as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tgl_realisasi->format('Y-m-d') }}</td>
                                    <td>
                                        <b>Nama :</b> {{ $item->nama }} <br>
                                        <b>Norek :</b> {{ $item->norek }} <br>
                                        <b>Putusan:</b> {{ $item->putusan }}
                                    </td>
                                    <td>{{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        <b>Biaya Adm: </b> {{ number_format($item->biaya_adm, 0, ',', '.') }} <br>
                                        <b>Biaya Survey: </b> {{ number_format($item->biaya_survey, 0, ',', '.') }}
                                        <br>
                                        <b>Adm + Survey: </b> {{ number_format($item->total_adm_survey, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $item->status_referal }} | {{ $item->nama_referal }}</td>
                                    <td>{{ number_format($item->insentif_referal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><b>TOTAL</b></td>
                                <td>
                                    {{ number_format($insenAO->total_nominal, 0, ',', '.') }}
                                </td>
                                <td colspan="2">
                                    <b>ADM: </b> {{ number_format($insenAO->total_biaya_adm, 0, ',', '.') }} <br>
                                    <b>SURVEY: </b> {{ number_format($insenAO->total_biaya_survey, 0, ',', '.') }} <br>
                                    <b>ADM + SURVEY: </b>
                                    {{ number_format($insenAO->total_biaya_admin_survey, 0, ',', '.') }} <br>
                                </td>
                                <td>
                                    {{ number_format($insenAO->total_referal, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <br>
            <strong>DATA PAR & NPL</strong>
            <div class="row mb-2">
                <div class="col-md-12">
                    <table class="table table-sm table-responsive table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 30%">TARGET</th>
                                <th>NOMINAL (Rp)</th>
                                <th>PERSENTASE</th>
                                <th>LAYAK/TIDAK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Target</td>
                                <td>{{ 'Rp' . number_format($insenAO->target, 0, ',', '.') }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Pencapaian</td>
                                <td>{{ 'Rp' . number_format($insenAO->pencapaian, 0, ',', '.') }}</td>
                                <td>{{ number_format($insenAO->pencapaian_persen, 0, ',', '.') }}%</td>
                                <td>{{ $insenAO->pencapaian_status }}</td>
                            </tr>
                            <tr>
                                <td>PAR</td>
                                <td>{{ 'Rp' . number_format($insenAO->par, 0, ',', '.') }}</td>
                                <td>{{ number_format($insenAO->par_persen, 0, ',', '.') }}%</td>
                                <td>{{ $insenAO->par_status }}</td>
                            </tr>
                            <tr>
                                <td>NPL Desember Tahun Sebelumnya</td>
                                <td>{{ 'Rp' . number_format($insenAO->npl_lampau, 0, ',', '.') }}</td>
                                <td>{{ number_format($insenAO->npl_lampau_persen, 0, ',', '.') }}%</td>
                                <td>{{ $insenAO->npl_lampau_status }}</td>
                            </tr>
                            <tr>
                                <td>NPL Periode Insentif</td>
                                <td>{{ 'Rp' . number_format($insenAO->npl_insentif, 0, ',', '.') }}</td>
                                <td>{{ number_format($insenAO->npl_insentif_persen, 0, ',', '.') }}%</td>
                                <td>{{ $insenAO->npl_insentif_status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <br>
            <strong>FINAL RESULT</strong>
            <div class="row mb-2">
                <div class="col-md-12">
                    <table class="table table-sm table-responsive table-striped table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2">TARGET</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 40%">Hasil (Insentif Layak/Tidak)</td>
                                <td>{{ $insenAO->hasil }}</td>
                            </tr>
                            <tr>
                                <td>Perhitungan Insentif</td>
                                <td>{{ 'Rp' . number_format($insenAO->perhitungan_insentif, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Pinalti PAR (20% atau 50%)</td>
                                <td>{{ number_format($insenAO->pinalti_par, 0, ',', '.') }}%</td>
                            </tr>
                            <tr>
                                <td>Pinalti Masa Kerja (Terpotong 20%)</td>
                                <td>{{ number_format($insenAO->pinalti_masa_kerja, 0, ',', '.') }}%</td>
                            </tr>
                            <tr>
                                <td>Insentif Referal</td>
                                <td>{{ 'Rp' . number_format($insenAO->insentif_referal, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Insentif Final</td>
                                <td>{{ 'Rp' . number_format($insenAO->insentif_final, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
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
                                {{ $insenAO->creator }}
                            </td>
                            <td>Sended</td>
                            <td>
                                {{ $insenAO->created_at->format('d-m-Y | H:i') }}
                            </td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th>Pincab</th>
                            <td>:</td>
                            <td>
                                {{ $insenAO->nama_pincab ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->status_pincab ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->tgl_status_pincab?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                            </td>
                            <td>
                                {{ $insenAO->catatan_pincab }}
                            </td>
                        </tr>
                        <tr>
                            <th>Komersial</th>
                            <td>:</td>
                            <td>
                                {{ $insenAO->nama_komersial ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->status_komersial ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->tgl_status_komersial?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                            </td>
                            <td>
                                {{ $insenAO->catatan_komersial }}
                            </td>
                        </tr>
                        {{-- <tr>
                            <th>Dirkom</th>
                            <td>:</td>
                            <td>
                                {{ $insenAO->nama_dirkom ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->status_dirkom ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->tgl_status_dirkom?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                            </td>
                            <td>
                                {{ $insenAO->catatan_dirkom }}
                            </td>
                        </tr> --}}
                        <tr>
                            <th>SDM</th>
                            <td>:</td>
                            <td>
                                {{ $insenAO->nama_sdm ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->status_sdm ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->tgl_status_sdm?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                            </td>
                            <td>
                                {{ $insenAO->catatan_sdm }}
                            </td>
                        </tr>
                        <tr>
                            <th>Dirops</th>
                            <td>:</td>
                            <td>
                                {{ $insenAO->nama_dirops ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->status_dirops ?? '-' }}
                            </td>
                            <td>
                                {{ $insenAO->tgl_status_dirops?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                            </td>
                            <td>
                                {{ $insenAO->catatan_dirops }}
                            </td>
                        </tr>
                    </table>

                    <strong style="margin-left: 5px">Status Akhir : {{ $insenAO->status_akhir ?? 'Proses' }} </strong>
                </div>
            </div>
        </div>


</body>

</html>
