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
            <h6><b>Detail Data &rarr;</b></h6>
        </div>
        <div class="card-body">
            <table style="width: 100%" class="table table-striped">
                <tr>
                    <th>Tanggal Transaksi</th>
                    <td>{{ $shareBiaya->tgl_transaksi ? $shareBiaya->tgl_transaksi->translatedFormat('d F Y') : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>Kantor Cabang</th>
                    <td>{{ $shareBiaya->kc }}</td>
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td>{{ $shareBiaya->nominal }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $shareBiaya->keterangan }}</td>
                </tr>
                <tr>
                    <th>File Lampiran</th>
                    <td>
                        <a
                            href="{{ asset('file_upload/ShareBiaya/' . $shareBiaya->file_lampiran) }}">{{ $shareBiaya->file_lampiran }}</a>
                    </td>
                </tr>
                <tr>
                    <th>Creator</th>
                    <td>
                        {{ $shareBiaya->creator }} -
                        {{ $shareBiaya->created_at ? $shareBiaya->created_at->translatedFormat('d F Y, H:i') : ' ' }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>

</body>

</html>
