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
                <td>{{ $tabungan->kode_form }}</td>
            </tr>
            <tr>
                <th>Kantor Cabang</th>
                <td>{{ $tabungan->cabang->cabang }}</td>
            </tr>
            <tr>
                <th>ID Transaksi</th>
                <td>{{ $tabungan->id_transaksi }}</td>
            </tr>
            <tr>
                <th>No Rekening</th>
                <td>{{ $tabungan->no_rek }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $tabungan->nama }}</td>
            </tr>
            <tr>
                <th>Nominal</th>
                <td>{{ $tabungan->nominal }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $tabungan->user }}</td>
            </tr>
            <tr>
                <th>Alasan</th>
                <td>{{ $tabungan->alasan }}</td>
            </tr>

            <tr>
                <th>Keterangan</th>
                <td>{{ $tabungan->keterangan }}</td>
            </tr>
            <tr>
                <th>Pincab Approve?</th>
                <td>
                    {{ $tabungan->status_pincab }} -
                    {{ $tabungan->tgl_status_pincab ? $tabungan->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Pembukuan Approve?</th>
                <td>
                    {{ $tabungan->status_pembukuan }} -
                    {{ $tabungan->tgl_status_pembukuan ? $tabungan->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan Pembukuan</th>
                <td>{{ $tabungan->catatan_pembukuan }}</td>
            </tr>
            <tr>
                <th>DirOps Approve?</th>
                <td>
                    {{ $tabungan->status_dirops }} -
                    {{ $tabungan->tgl_status_dirops ? $tabungan->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan DirOps</th>
                <td>{{ $tabungan->catatan_dirops }}</td>
            </tr>
            {{-- <tr>
                <th>TSI Approve?</th>
                <td>
                    {{ $tabungan->status_tsi }} -
                    {{ $tabungan->tgl_status_tsi ? $tabungan->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan TSI</th>
                <td>{{ $tabungan->catatan_tsi }}</td>
            </tr> --}}
            <tr>
                <th>Petugas Pelaksana</th>
                <td>{{ $tabungan->nama_pembukuan }}</td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td>
                    {{ $tabungan->status_akhir }} -
                    {{ $tabungan->tgl_status_akhir ? $tabungan->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>

            <tr>
                <th>Keputusan Pembukuan</th>
                <td> {{ $tabungan->pelanggaran_pembukuan }} </td>
            </tr>
            <tr>
                <th>Keputusan Dirops</th>
                <td> {{ $tabungan->pelanggaran_dirops }} </td>
            </tr>

            <tr>
                <th>Tanggal Diajukan</th>
                <td>
                    {{ $tabungan->created_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
            <tr>
                <th>Last Update</th>
                <td>
                    {{ $tabungan->updated_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
