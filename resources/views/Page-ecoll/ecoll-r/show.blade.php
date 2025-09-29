<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
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
            <table style="width: 100%" class="table table-striped">
                <tr>
                    <th>Kode Surat</th>
                    <td>{{ $ecollR->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $ecollR->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Keperluan</th>
                    <td>{{ $ecollR->keperluan }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $ecollR->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $ecollR->nama }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ $ecollR->user }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $ecollR->jabatan }}</td>
                </tr>
                <tr>
                    <th>No Telp/WhatsApp</th>
                    <td>
                        <a href="https://wa.me/{{ $ecollR->no_telp }}" target="_blank">{{ $ecollR->no_telp }}</a>
                    </td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $ecollR->keterangan }}</td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>



    <div class="card card-outline card-warning">
        <div class="card-header">
            <h6><b>Tracking &rarr;</b></h6>
        </div>
        <div class="card-body">
            <table style="width: 100%" class="table table-striped">

                <tr>
                    <th>Nama Maker</th>
                    <td>
                        {{ $ecollR->nama_kaops }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $ecollR->status_pincab }} -
                        {{ $ecollR->tgl_status_pincab ? $ecollR->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>SDM Approve?</th>
                    <td>
                        {{ $ecollR->status_sdm }} -
                        {{ $ecollR->tgl_status_sdm ? $ecollR->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan SDM</th>
                    <td>{{ $ecollR->catatan_sdm }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $ecollR->status_dirops }} -
                        {{ $ecollR->tgl_status_dirops ? $ecollR->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $ecollR->catatan_dirops }}</td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td>
                        {{ $ecollR->status_tsi }} -
                        {{ $ecollR->tgl_status_tsi ? $ecollR->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td>{{ $ecollR->catatan_tsi }}</td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td>{{ $ecollR->nama_tsi }}</td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $ecollR->status_akhir }} -
                        {{ $ecollR->tgl_status_akhir ? $ecollR->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>
                        {{ $ecollR->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td>
                        {{ $ecollR->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
