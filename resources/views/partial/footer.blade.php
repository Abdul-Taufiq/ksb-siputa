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
                            '_token': '{{ csrf_token() }}',
                            'device_id': getDeviceId()
                        },
                        success: function() {
                            window.location.href = "/";
                        }
                    });
                }
            });
        });
    });

    function getDeviceId() {
        let deviceId = localStorage.getItem("device_id");
        if (!deviceId) {
            deviceId = crypto.randomUUID();
            localStorage.setItem("device_id", deviceId);
        }

        return deviceId;
    }
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

{{-- loading screen --}}
<script>
    // {{-- loading screen --}}

    document.addEventListener("DOMContentLoaded", function() {
        let loadingScreen = document.getElementById("loading-screen");

        // btn refresh
        document.getElementById("btnRefresh").addEventListener("click", function(e) {
            e.preventDefault();
            loadingScreen.style.display = "flex";
            setTimeout(() => {
                location.reload();
            }, 100);
        });

        // ✅ Munculkan loading saat halaman berpindah atau direfresh
        window.addEventListener("beforeunload", function() {
            loadingScreen.style.display = "block";
        });

        document.addEventListener("click", function(e) {
            const link = e.target.closest("a");
            if (!link) return;
            const href = link.getAttribute("href");
            if (!href || href === "#" || href.startsWith("javascript:")) return;
            // Bootstrap
            if (link.dataset.bsToggle) return;
            // AdminLTE
            if (link.dataset.widget) return;
            // Modal
            if (link.dataset.bsToggle === "modal") return;
            if (link.target === "_blank") return;
            if (link.hasAttribute("download")) return;
            loadingScreen.style.display = "flex";
        });

        // ✅ Cegah loading muncul jika klik tombol modal atau event lain di halaman
        document.addEventListener("click", function(event) {
            let target = event.target.closest(
                "[data-toggle='modal'], [data-bs-toggle='modal']"
            );
            if (target) {
                event.stopPropagation();
            }
        });

        // ✅ Munculkan loading saat submit form (POST request)
        document.addEventListener("submit", function() {
            loadingScreen.style.display = "block";
        });

        // ✅ Livewire Hook untuk proses request
        document.addEventListener("livewire:load", function() {
            Livewire.hook("message.sent", () => {
                loadingScreen.style.display = "block";
            });
            Livewire.hook("message.received", () => {
                loadingScreen.style.display = "none";
            });
        });

        // ✅ Hilangkan loading jika halaman selesai dimuat
        window.onload = function() {
            loadingScreen.style.display = "none";
        };

        // ✅ Cegah loading screen pada navigasi back/forward cache
        window.addEventListener("pageshow", function(event) {
            if (event.persisted) {
                // Halaman dimuat dari cache
                loadingScreen.style.display = "none";
            }
        });
    });
</script>

<script>
    console.log("Copyright by Abdul Taufiq");
</script>

<script src="{{ asset('pwa.js') }}"></script>

@yield('script')

</body>

</html>
