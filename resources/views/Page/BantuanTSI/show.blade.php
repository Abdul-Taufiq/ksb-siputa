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
                    <td> {{ $bantuanTSI->kode_form }} </td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td> {{ $bantuanTSI->cabang->cabang }} </td>
                </tr>
                <tr>
                    <th>Detail Permasalahan</th>
                    <td> {!! $bantuanTSI->detail_permasalahan !!} </td>
                </tr>
                <tr>
                    <th>Detail Kendala</th>
                    <td> {!! $bantuanTSI->detail_kendala !!} </td>
                </tr>
                <tr>
                    <th>Detail Perbaikan</th>
                    <td> {!! $bantuanTSI->detail_perbaikan !!} </td>
                </tr>
                <tr>
                    <th>Tanggal Pelaksanaan</th>
                    <td> {{ $bantuanTSI->tgl_pelaksanaan ? $bantuanTSI->tgl_pelaksanaan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
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
                    <th>Creator</th>
                    <td>
                        {{ $bantuanTSI->nama_kaops }} -
                        {{ $bantuanTSI->created_at ? $bantuanTSI->created_at->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td> {{ $bantuanTSI->status_pincab }} -
                        {{ $bantuanTSI->tgl_status_pincab ? $bantuanTSI->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Kabid Operasional Approve?</th>
                    <td> {{ $bantuanTSI->status_pembukuan }} -
                        {{ $bantuanTSI->tgl_status_pembukuan ? $bantuanTSI->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Kabid Operasional</th>
                    <td> {{ $bantuanTSI->catatan_pembukuan }} </td>
                </tr>

                <tr>
                    <th>SDM Approve?</th>
                    <td> {{ $bantuanTSI->status_sdm }} -
                        {{ $bantuanTSI->tgl_status_sdm ? $bantuanTSI->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan SDM</th>
                    <td> {{ $bantuanTSI->catatan_sdm }} </td>
                </tr>

                <tr>
                    <th>TSI Approve?</th>
                    <td> {{ $bantuanTSI->status_tsi }} -
                        {{ $bantuanTSI->tgl_status_tsi ? $bantuanTSI->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td> {{ $bantuanTSI->catatan_tsi }} </td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td> {{ $bantuanTSI->nama_tsi }} </td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td> {{ $bantuanTSI->status_akhir }} -
                        {{ $bantuanTSI->tgl_status_akhir ? $bantuanTSI->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td> {{ $bantuanTSI->created_at->translatedFormat('d F Y, H:i') }} </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td> {{ $bantuanTSI->updated_at->translatedFormat('d F Y, H:i') }} </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
