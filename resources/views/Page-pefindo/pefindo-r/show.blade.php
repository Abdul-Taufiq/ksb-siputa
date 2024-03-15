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
                    <td>{{ $pefindoRe->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $pefindoRe->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Keperluan</th>
                    <td>{{ $pefindoRe->keperluan }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $pefindoRe->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $pefindoRe->nama }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $pefindoRe->jabatan }}</td>
                </tr>
                <tr>
                    <th>No Telp/WhatsApp</th>
                    <td>
                        <a href="https://wa.me/{{ $pefindoRe->no_telp }}" target="_blank">{{ $pefindoRe->no_telp }}</a>
                    </td>
                </tr>

                @if ($pefindoRe->keperluan == 'Permohonan User Baru (Alternate)')
                    <tr>
                        <th>Masa Aktif</th>
                        <td>
                            {{ $pefindoRe->aktif->translatedFormat('d F Y') }}
                            {{ $pefindoRe->non_aktif != null ? ' - ' . $pefindoRe->non_aktif->translatedFormat('d F Y') : ' - Tidak Ditentukan' }}
                        </td>
                    </tr>
                @endif

                <tr>
                    <th>Keterangan</th>
                    <td>{{ $pefindoRe->keterangan }}</td>
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
                        {{ $pefindoRe->status_pincab }} -
                        {{ $pefindoRe->tgl_status_pincab ? $pefindoRe->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $pefindoRe->status_dirops }} -
                        {{ $pefindoRe->tgl_status_dirops ? $pefindoRe->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $pefindoRe->catatan_dirops }}</td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td>
                        {{ $pefindoRe->status_tsi }} -
                        {{ $pefindoRe->tgl_status_tsi ? $pefindoRe->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td>{{ $pefindoRe->catatan_tsi }}</td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td>{{ $pefindoRe->nama_tsi }}</td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $pefindoRe->status_akhir }} -
                        {{ $pefindoRe->tgl_status_akhir ? $pefindoRe->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>
                        {{ $pefindoRe->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td>
                        {{ $pefindoRe->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
