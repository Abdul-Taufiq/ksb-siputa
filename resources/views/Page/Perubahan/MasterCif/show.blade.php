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
                    <td>{{ $cif->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $cif->cabang->cabang }}</td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Jenis CIF</th>
                    <td> {{ $cif->jns_cif }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Nama Nasabah</th>
                    <td> {{ $cif->nama_nasabah }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Nomor CIF Merger</th>
                    <td> {{ $cif->no_cif_merger }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>No CIF Primary</th>
                    <td> {{ $cif->no_cif_utama }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Alasan Merger</th>
                    <td> {{ $cif->alasan }} </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>File KTP/KK</th>
                    <td>
                        <a href="{{ asset('file_upload/perubahan data/' . $cif->ktp) }}" target="_blank">
                            {{ $cif->ktp ? $cif->ktp : 'null' }}
                        </a>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Nama Ibu</th>
                    <td> {{ $cif->nama_ibu }} </td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $cif->keterangan }}</td>
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
                        {{ $cif->nama_kaops }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $cif->status_pincab }} -
                        {{ $cif->tgl_status_pincab ? $cif->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pembukuan Approve?</th>
                    <td>
                        {{ $cif->status_pembukuan }} -
                        {{ $cif->tgl_status_pembukuan ? $cif->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Pembukuan</th>
                    <td>{{ $cif->catatan_pembukuan }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $cif->status_dirops }} -
                        {{ $cif->tgl_status_dirops ? $cif->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $cif->catatan_dirops }}</td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td>
                        {{ $cif->status_tsi }} -
                        {{ $cif->tgl_status_tsi ? $cif->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td>{{ $cif->catatan_tsi }}</td>
                </tr>
                <tr>
                    <th>Petugas Pelaksana</th>
                    <td>{{ $cif->nama_tsi }}</td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $cif->status_akhir }} -
                        {{ $cif->tgl_status_akhir ? $cif->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Keputusan Pembukuan</th>
                    <td> {{ $cif->pelanggaran_pembukuan }} </td>
                </tr>
                <tr>
                    <th>Keputusan Dirops</th>
                    <td> {{ $cif->pelanggaran_dirops }} </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>
                        {{ $cif->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td>
                        {{ $cif->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
