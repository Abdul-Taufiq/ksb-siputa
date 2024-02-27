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
                <td> {{ $emailP->kode_form }} </td>
            </tr>
            <tr>
                <th>Kantor Cabang</th>
                <td> {{ $emailP->cabang->cabang }} </td>
            </tr>
            <tr>
                <th>Keperluan</th>
                <td> {{ $emailP->keperluan }} </td>
            </tr>
            <tr>
                <th>NIK</th>
                <td> {{ $emailP->nik }} </td>
            </tr>
            <tr>
                <th>Nama</th>
                <td> {{ $emailP->nama }} </td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td> {{ $emailP->jabatan }} </td>
            </tr>
            <tr>
                <th>No Telp/WhatsApp</th>
                <td> <a href="https://wa.me/{{ $emailP->no_telp }}" target="_blank">{{ $emailP->no_telp }}</a>
                </td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td> {{ $emailP->keterangan }} </td>
            </tr>
    
            <tr>
                <th>Pincab Approve?</th>
                <td> {{ $emailP->status_pincab }} -
                    {{ $emailP->tgl_status_pincab ? $emailP->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>SDM Approve?</th>
                <td> {{ $emailP->status_sdm }} -
                    {{ $emailP->tgl_status_sdm ? $emailP->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }} </td>
            </tr>
            <tr>
                <th>Catatan SDM</th>
                <td> {{ $emailP->catatan_sdm }} </td>
            </tr>
            <tr>
                <th>DirOps Approve?</th>
                <td> {{ $emailP->status_dirops }} -
                    {{ $emailP->tgl_status_dirops ? $emailP->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan DirOps</th>
                <td> {{ $emailP->catatan_dirops }} </td>
            </tr>
            <tr>
                <th>TSI Approve?</th>
                <td> {{ $emailP->status_tsi }} -
                    {{ $emailP->tgl_status_tsi ? $emailP->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}</td>
            </tr>
            <tr>
                <th>Catatan TSI</th>
                <td> {{ $emailP->catatan_tsi }} </td>
            </tr>
            <tr>
                <th>Petugas Pelaksana</th>
                <td> {{ $emailP->nama_tsi }} </td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td> {{ $emailP->status_akhir }} -
                    {{ $emailP->tgl_status_akhir ? $emailP->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>

            <tr>
                <th>Tanggal Diajukan</th>
                <td> {{ $emailP->created_at->translatedFormat('d F Y, H:i') }} </td>
            </tr>
            <tr>
                <th>Last Update</th>
                <td> {{ $emailP->updated_at->translatedFormat('d F Y, H:i') }} </td>
            </tr>

        </table>
    </div>
</body>

</html>
