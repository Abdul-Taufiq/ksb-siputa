<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <thead style="background-color: skyblue">
            <tr>
                <th style="width: 200px; font-weight: bold;">Kode Form</th>
                <th style="width: 200px; font-weight: bold;">Nama Debitur</th>
                <th style="width: 150px; font-weight: bold;">id employee*</th>
                <th style="width: 200px; font-weight: bold;">full name</th>
                <th style="width: 150px; font-weight: bold;">branch</th>
                <th style="width: 150px; font-weight: bold;">organization</th>
                <th style="width: 150px; font-weight: bold;">job position</th>
                <th style="width: 150px; font-weight: bold;">job level</th>
                <th style="width: 150px; font-weight: bold;">employment status</th>
                <th style="width: 150px; font-weight: bold;">component id*</th>
                <th style="width: 200px; font-weight: bold;">component name</th>
                <th style="width: 200px; font-weight: bold;">old amount</th>
                <th style="width: 200px; font-weight: bold;">new amount*</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($insen as $item)
                @foreach ($item->pembagian as $data)
                    <tr>
                        <td style="text-align: left; vertical-align: top">{{ $item->kode_form }}</td>
                        <td style="text-align: left; vertical-align: top">
                            {{ $item->nama }} <br>
                            {{ $item->norek }}
                        </td>
                        <td style="text-align: left; vertical-align: top">{{ $data->nik }}</td>
                        <td style="text-align: left; vertical-align: top">{{ $data->nama }}</td>
                        <td style="text-align: left; vertical-align: top">{{ $item->cabang->cabang }}</td>
                        <td style="text-align: left; vertical-align: top"></td>
                        <td style="text-align: left; vertical-align: top">{{ $data->jabatan }}</td>
                        <td style="text-align: left; vertical-align: top"></td>
                        <td style="text-align: left; vertical-align: top"></td>
                        <td style="text-align: left; vertical-align: top">66788</td>
                        <td style="text-align: left; vertical-align: top">Insentif Penyelesaian Kredit</td>
                        <td style="text-align: left; vertical-align: top"></td>
                        <td style="text-align: left; vertical-align: top">{{ $data->nominal }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
