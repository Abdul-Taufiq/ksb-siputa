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
                <td>{{ $pefindo->kode_form }}</td>
            </tr>
            <tr>
                <th>Kantor Cabang</th>
                <td>{{ $pefindo->cabang->cabang }}</td>
            </tr>
            <tr>
                <th>Keperluan</th>
                <td>{{ $pefindo->keperluan }}</td>
            </tr>
            <tr>
                <th>NIK</th>
                <td>{{ $pefindo->nik }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $pefindo->nama }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $pefindo->jabatan }}</td>
            </tr>
            <tr>
                <th>No Telp/WhatsApp</th>
                <td>
                    <a href="https://wa.me/{{ $pefindo->no_telp }}" target="_blank">{{ $pefindo->no_telp }}</a>
                </td>
            </tr>

            @if ($pefindo->keperluan == 'Permohonan User Baru (Alternate)')
                <tr>
                    <th>Masa Aktif</th>
                    <td>
                        {{ $pefindo->aktif->translatedFormat('d F Y') }}
                        {{ $pefindo->non_aktif != null ? ' - ' . $pefindo->non_aktif->translatedFormat('d F Y') : ' - Tidak Ditentukan' }}
                    </td>
                </tr>
            @endif

            <tr>
                <th>Keterangan</th>
                <td>{{ $pefindo->keterangan }}</td>
            </tr>
            <tr>
                <th>Pincab Approve?</th>
                <td>
                    {{ $pefindo->status_pincab }} -
                    {{ $pefindo->tgl_status_pincab ? $pefindo->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>DirOps Approve?</th>
                <td>
                    {{ $pefindo->status_dirops }} -
                    {{ $pefindo->tgl_status_dirops ? $pefindo->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan DirOps</th>
                <td>{{ $pefindo->catatan_dirops }}</td>
            </tr>
            <tr>
                <th>TSI Approve?</th>
                <td>
                    {{ $pefindo->status_tsi }} -
                    {{ $pefindo->tgl_status_tsi ? $pefindo->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan TSI</th>
                <td>{{ $pefindo->catatan_tsi }}</td>
            </tr>
            <tr>
                <th>Petugas Pelaksana</th>
                <td>{{ $pefindo->nama_tsi }}</td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td>
                    {{ $pefindo->status_akhir }} -
                    {{ $pefindo->tgl_status_akhir ? $pefindo->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>

            <tr>
                <th>Tanggal Diajukan</th>
                <td>
                    {{ $pefindo->created_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
            <tr>
                <th>Last Update</th>
                <td>
                    {{ $pefindo->updated_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
