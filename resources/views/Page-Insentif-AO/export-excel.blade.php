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
                <tr>
                    <td style="text-align: left">{{ $item->kode_form }}</td>
                    <td style="text-align: left">{{ $item->nip }}</td>
                    <td style="text-align: left">{{ $item->nama_ao }}</td>
                    <td style="text-align: left">{{ $item->cabang->cabang }}</td>
                    <td style="text-align: left"></td>
                    <td style="text-align: left">Account Officer</td>
                    <td style="text-align: left"></td>
                    <td style="text-align: left"></td>
                    <td style="text-align: left">66788</td>
                    <td style="text-align: left">Insentif Penyelesaian Kredit</td>
                    <td style="text-align: left"></td>
                    <td style="text-align: left">{{ $item->insentif_final }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
