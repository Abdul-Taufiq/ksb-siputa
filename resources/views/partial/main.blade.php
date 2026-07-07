@include('partial.header')
@yield('header')
@include('partial.sidebar')


<body class="hold-transition sidebar-mini layout-fixed">
    <div id="loading-screen"
        style="display: none; justify-content: center; align-items: center; position: fixed; width: 100%; height: 100%; background: #000000bd;z-index: 9999; top: 0; left: 0;">
        <div
            style="display: flex; margin: auto; width: 100%; height: 100%; justify-content: center; align-items: center;">
            <img style="width: 150px;" src="{{ asset('img/loading_ksb.gif') }}" alt="Loading...">
        </div>
    </div>

    <div class="wrapper">

        {{-- Preloader  --}}
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/icon_logo.png') }}" alt="ksb" height="60"
                width="60">
        </div> --}}

        <!-- ISI KONTEN -->
        @yield('konten')



        <footer class="main-footer">
            <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">TSI-BPR Kusuma Sumbing</a></strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>


    </div>




    @yield('footer')
    @include('partial.footer')
