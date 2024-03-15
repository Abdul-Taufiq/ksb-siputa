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
                    <td>{{ $ecollP->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $ecollP->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Keperluan</th>
                    <td>{{ $ecollP->keperluan }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $ecollP->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $ecollP->nama }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $ecollP->jabatan }}</td>
                </tr>
                <tr>
                    <th>No Telp/WhatsApp</th>
                    <td>
                        <a href="https://wa.me/{{ $ecollP->no_telp }}" target="_blank">{{ $ecollP->no_telp }}</a>
                    </td>
                </tr>

                @if ($ecollP->keperluan == 'Permohonan User Baru (Alternate)')
                    <tr>
                        <th>Masa Aktif</th>
                        <td>
                            {{ $ecollP->aktif->translatedFormat('d F Y') }}
                            {{ $ecollP->non_aktif != null ? ' - ' . $ecollP->non_aktif->translatedFormat('d F Y') : ' - Tidak Ditentukan' }}
                        </td>
                    </tr>
                @endif

                <tr>
                    <th>Keterangan</th>
                    <td>{{ $ecollP->keterangan }}</td>
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
                        {{ $ecollP->status_pincab }} -
                        {{ $ecollP->tgl_status_pincab ? $ecollP->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>SDM Approve?</th>
                    <td>
                        {{ $ecollP->status_sdm }} -
                        {{ $ecollP->tgl_status_sdm ? $ecollP->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan SDM</th>
                    <td>{{ $ecollP->catatan_sdm }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $ecollP->status_dirops }} -
                        {{ $ecollP->tgl_status_dirops ? $ecollP->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $ecollP->catatan_dirops }}</td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td>
                        {{ $ecollP->status_tsi }} -
                        {{ $ecollP->tgl_status_tsi ? $ecollP->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td>{{ $ecollP->catatan_tsi }}</td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td>{{ $ecollP->nama_tsi }}</td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $ecollP->status_akhir }} -
                        {{ $ecollP->tgl_status_akhir ? $ecollP->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>
                        {{ $ecollP->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td>
                        {{ $ecollP->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
