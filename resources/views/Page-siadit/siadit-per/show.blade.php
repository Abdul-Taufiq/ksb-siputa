<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="ta">
        <table style="width: 100%;" class="table table-striped">
            <tr>
                <th>Kode Surat</th>
                <td> {{ $pSiadit->kode_form }} </td>
            </tr>
            <tr>
                <th>Kantor Cabang</th>
                <td> {{ $pSiadit->cabang->cabang }} </td>
            </tr>
            <tr>
                <th>Keperluan</th>
                <td> {{ $pSiadit->keperluan }} </td>
            </tr>
            <tr>
                <th>Nomor SPK</th>
                <td> {{ $pSiadit->no_spk }} </td>
            </tr>
            <tr>
                <th>Nama Nasabah</th>
                <td> {{ $pSiadit->nama_nasabah }} </td>
            </tr>
            <tr>
                <th>Data Salah</th>
                <td> {{ $pSiadit->data_salah }} </td>
            </tr>
            <tr>
                <th>Data Pembetulan</th>
                <td> {{ $pSiadit->pembetulan }} </td>
            </tr>
            <tr>
                <th>User Pelaku</th>
                <td> {{ $pSiadit->user }}</a>
                </td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td> {{ $pSiadit->keterangan }} </td>
            </tr>



            {{-- wajib --}}
            <tr>
                <th>Pincab Approve?</th>
                <td> {{ $pSiadit->status_pincab }} -
                    {{ $pSiadit->tgl_status_pincab ? $pSiadit->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>SDM Approve?</th>
                <td> {{ $pSiadit->status_sdm }} -
                    {{ $pSiadit->tgl_status_sdm ? $pSiadit->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan SDM</th>
                <td> {{ $pSiadit->catatan_sdm }} </td>
            </tr>
            <tr>
                <th>DirOps Approve?</th>
                <td> {{ $pSiadit->status_dirops }} -
                    {{ $pSiadit->tgl_status_dirops ? $pSiadit->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan DirOps</th>
                <td> {{ $pSiadit->catatan_dirops }} </td>
            </tr>
            <tr>
                <th>TSI Approve?</th>
                <td> {{ $pSiadit->status_tsi }} -
                    {{ $pSiadit->tgl_status_tsi ? $pSiadit->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan TSI</th>
                <td> {{ $pSiadit->catatan_tsi }} </td>
            </tr>
            <tr>
                <th>Petugas Pelaksana</th>
                <td> {{ $pSiadit->nama_tsi }} </td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td> {{ $pSiadit->status_akhir }} -
                    {{ $pSiadit->tgl_status_akhir ? $pSiadit->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>

            <tr>
                <th>Keputusan Pembukuan</th>
                <td> {{ $pSiadit->pelanggaran_pembukuan }} </td>
            </tr>
            <tr>
                <th>Keputusan Dirops</th>
                <td> {{ $pSiadit->pelanggaran_dirops }} </td>
            </tr>
            <tr>
                <th>Keputusan TSI</th>
                <td> {{ $pSiadit->pelanggaran_tsi }} </td>
            </tr>

            <tr>
                <th>Tanggal Diajukan</th>
                <td> {{ $pSiadit->created_at->translatedFormat('d F Y, H:i') }} </td>
            </tr>
            <tr>
                <th>Last Update</th>
                <td> {{ $pSiadit->updated_at->translatedFormat('d F Y, H:i') }} </td>
            </tr>

        </table>
    </div>
</body>

</html>
