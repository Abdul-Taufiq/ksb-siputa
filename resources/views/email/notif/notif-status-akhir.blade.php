<div style="background-color: #f2f2f2; padding: 20px;">
    <div style="background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        <h3 style="font-family: Arial, sans-serif;">Hallo,</h3>
        <p style="font-family: Arial, sans-serif;">
            Form Pengajuan dengan data sebagai berikut : <br>
        <table style="text-align: left;">
            <tr>
                <th>Kode</th>
                <td>: {{ $kode_form }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>: {{ $nama }}</td>
            </tr>
            <tr>
                <th>NIK</th>
                <td>: {{ $nik }}</td>
            </tr>
            <tr>
                <th>Cabang</th>
                <td>: {{ $kc }}</td>
            </tr>
            <tr>
                <th>Keperluan</th>
                <td>: {{ $keperluan }}</td>
            </tr>
        </table> <br>
        <b>Telah Selesai</b> dengan Status <b>{{ $status_akhir }}</b>, <br>
        Cek aplikasi form berbasis web sekarang untuk meninjau form pengajuan tersebut.
        <a href="https://ksb-siputa.bprkusumasumbing.com">Akses Aplikasi Disini!</a>
        <br><br>
        <b>Regard,</b> <br>
        <b>PT BPR Kusuma Sumbing</b>
        </p>
        </p>
    </div>
</div>
