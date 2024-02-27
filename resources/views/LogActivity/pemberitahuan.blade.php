@extends('partial.main')
@section('konten')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="m-0" style="letter-spacing: 2px;">
                                    <b>Halaman {{ $title }}</b>
                                </h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                    <li class="breadcrumb-item active">Halaman {{ $title }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Konten start --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="d-flex justify-content-between" onclick="hideForm1()">
                                    <div>
                                        <b>{{ auth()->user()->unreadNotifications->count() }} Pemberitahuan Belum Dibaca</b>
                                    </div>
                                    <div>
                                        <a href="/mark-as-read-pemberitahuan">Tandai Semua Sudah Dibaca</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach (auth()->user()->notifications()->paginate(10) as $notifikasi)
                                    <a href="{{ url($notifikasi->data['url'] . '?id=' . $notifikasi->id . '&kode=' . $notifikasi->data['kode_form']) }}"
                                        class="dropdown-item">
                                        @if ($notifikasi->read_at != null)
                                            <i class="fa-solid fa-envelope-open mr-2"></i>
                                            {{ $notifikasi->data['title'] }} <br>
                                            <p style="color: rgb(81, 82, 83)">
                                                Kode: {{ $notifikasi->data['kode_form'] }} <br>
                                                Pesan: {{ $notifikasi->data['message'] }}
                                            </p>
                                        @else
                                            <i class="fas fa-envelope mr-2"></i>
                                            {{ $notifikasi->data['title'] }} <br>
                                            <p style="color: rgb(0, 82, 177)">
                                                Kode: {{ $notifikasi->data['kode_form'] }} <br>
                                                Pesan: {{ $notifikasi->data['message'] }}
                                            </p>
                                        @endif
                                        <span class="float-right text-muted text-sm">
                                            {{ $notifikasi->created_at->diffForHumans() }}
                                        </span>
                                    </a>
                                    <hr>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                {{ auth()->user()->notifications()->paginate(10)->links() }}
                            </div>
                            <div class="card card-outline card-danger mb-0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Konten End --}}


    </div>

@section('script')
    <script>
        $(document).ready(function() {
            $("#table_index").DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,

                processing: true,
                serverSide: true,
                ajax: {
                    // type: "post",
                    url: "log-activity",
                },
                columns: [{
                        data: null,
                        sortable: false,
                        orderColumn: false,
                        ordering: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: "nama",
                        name: "nama"
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "level",
                        name: "level"
                    },
                    {
                        data: "aksi",
                        name: "aksi"
                    },
                    {
                        data: "kode_form",
                        name: "kode_form"
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return moment(data.created_at)
                                .locale("id")
                                .format("DD MMM YYYY, hh:mm:ss");
                        },
                    },
                ],

                lengthMenu: [
                    [5, 10, 20, 50, -1],
                    [5, 10, 20, 50, "Semua"],
                ],
            });
        });
    </script>
@endsection
@endsection
