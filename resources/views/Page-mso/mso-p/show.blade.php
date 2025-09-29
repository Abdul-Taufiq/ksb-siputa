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
                    <td>{{ $userP->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $userP->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Keperluan</th>
                    <td>{{ $userP->keperluan }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $userP->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $userP->nama }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $userP->jabatan }}</td>
                </tr>
                <tr>
                    <th>No Telp/WhatsApp</th>
                    <td>
                        <a href="https://wa.me/{{ $userP->no_telp }}" target="_blank">{{ $userP->no_telp }}</a>
                    </td>
                </tr>

                @if ($userP->keperluan == 'Permohonan User Baru (Alternate)')
                    <tr>
                        <th>Masa Aktif</th>
                        <td>
                            {{ $userP->aktif->translatedFormat('d F Y') }}
                            {{ $userP->non_aktif != null ? ' - ' . $userP->non_aktif->translatedFormat('d F Y') : ' - Tidak Ditentukan' }}
                        </td>
                    </tr>
                @endif

                <tr>
                    <th>Keterangan</th>
                    <td>{{ $userP->keterangan }}</td>
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
                        {{ $userP->nama_kaops }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $userP->status_pincab }} -
                        {{ $userP->tgl_status_pincab ? $userP->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>SDM Approve?</th>
                    <td>
                        {{ $userP->status_sdm }} -
                        {{ $userP->tgl_status_sdm ? $userP->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan SDM</th>
                    <td>{{ $userP->catatan_sdm }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $userP->status_dirops }} -
                        {{ $userP->tgl_status_dirops ? $userP->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $userP->catatan_dirops }}</td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td>
                        {{ $userP->status_tsi }} -
                        {{ $userP->tgl_status_tsi ? $userP->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td>{{ $userP->catatan_tsi }}</td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td>{{ $userP->nama_tsi }}</td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $userP->status_akhir }} -
                        {{ $userP->tgl_status_akhir ? $userP->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>
                        {{ $userP->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td>
                        {{ $userP->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
