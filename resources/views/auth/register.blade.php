@include('partial.header')
@yield('header')


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- 404 Error Text -->
                    <div class="text-center errorcenter">
                        <div class="error mx-auto" data-text="404">404</div>
                        <p class="lead text-gray-800 mb-5">Halaman Tidak Ditemukan</p>
                        <p class="text-gray-500 mb-0">Pastikan untuk menghubungi pihak terkait jika Anda ingin melakukan pendaftaran!</p>
                        <a href="/">&larr; Kembali ke halaman Login</a>
                    </div>

                </div>
                <!-- /.container-fluid -->
    </div>
    <!-- End of Page Wrapper -->




@yield('footer')
@include('partial.footer')