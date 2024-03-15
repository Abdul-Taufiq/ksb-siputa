<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            <table style="width: 100%;" class="table table-striped">
                <tr>
                    <th>Kode Surat</th>
                    <td> {{ $uSiadit->kode_form }} </td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td> {{ $uSiadit->cabang->cabang }} </td>
                </tr>
                <tr>
                    <th>Keperluan</th>
                    <td> {{ $uSiadit->keperluan }} </td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td> {{ $uSiadit->nik }} </td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td> {{ $uSiadit->nama }} </td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td> {{ $uSiadit->jabatan }} </td>
                </tr>
                <tr>
                    <th>No Telp/WhatsApp</th>
                    <td> <a href="https://wa.me/{{ $uSiadit->no_telp }}" target="_blank">{{ $uSiadit->no_telp }}</a>
                    </td>
                </tr>

                @if ($uSiadit->keperluan == 'Alternate User')
                    <tr>
                        <th>Masa Aktif</th>
                        <td>
                            {{ $uSiadit->aktif->translatedFormat('d F Y') }}
                            {{ $uSiadit->non_aktif != null ? ' - ' . $uSiadit->non_aktif->translatedFormat('d F Y') : ' - Tidak Ditentukan' }}
                        </td>
                    </tr>
                @endif

                <tr>
                    <th>Keterangan</th>
                    <td> {{ $uSiadit->keterangan }} </td>
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
                    <td> {{ $uSiadit->status_pincab }} -
                        {{ $uSiadit->tgl_status_pincab ? $uSiadit->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>SDM Approve?</th>
                    <td> {{ $uSiadit->status_sdm }} -
                        {{ $uSiadit->tgl_status_sdm ? $uSiadit->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan SDM</th>
                    <td> {{ $uSiadit->catatan_sdm }} </td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td> {{ $uSiadit->status_dirops }} -
                        {{ $uSiadit->tgl_status_dirops ? $uSiadit->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td> {{ $uSiadit->catatan_dirops }} </td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td> {{ $uSiadit->status_tsi }} -
                        {{ $uSiadit->tgl_status_tsi ? $uSiadit->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td> {{ $uSiadit->catatan_tsi }} </td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td> {{ $uSiadit->nama_tsi }} </td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td> {{ $uSiadit->status_akhir }} -
                        {{ $uSiadit->tgl_status_akhir ? $uSiadit->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td> {{ $uSiadit->created_at->translatedFormat('d F Y, H:i') }} </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td> {{ $uSiadit->updated_at->translatedFormat('d F Y, H:i') }} </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
