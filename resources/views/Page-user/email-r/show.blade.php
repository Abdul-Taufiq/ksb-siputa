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
                    <td> {{ $emailR->kode_form }} </td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td> {{ $emailR->cabang->cabang }} </td>
                </tr>
                <tr>
                    <th>Keperluan</th>
                    <td> {{ $emailR->keperluan }} </td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td> {{ $emailR->nik }} </td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td> {{ $emailR->nama }} </td>
                </tr>
                <tr>
                    <th>User/Email</th>
                    <td> {{ $emailR->user }} </td>
                </tr>
                <tr>
                    <th>No Telp/WhatsApp</th>
                    <td> <a href="https://wa.me/{{ $emailR->no_telp }}" target="_blank">{{ $emailR->no_telp }}</a>
                    </td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td> {{ $emailR->keterangan }} </td>
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
                    <td> {{ $emailR->nama_kaops }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td> {{ $emailR->status_pincab }} -
                        {{ $emailR->tgl_status_pincab ? $emailR->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>SDM Approve?</th>
                    <td> {{ $emailR->status_sdm }} -
                        {{ $emailR->tgl_status_sdm ? $emailR->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan SDM</th>
                    <td> {{ $emailR->catatan_sdm }} </td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td> {{ $emailR->status_dirops }} -
                        {{ $emailR->tgl_status_dirops ? $emailR->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td> {{ $emailR->catatan_dirops }} </td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td> {{ $emailR->status_tsi }} -
                        {{ $emailR->tgl_status_tsi ? $emailR->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td> {{ $emailR->catatan_tsi }} </td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td> {{ $emailR->nama_tsi }} </td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td> {{ $emailR->status_akhir }} -
                        {{ $emailR->tgl_status_akhir ? $emailR->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td> {{ $emailR->created_at->translatedFormat('d F Y, H:i') }} </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td> {{ $emailR->updated_at->translatedFormat('d F Y, H:i') }} </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
