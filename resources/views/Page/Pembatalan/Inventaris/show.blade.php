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
                <td>{{ $inventaris->kode_form }}</td>
            </tr>
            <tr>
                <th>Kantor Cabang</th>
                <td>{{ $inventaris->cabang->cabang }}</td>
            </tr>
            <tr>
                <th>ID Transaksi</th>
                <td>{{ $inventaris->id_transaksi }}</td>
            </tr>
            <tr>
                <th>No Seri</th>
                <td>{{ $inventaris->nomor_seri }}</td>
            </tr>
            <tr>
                <th>Nama Barang</th>
                <td>{{ $inventaris->nama_barang }}</td>
            </tr>
            <tr>
                <th>Nominal</th>
                <td>{{ $inventaris->nominal }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $inventaris->user }}</td>
            </tr>
            <tr>
                <th>Alasan</th>
                <td>{{ $inventaris->alasan }}</td>
            </tr>

            <tr>
                <th>Keterangan</th>
                <td>{{ $inventaris->keterangan }}</td>
            </tr>
            <tr>
                <th>Pincab Approve?</th>
                <td>
                    {{ $inventaris->status_pincab }} -
                    {{ $inventaris->tgl_status_pincab ? $inventaris->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Pembukuan Approve?</th>
                <td>
                    {{ $inventaris->status_pembukuan }} -
                    {{ $inventaris->tgl_status_pembukuan ? $inventaris->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan Pembukuan</th>
                <td>{{ $inventaris->catatan_pembukuan }}</td>
            </tr>
            <tr>
                <th>DirOps Approve?</th>
                <td>
                    {{ $inventaris->status_dirops }} -
                    {{ $inventaris->tgl_status_dirops ? $inventaris->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan DirOps</th>
                <td>{{ $inventaris->catatan_dirops }}</td>
            </tr>
            {{-- <tr>
                <th>TSI Approve?</th>
                <td>
                    {{ $inventaris->status_tsi }} -
                    {{ $inventaris->tgl_status_tsi ? $inventaris->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan TSI</th>
                <td>{{ $inventaris->catatan_tsi }}</td>
            </tr> --}}
            <tr>
                <th>Petugas Pelaksana</th>
                <td>{{ $inventaris->nama_pembukuan }}</td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td>
                    {{ $inventaris->status_akhir }} -
                    {{ $inventaris->tgl_status_akhir ? $inventaris->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>

            <tr>
                <th>Keputusan Pembukuan</th>
                <td> {{ $inventaris->pelanggaran_pembukuan }} </td>
            </tr>
            <tr>
                <th>Keputusan Dirops</th>
                <td> {{ $inventaris->pelanggaran_dirops }} </td>
            </tr>

            <tr>
                <th>Tanggal Diajukan</th>
                <td>
                    {{ $inventaris->created_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
            <tr>
                <th>Last Update</th>
                <td>
                    {{ $inventaris->updated_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
