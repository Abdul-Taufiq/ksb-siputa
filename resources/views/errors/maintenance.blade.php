<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Error Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <link rel="shortcut icon" href="img/icon_logo.png" />
    <link rel="icon" href="img/icon_logo.png" />

    <style>
        body {
            font-family: "JetBrains Mono";
        }

        .center {
            display: block;
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            width: 30%;
        }

        .text-center {
            text-align: center;
            font-weight: bold;
        }

        .centered {
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -10%);
        }
    </style>
</head>

<body>
    <div class="container centered">
        <img class="headline center" src="{{ asset('img/logo ksb.png') }}" alt="" />
        <img class="headline center" src="{{ asset('img/maintenance.gif') }}" alt="" />
        <div class="card-body">
            <h2 class="headline text-danger text-center">ERROR PAGE !</h2>

            <div class="error-content">
                <h3 class="text-center">Aplikasi Sedang Dalam Perbaikan!</h3>
                <p style="text-align: center">
                    Aplikasi dapat digunakan kembali ketika maintenance sudah
                    <b>Selesai!</b>
                </p>
                <br />
                <p style="text-align: center"><b>Powered</b> by @ TSI | KSB</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
