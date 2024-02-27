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
                <td>{{ $pslik->kode_form }}</td>
            </tr>
            <tr>
                <th>Kantor Cabang</th>
                <td>{{ $pslik->cabang->cabang }}</td>
            </tr>
            <tr>
                <th>Keperluan</th>
                <td>{{ $pslik->keperluan }}</td>
            </tr>
            <tr>
                <th>NIK</th>
                <td>{{ $pslik->nik }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $pslik->nama }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $pslik->jabatan }}</td>
            </tr>
            <tr>
                <th>No Telp/WhatsApp</th>
                <td>
                    <a href="https://wa.me/{{ $pslik->no_telp }}" target="_blank">{{ $pslik->no_telp }}</a>
                </td>
            </tr>

            @if ($pslik->keperluan == 'Permohonan User Baru (Alternate)')
                <tr>
                    <th>Masa Aktif</th>
                    <td>
                        {{ $pslik->aktif->translatedFormat('d F Y') }}
                        {{ $pslik->non_aktif != null ? ' - ' . $pslik->non_aktif->translatedFormat('d F Y') : ' - Tidak Ditentukan' }}
                    </td>
                </tr>
            @endif

            <tr>
                <th>Keterangan</th>
                <td>{{ $pslik->keterangan }}</td>
            </tr>
            <tr>
                <th>Pincab Approve?</th>
                <td>
                    {{ $pslik->status_pincab }} -
                    {{ $pslik->tgl_status_pincab ? $pslik->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>SDM Approve?</th>
                <td>
                    {{ $pslik->status_sdm }} -
                    {{ $pslik->tgl_status_sdm ? $pslik->tgl_status_sdm->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan SDM</th>
                <td>{{ $pslik->catatan_sdm }}</td>
            </tr>
            <tr>
                <th>DirOps Approve?</th>
                <td>
                    {{ $pslik->status_dirops }} -
                    {{ $pslik->tgl_status_dirops ? $pslik->tgl_status_dirops->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan DirOps</th>
                <td>{{ $pslik->catatan_dirops }}</td>
            </tr>
            <tr>
                <th>TSI Approve?</th>
                <td>
                    {{ $pslik->status_tsi }} -
                    {{ $pslik->tgl_status_tsi ? $pslik->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>
            <tr>
                <th>Catatan TSI</th>
                <td>{{ $pslik->catatan_tsi }}</td>
            </tr>
            <tr>
                <th>Petugas Pelaksana</th>
                <td>{{ $pslik->nama_tsi }}</td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td>
                    {{ $pslik->status_akhir }} -
                    {{ $pslik->tgl_status_akhir ? $pslik->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                </td>
            </tr>

            <tr>
                <th>Tanggal Diajukan</th>
                <td>
                    {{ $pslik->created_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
            <tr>
                <th>Last Update</th>
                <td>
                    {{ $pslik->updated_at->translatedFormat('d F Y, H:i') }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
