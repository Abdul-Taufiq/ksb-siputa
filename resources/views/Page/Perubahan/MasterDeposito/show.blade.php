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
                <td>{{ $deposito->kode_form }}</td>
            </tr>
            <tr>
                <th>Kantor Cabang</th>
                <td>{{ $deposito->cabang->cabang }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <th>Jenis Prngajuan</th>
                <td> {{ $deposito->jns_deposito }} </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <th>No Rekening</th>
                <td> {{ $deposito->no_rek }} </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <th>Nama Nasabah</th>
                <td> {{ $deposito->nama_nasabah }} </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <th>Data Salah</th>
                <td> {{ $deposito->data_salah }} </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <th>Data Pembetulan</th>
                <td> {{ $deposito->pembetulan }} </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <th>Alasan</th>
                <td> {{ $deposito->alasan }} </td>
            </tr>

            <tr>
                <th>Keterangan</th>
                <td>{{ $deposito->keterangan }}</td>
            </tr>
            <tr>
                <th>Pincab Approve?</th>
                <td>
                    {{ $deposito->status_pincab }} -
                    {{ $deposito->tgl_status_pincab ? $deposito->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Pembukuan Approve?</th>
                <td>
                    {{ $deposito->status_pembukuan }} -
                    {{ $deposito->tgl_status_pembukuan ? $deposito->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan Pembukuan</th>
                <td>{{ $deposito->catatan_pembukuan }}</td>
            </tr>
            <tr>
                <th>DirOps Approve?</th>
                <td>
                    {{ $deposito->status_dirops }} -
                    {{ $deposito->tgl_status_dirops ? $deposito->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan DirOps</th>
                <td>{{ $deposito->catatan_dirops }}</td>
            </tr>
            <tr>
                <th>TSI Approve?</th>
                <td>
                    {{ $deposito->status_tsi }} -
                    {{ $deposito->tgl_status_tsi ? $deposito->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan TSI</th>
                <td>{{ $deposito->catatan_tsi }}</td>
            </tr>
            <tr>
                <th>Petugas Pelaksana</th>
                <td>{{ $deposito->nama_tsi }}</td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td>
                    {{ $deposito->status_akhir }} -
                    {{ $deposito->tgl_status_akhir ? $deposito->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>

            <tr>
                <th>Keputusan Pembukuan</th>
                <td> {{ $deposito->pelanggaran_pembukuan }} </td>
            </tr>
            <tr>
                <th>Keputusan Dirops</th>
                <td> {{ $deposito->pelanggaran_dirops }} </td>
            </tr>
            <tr>
                <th>Keputusan TSI</th>
                <td> {{ $deposito->pelanggaran_tsi }} </td>
            </tr>

            <tr>
                <th>Tanggal Diajukan</th>
                <td>
                    {{ $deposito->created_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
            <tr>
                <th>Last Update</th>
                <td>
                    {{ $deposito->updated_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
