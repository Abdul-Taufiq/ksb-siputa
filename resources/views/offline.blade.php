<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KSB | Siputa</title>

    <link rel="icon" href="{{ asset('icon.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: #fff;
            width: 95%;
            max-width: 480px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            text-align: center;
        }

        .logo {
            width: 250px;
            margin-bottom: 15px;
        }

        .gif {
            width: 180px;
            margin: 20px 0;
        }

        h2 {
            color: #dc3545;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            line-height: 1.7;
        }

        .btn {
            margin-top: 25px;
            display: inline-block;
            background: #0052B1;
            color: white;
            padding: 12px 22px;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #003f88;
        }

        small {
            display: block;
            margin-top: 25px;
            color: #999;
        }
    </style>
</head>

<body>

    <div class="card">
        <img class="logo" src="{{ asset('img/logo ksb.png') }}"> <br>
        <img class="gif" src="{{ asset('img/missing-page.gif') }}">
        <h2>Anda Sedang Offline</h2>
        <p>
            Aplikasi membutuhkan koneksi internet
            untuk menjalankan seluruh proses.
            <br><br>
            Silakan periksa koneksi internet
            kemudian tekan tombol di bawah.
        </p>

        <a class="btn" onclick="window.location.reload()">
            Coba Lagi
        </a>

        <small>
            <b>Powered</b> by @ TSI | KSB</p>
        </small>

    </div>

</body>

</html>
