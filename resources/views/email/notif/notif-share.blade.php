<div style="background-color: #f2f2f2; padding: 20px;">
    <div style="background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        <h3 style="font-family: Arial, sans-serif;">Hallo,</h3>
        <p style="font-family: Arial, sans-serif;">
            <strong>REMINDER SHARE BIAYA</strong>: <br>
        <table style="text-align: left; width: 100%">
            <tr>
                <th style="width: 15%;">Tgl Transaksi</th>
                <td>: {{ $tgl_transaksi }}</td>
            </tr>
            <tr>
                <th>Kantor Cabang</th>
                <td>: {{ $kc }}</td>
            </tr>
            <tr>
                <th>Nominal</th>
                <td>: {{ $nominal }}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>: {{ $keterangan }}</td>
            </tr>
            <tr>
                <th>File Lampiran</th>
                <td>:
                    @if ($file != null)
                        <a href="{{ asset('file_upload/ShareBiaya/' . $file) }}">{{ $file }}</a>
                    @else
                        <i>Tidak Ada Lampiran</i>
                    @endif
                </td>
            </tr>
        </table> <br>
        Cek aplikasi berbasis web sekarang untuk meninjau form pengajuan tersebut.
        <a href="https://ksb-siputa.bprkusumasumbing.com/">Akses Aplikasi Disini!</a>
        <br><br>


        Terima kasih, <br><br>
        PT BPR Kusuma Sumbing
        </p>
    </div>
</div>
