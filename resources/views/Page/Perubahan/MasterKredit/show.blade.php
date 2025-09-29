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
                    <td>{{ $kredit->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $kredit->cabang->cabang }}</td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Jenis Kredit</th>
                    <td> {{ $kredit->jns_kredit }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>No Rekening</th>
                    <td> {{ $kredit->no_rek }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Nama Nasabah</th>
                    <td> {{ $kredit->nama_nasabah }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Data Salah</th>
                    <td> {{ $kredit->data_salah }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Data Pembetulan</th>
                    <td> {{ $kredit->pembetulan }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>ID Agunan</th>
                    <td> {{ $kredit->id_agunan }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Alasan</th>
                    <td> {{ $kredit->alasan }} </td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $kredit->keterangan }}</td>
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
                        {{ $kredit->nama_kaops }}
                    </td>
                </tr>

                <tr>
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $kredit->status_pincab }} -
                        {{ $kredit->tgl_status_pincab ? $kredit->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pembukuan Approve?</th>
                    <td>
                        {{ $kredit->status_pembukuan }} -
                        {{ $kredit->tgl_status_pembukuan ? $kredit->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Pembukuan</th>
                    <td>{{ $kredit->catatan_pembukuan }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $kredit->status_dirops }} -
                        {{ $kredit->tgl_status_dirops ? $kredit->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $kredit->catatan_dirops }}</td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td>
                        {{ $kredit->status_tsi }} -
                        {{ $kredit->tgl_status_tsi ? $kredit->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td>{{ $kredit->catatan_tsi }}</td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td>{{ $kredit->nama_tsi }}</td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $kredit->status_akhir }} -
                        {{ $kredit->tgl_status_akhir ? $kredit->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Keputusan Pembukuan</th>
                    <td> {{ $kredit->pelanggaran_pembukuan }} </td>
                </tr>
                <tr>
                    <th>Keputusan Dirops</th>
                    <td> {{ $kredit->pelanggaran_dirops }} </td>
                </tr>
                <tr>
                    <th>Keputusan TSI</th>
                    <td> {{ $kredit->pelanggaran_tsi }} </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>
                        {{ $kredit->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td>
                        {{ $kredit->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>

            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
