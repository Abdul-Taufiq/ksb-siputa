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
                                <div class="d-flex align-items-center justify-content-center flex-wrap">
                                    <strong class="mb-2 mr-4">
                                        <span class="text">Filter Pertanggal</span>
                                    </strong>
                                    <div class="d-flex align-items-end mr-2">
                                        <div class="form-group mb-2">
                                            <label for="min" class="sr-only">From:</label>
                                            <input type="date" name="min" id="min" class="form-control">
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="max" class="sr-only">To:</label>
                                            <input type="date" name="max" id="max" class="form-control">
                                        </div>
                                    </div>
                                    <div class="btn-group mb-2">
                                        <button id="btn-filter" class="btn btn-success">Filter</button>
                                        <button id="btn-refresh" class="btn btn-info">Refresh</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="table_index" class="table table-hover table-striped table-bordered"
                                    width="100%" style="font-size: 9pt">
                                    <thead style="background-color: lightseagreen">
                                        <tr>
                                            <th style="10px">#</th> {{-- 0 --}}
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            <th>Jabatan</th>
                                            <th>Aksi User</th>
                                            <th>Kode Form</th>
                                            <th>Tanggal Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
        // Data tables
        $(document).ready(function() {
            loadtable();
        });

        function loadtable(min, max) {
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
                        data: {
                            min: min,
                            max: max,
                        },
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
        }


        $(document).on("click", "#btn-filter", function() {
            let min = $("#min").val();
            let max = $("#max").val();
            $("#table_index").DataTable().destroy();
            loadtable(min, max);
        });

        $(document).on("click", "#btn-refresh", function() {
            $("#table_index").DataTable().destroy();
            loadtable();
        });
    </script>
@endsection
@endsection
