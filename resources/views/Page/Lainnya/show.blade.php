<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
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
                    <th style="width: 20%">Kode Surat</th>
                    <td style="width: 1%">:</td>
                    <td>{{ $pLainnya->kode_form }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td style="width: 1%">:</td>
                    <td>{{ $pLainnya->cabang->cabang }}</td>
                </tr>
                <tr>
                    <th>Jenis Pengajuan</th>
                    <td style="width: 1%">:</td>
                    <td>{{ $pLainnya->jns_pengajuan }}</td>
                </tr>
                <tr>
                    <th>File Pendukung</th>
                    <td style="width: 1%">:</td>
                    <td>
                        @if ($pLainnya->jns_pengajuan != null)
                            <a href="{{ asset('file_upload/lainnya/' . $pLainnya->file_pendukung) }}" target="_blank">
                                {{ $pLainnya->file_pendukung }} </a>
                        @else
                            <i>Tidak Ada File Pendukung</i>
                        @endif

                    </td>
                </tr>
                <tr>
                    <th>Detail Keadaan/Kerusakan/Lainnya</th>
                    <td style="width: 1%">:</td>
                    <td>{!! $pLainnya->detail_kerusakan !!}</td>
                </tr>
                <tr>
                    <th>Detail Diharapkan/biaya/lainnya</th>
                    <td style="width: 1%">:</td>
                    <td>{!! $pLainnya->detail_diharapkan !!}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td style="width: 1%">:</td>
                    <td>{!! $pLainnya->keterangan !!}</td>
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
                    <th style="width: 20%">Nama Maker</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $pLainnya->nama_kaops }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 20%">Pincab Approve?</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $pLainnya->nama_pincab }} -
                        {{ $pLainnya->status_pincab }} -
                        {{ $pLainnya->tgl_status_pincab ? $pLainnya->tgl_status_pincab->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Pembukuan Approve?</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $pLainnya->nama_pembukuan }} -
                        {{ $pLainnya->status_pembukuan }} -
                        {{ $pLainnya->tgl_status_pembukuan ? $pLainnya->tgl_status_pembukuan->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Pembukuan</th>
                    <td style="width: 1%">:</td>
                    <td>{!! $pLainnya->catatan_pembukuan !!}</td>
                </tr>
                <tr>
                    <th>Dirut Approve?</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $pLainnya->nama_dirut }} -
                        {{ $pLainnya->status_dirut }} -
                        {{ $pLainnya->tgl_status_dirut ? $pLainnya->tgl_status_dirut->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Catatan Dirut</th>
                    <td style="width: 1%">:</td>
                    <td>{!! $pLainnya->catatan_dirops !!}</td>
                </tr>
                <tr>
                    <th>TSI Approve?</th>
                    <td style="width: 1%">:</td>
                    <td>
                        @if ($pLainnya->nama_tsi != 'Tidak Diperlukan')
                            {{ $pLainnya->nama_tsi }} -
                            {{ $pLainnya->status_tsi }} -
                            {{ $pLainnya->tgl_status_tsi ? $pLainnya->tgl_status_tsi->translatedFormat('d F Y, H:i') : ' ' }}
                        @else
                            <i>Tidak Diperlukan</i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Catatan TSI</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {!! $pLainnya->nama_tsi != 'Tidak Diperlukan' ? $pLainnya->catatan_tsi : '<i>Tidak Diperlukan</i>' !!}
                    </td>
                </tr>
                <tr>
                    <th>Status Akhir</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $pLainnya->status_akhir }} -
                        {{ $pLainnya->tgl_status_akhir ? $pLainnya->tgl_status_akhir->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Diajukan</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $pLainnya->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $pLainnya->updated_at->translatedFormat('d F Y, H:i') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-warning mb-0"></div>
    </div>
</body>

</html>
