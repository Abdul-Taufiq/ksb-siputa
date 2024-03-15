<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
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
                    <td>{{ $akuntansi->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $akuntansi->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Jenis Akuntansi</th>
                    <td>{{ $akuntansi->jns_akuntansi }}</td>
                </tr>
                <tr>
                    <th>ID Transaksi</th>
                    <td>{{ $akuntansi->id_transaksi }}</td>
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td>{{ $akuntansi->nominal }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ $akuntansi->user }}</td>
                </tr>
                <tr>
                    <th>Alasan</th>
                    <td>{{ $akuntansi->alasan }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $akuntansi->keterangan }}</td>
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
                        {{ $akuntansi->nama_kaops }} -
                        {{ $akuntansi->created_at ? $akuntansi->created_at->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $akuntansi->status_pincab }} -
                        {{ $akuntansi->tgl_status_pincab ? $akuntansi->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pembukuan Approve?</th>
                    <td>
                        {{ $akuntansi->status_pembukuan }} -
                        {{ $akuntansi->tgl_status_pembukuan ? $akuntansi->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Pembukuan</th>
                    <td>{{ $akuntansi->catatan_pembukuan }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $akuntansi->status_dirops }} -
                        {{ $akuntansi->tgl_status_dirops ? $akuntansi->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $akuntansi->catatan_dirops }}</td>
                </tr>

                <tr>
                    <th>Petugas Pelaksana</th>
                    <td>{{ $akuntansi->nama_pembukuan }}</td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $akuntansi->status_akhir }} -
                        {{ $akuntansi->tgl_status_akhir ? $akuntansi->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Keputusan Pembukuan</th>
                    <td> {{ $akuntansi->pelanggaran_pembukuan }} </td>
                </tr>
                <tr>
                    <th>Keputusan Dirops</th>
                    <td> {{ $akuntansi->pelanggaran_dirops }} </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>
                        {{ $akuntansi->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td>
                        {{ $akuntansi->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
