<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
</head>

<body>
    <div class="ta">
        <table style="width: 100%" class="table table-striped">
            <tr>
                <th>Kode Surat</th>
                <td>{{ $pEcoll->kode_form }}</td>
            </tr>
            <tr>
                <th>Kantor Cabang</th>
                <td>{{ $pEcoll->cabang->cabang }}</td>
            </tr>
            <tr>
                <th>ID Transaksi</th>
                <td>{{ $pEcoll->id_transaksi }}</td>
            </tr>
            <tr>
                <th>No Rekening</th>
                <td>{{ $pEcoll->no_rek }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $pEcoll->nama }}</td>
            </tr>
            <tr>
                <th>Nominal</th>
                <td>{{ $pEcoll->nominal }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $pEcoll->user }}</td>
            </tr>
            <tr>
                <th>Alasan</th>
                <td>{{ $pEcoll->alasan }}</td>
            </tr>

            <tr>
                <th>Keterangan</th>
                <td>{{ $pEcoll->keterangan }}</td>
            </tr>
            <tr>
                <th>Pincab Approve?</th>
                <td>
                    {{ $pEcoll->status_pincab }} -
                    {{ $pEcoll->tgl_status_pincab ? $pEcoll->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Pembukuan Approve?</th>
                <td>
                    {{ $pEcoll->status_pembukuan }} -
                    {{ $pEcoll->tgl_status_pembukuan ? $pEcoll->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan Pembukuan</th>
                <td>{{ $pEcoll->catatan_pembukuan }}</td>
            </tr>
            <tr>
                <th>DirOps Approve?</th>
                <td>
                    {{ $pEcoll->status_dirops }} -
                    {{ $pEcoll->tgl_status_dirops ? $pEcoll->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan DirOps</th>
                <td>{{ $pEcoll->catatan_dirops }}</td>
            </tr>
            <tr>
                <th>TSI Approve?</th>
                <td>
                    {{ $pEcoll->status_tsi }} -
                    {{ $pEcoll->tgl_status_tsi ? $pEcoll->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan TSI</th>
                <td>{{ $pEcoll->catatan_tsi }}</td>
            </tr>
            <tr>
                <th>Petugas Pelaksana</th>
                <td>{{ $pEcoll->nama_tsi }}</td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td>
                    {{ $pEcoll->status_akhir }} -
                    {{ $pEcoll->tgl_status_akhir ? $pEcoll->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>

            <tr>
                <th>Keputusan TSI</th>
                <td> {{ $pEcoll->pelanggaran_tsi }} </td>
            </tr>
            <tr>
                <th>Keputusan Dirops</th>
                <td> {{ $pEcoll->pelanggaran_dirops }} </td>
            </tr>
            <tr>
                <th>Keputusan TSI</th>
                <td> {{ $pEcoll->pelanggaran_tsi }} </td>
            </tr>

            <tr>
                <th>Tanggal Diajukan</th>
                <td>
                    {{ $pEcoll->created_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
            <tr>
                <th>Last Update</th>
                <td>
                    {{ $pEcoll->updated_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
