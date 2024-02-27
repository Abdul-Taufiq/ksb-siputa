<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>

<!-- jQuery -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('template/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('template/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('template/plugins/moment/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('template/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.js') }}"></script>
<!-- Select 2 App -->
<script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
{{-- push js --}}
<script src="{{ asset('assetspush/js/push.min.js') }}"></script>


<!-- DataTables  & Plugins -->
<script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>
<script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Bootstrap Switch -->
<script src="{{ asset('template/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('template/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>

<script src="{{ asset('template/script.js') }}"></script>

{{-- Toastr
<script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>
<script>
    @if (Session::has('status'))
        toastr.success("{{ Session::get('status') }}")
    @endif
</script>

<script>
    @if (Session::has('statusGagal'))
        toastr.error("{{ Session::get('status') }}")
    @endif
</script> --}}


{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- SWA Logout --}}
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#logout', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");

            Swal.fire({
                title: 'Apa Anda Yakin?',
                text: "Apakah Anda Ingin Keluar Dari Aplikasi?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya!',
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('logout') }}',
                        type: "POST",
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function() {
                            window.location.href = "/login";
                        }
                    });
                }
            });
        });
    });
</script>

{{-- Sweet Alert Pesan Berhasil --}}
@if (session('AlertSuccess'))
    <script>
        Swal.fire({
            title: 'Sukses!',
            text: '{{ session('AlertSuccess') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif

{{-- Sweet Alert Pesan Gagal --}}
@if (session('AlertFail'))
    <script>
        Swal.fire({
            title: 'Failed!',
            text: '{{ session('AlertFail') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif


{{-- Sweet Alert Pesan Berhasil --}}
@if (session('status'))
    <script>
        Swal.fire({
            title: 'Sukses!',
            text: '{{ session('status') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif


{{-- Push Notifikasi --}}
{{-- <script>
    let iconPath = '{{ asset('img/icon_logo.png') }}'; //lokasi ikon

    // Periksa apakah browser mendukung pemberitahuan
    if ('Notification' in window && navigator.serviceWorker) {
        // Periksa apakah izin pemberitahuan sudah diberikan
        if (Notification.permission === 'granted') {
            // Jika sudah diberikan, buat pemberitahuan
            createNotification();
        } else if (Notification.permission !== 'denied') {
            // Jika belum diberikan atau ditolak, minta izin
            Notification.requestPermission().then(function(permission) {
                if (permission === 'granted') {
                    // Jika izin diberikan, buat pemberitahuan
                    createNotification();
                } else {
                    alert('Nyalakan Pemberitahuan untuk fitur terbaru! :)');
                }
            });
        }
    } else {
        alert('Pemberitahuan tidak didukung di browser Anda!');
    }

    // Fungsi untuk membuat pemberitahuan
    function createNotification() {
        Push.create("Hello Shailesh!", { //header
                body: "Welcome to the Dashboard.", //pesan kesalahan
                icon: iconPath, //ikon
                // timeout: 4000, //digunakan untuk auto close notifikasi
                requireInteraction: true, // berfungsi untuk menjadi notif permanen kecuali diklose & tdk perlu timeout:
                onClick: function() {
                    window.focus();
                    window.location = "http://www.google.com";
                }
            })
            .catch(e => {
                alert('Nyalakan Pemberitahuan untuk fitur terbaru! :)');
            }); //penanganan jika akses pemberitahuan mati
    }
</script> --}}


{{-- Push Notifikasi with session --}}
@if (session('chat'))
    <script>
        let iconPath = '{{ asset('img/icon_logo.png') }}' //lokasi ikon

        Push.create('Pesan Baru!', { //header
            body: '{{ session('chat') }}', //pesan kesalahan
            timeout: 5000,
            icon: iconPath //ikon
        });
    </script>
@endif


<script>
    console.log("Copyright by Abdul Taufiq");
</script>


@yield('script')


</body>

</html>
