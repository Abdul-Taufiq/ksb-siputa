@extends('partial.main')
@section('konten')

    <style>
        .btn-table {
            width: 30px !important;
            height: 30px !important;
            padding: 3px 0px 0px 0px !important;
        }
    </style>

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
                                    <a class="btn btn-primary btn-icon-split btn-sm" href="{{ route('penyelesaian.create') }}">
                                        <span class="icon text-white-50">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </span>
                                        <span class="text">Tambah {{ $title }}</span>
                                    </a>
                                    <br>
                                    <br>
                                @endcan

                                <div class="d-flex align-items-center justify-content-center flex-wrap">
                                    <strong class="mb-2 mr-4">
                                        <span class="text">Filter</span>
                                    </strong>
                                    <div class="d-flex align-items-end mr-2">
                                        @if (auth()->user()->id_cabang == 0)
                                            <div class="form-group mb-2">
                                                <label for="id_cabang" class="sr-only">Cabang:</label>
                                                <select name="id_cabang" id="id_cabang" class="form-control">
                                                    <option selected value="99">All Cabang</option>
                                                    <option value="1">KPO</option>
                                                    <option value="2">Kc Temanggun</option>
                                                    <option value="3">Kc Wonosobo</option>
                                                    <option value="4">Kc Ambarawa</option>
                                                    <option value="5">Kc Semarang</option>
                                                    <option value="6">Kc Mranggen</option>
                                                    <option value="7">Kc Sukorejo</option>
                                                    <option value="8">Kc Weleri</option>
                                                    <option value="9">Kc Delanggu</option>
                                                    <option value="10">Kc Gombong</option>
                                                    <option value="11">Kc Sokaraja</option>
                                                </select>
                                            </div>
                                        @endif
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
                                <table id="table_index" class="table table-hover table-striped table-bordered table-sm"
                                    width="100%">
                                    <thead style="background-color: lightseagreen">
                                        <tr>
                                            <th style="width: 5%;">#</th> {{-- 0 --}}
                                            <th style="width: 20%;">Kode</th>
                                            <th style="width: 15%">K.Cabang</th>
                                            <th style="width: 30%">Data Debitur</th>
                                            <th style="width: 10%">Komposisi</th>

                                            <th>Created at</th>
                                            <th>Last Update</th>
                                            <th style="width: 10%">Status?</th>
                                            <th style="width: 5%">Aksi</th>
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
        @include('Page-Insentif-Penyelesaian.modal')
        {{-- end modal --}}

        {{-- mengamibil user untuk menentukan tombol export --}}
        <input hidden type="text" id="user" value="{{ Auth::user()->level }}">

    </div>

@section('script')
    <script src="{{ asset('insentif_js/penyelesaian_index.js') }}"></script>
@endsection
@endsection
