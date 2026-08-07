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
                            <th style="width: 25%">Kode Form</th>
                            <td>: {{ $surtug->kode_form }}</td>
                        </tr>
                        <tr>
                            <th>Status Form</th>
                            <td>: {{ $surtug->status_form }}
                                @if ($surtug->status_form == 'Dilimpahkan')
                                    | nomor: {{ $surtug->kode_form_sebelumnya }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tenggat Waktu</th>
                            <td>: {{ $surtug->tgl_awal->format('d-m-Y') }} s/d {{ $surtug->tgl_awal->format('d-m-Y') }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 25%">NIK PIC</th>
                            <td>: {{ $surtug->nik_pic }}</td>
                        </tr>
                        <tr>
                            <th>Nama PIC</th>
                            <td>: {{ $surtug->nama_pic }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <strong>TARGET PENYELESAIAN KREDIT BERMASALAH</strong>
            <table class="table table-sm table-responsive table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 5%">NO</th>
                        <th style="width: 25%">DEBITUR</th>
                        <th style="width: 15%">NOREK</th>
                        <th style="width: 15%">PLAFON</th>
                        <th style="width: 15%">BAKI DEBET</th>
                        <th style="width: 10%">KOL</th>
                        <th style="width: 15%">TARGET PENYELESAIAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($debsur as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->norek }}</td>
                            <td>
                                {{ 'Rp' . number_format($item->plafond, 0, ',', '.') }}
                            </td>
                            <td>
                                {{ 'Rp' . number_format($item->bakidebet, 0, ',', '.') }}
                            </td>
                            <td>{{ $item->kol }}</td>
                            <td>{{ $item->target }}</td>
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
                        {{ $surtug->creator }}
                    </td>
                    <td>Sended</td>
                    <td>
                        {{ $surtug->created_at->format('d-m-Y | H:i') }}
                    </td>
                    <td>-</td>
                </tr>
                <tr>
                    <th>Pincab</th>
                    <td>:</td>
                    <td>
                        {{ $surtug->nama_pincab ?? '-' }}
                    </td>
                    <td>
                        {{ $surtug->status_pincab ?? '-' }}
                    </td>
                    <td>
                        {{ $surtug->tgl_status_pincab?->format('d-m-Y | H:i') ?? 'Belum ada data' }}
                    </td>
                    <td>
                        {{ $surtug->catatan_pincab }}
                    </td>
                </tr>
            </table>

            <strong style="margin-left: 5px">Status Akhir : {{ $surtug->status_akhir ?? 'Proses' }} </strong>
        </div>
    </div>
</body>

</html>
