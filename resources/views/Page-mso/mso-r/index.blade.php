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
                                @can('UserCreate', App\Models\User\EmailPe::class)
                                    <a class="btn btn-primary btn-icon-split btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#addModal">
                                        <span class="icon text-white-50">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </span>
                                        <span class="text">Tambah {{ $title }}</span>
                                    </a>
                                    <br>
                                    <br>
                                @endcan

                                <div class="d-flex align-items-center justify-content-center flex-wrap">
                                    @can('TarikData', App\Models\User\EmailPe::class)
                                        <strong class="mb-2 mr-4 justify-content-end">
                                            <span class="text">Tarik Data</span>
                                        </strong>
                                        <div class="d-flex align-items-center mr-2">
                                            <div class="form-group mb-2">
                                                <label for="cari" class="sr-only">Cari:</label>
                                                <input type="text" name="cari" id="cari" class="form-control"
                                                    placeholder="Cari data untuk ditarik..." autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="btn-group mb-2">
                                            <button id="btn-cari" class="btn btn-success">Cari</button>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;
                                    @endcan
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
                                    width="100%">
                                    <thead style="background-color: lightseagreen">
                                        <tr>
                                            <th style="10px">#</th> {{-- 0 --}}
                                            <th>Kode</th>
                                            <th>K.Cabang</th>
                                            <th>Keperluan</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Keterangan</th>

                                            <th>Tanggal Create</th>
                                            <th>Last Update</th>
                                            <th>Status?</th>
                                            <th style="width: 10%">Aksi</th>
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

        {{-- Modal --}}
        @include('Page-mso.mso-r.modal')
        {{-- end modal --}}

        {{-- mengamibil user untuk menentukan tombol export --}}
        <input hidden type="text" id="user" value="{{ Auth::user()->level }}">

    </div>

@section('script')
    <script src="{{ asset('script/mso/index_r.js') }}"></script>
@endsection
@endsection
