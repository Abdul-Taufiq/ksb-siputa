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
                    <td>{{ $userR->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $userR->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Keperluan</th>
                    <td>{{ $userR->keperluan }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $userR->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $userR->nama }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ $userR->user }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $userR->jabatan }}</td>
                </tr>
                <tr>
                    <th>No Telp/WhatsApp</th>
                    <td>
                        <a href="https://wa.me/{{ $userR->no_telp }}" target="_blank">{{ $userR->no_telp }}</a>
                    </td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $userR->keterangan }}</td>
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
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $userR->status_pincab }} -
                        {{ $userR->tgl_status_pincab ? $userR->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>SDM Approve?</th>
                    <td>
                        {{ $userR->status_sdm }} -
                        {{ $userR->tgl_status_sdm ? $userR->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan SDM</th>
                    <td>{{ $userR->catatan_sdm }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $userR->status_dirops }} -
                        {{ $userR->tgl_status_dirops ? $userR->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $userR->catatan_dirops }}</td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td>
                        {{ $userR->status_tsi }} -
                        {{ $userR->tgl_status_tsi ? $userR->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td>{{ $userR->catatan_tsi }}</td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td>{{ $userR->nama_tsi }}</td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $userR->status_akhir }} -
                        {{ $userR->tgl_status_akhir ? $userR->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>
                        {{ $userR->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td>
                        {{ $userR->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
