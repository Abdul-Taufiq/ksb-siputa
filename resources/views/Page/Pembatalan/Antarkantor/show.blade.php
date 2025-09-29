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
                    <td>{{ $antarkantor->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $antarkantor->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>ID Transaksi</th>
                    <td>{{ $antarkantor->id_transaksi }}</td>
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td>{{ $antarkantor->nominal }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ $antarkantor->user }}</td>
                </tr>
                <tr>
                    <th>Alasan</th>
                    <td>{{ $antarkantor->alasan }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $antarkantor->keterangan }}</td>
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
                        {{ $antarkantor->nama_kaops }}
                    </td>
                </tr>
                <tr>
                    <th>Pincab Approve?</th>
                    <td>
                        {{ $antarkantor->status_pincab }} -
                        {{ $antarkantor->tgl_status_pincab ? $antarkantor->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pembukuan Approve?</th>
                    <td>
                        {{ $antarkantor->status_pembukuan }} -
                        {{ $antarkantor->tgl_status_pembukuan ? $antarkantor->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Pembukuan</th>
                    <td>{{ $antarkantor->catatan_pembukuan }}</td>
                </tr>
                <tr>
                    <th>DirOps Approve?</th>
                    <td>
                        {{ $antarkantor->status_dirops }} -
                        {{ $antarkantor->tgl_status_dirops ? $antarkantor->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan DirOps</th>
                    <td>{{ $antarkantor->catatan_dirops }}</td>
                </tr>

                <tr>
                    <th>Petugas Pelaksana</th>
                    <td>{{ $antarkantor->nama_pembukuan }}</td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td>
                        {{ $antarkantor->status_akhir }} -
                        {{ $antarkantor->tgl_status_akhir ? $antarkantor->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Keputusan Pembukuan</th>
                    <td> {{ $antarkantor->pelanggaran_pembukuan }} </td>
                </tr>
                <tr>
                    <th>Keputusan Dirops</th>
                    <td> {{ $antarkantor->pelanggaran_dirops }} </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>
                        {{ $antarkantor->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td>
                        {{ $antarkantor->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
