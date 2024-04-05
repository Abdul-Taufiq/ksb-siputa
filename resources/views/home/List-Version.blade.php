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
                                @if (auth()->user()->jabatan == 'TSI')
                                    <a class="btn btn-primary btn-icon-split btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#addModal">
                                        <span class="icon text-white-50">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </span>
                                        <span class="text">Tambah {{ $title }}</span>
                                    </a>
                                    <br>
                                    <br>
                                @endif

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
                                    width="100%">
                                    <thead style="background-color: lightseagreen">
                                        <tr>
                                            <th style="10px">#</th> {{-- 0 --}}
                                            <th>Kode Versi</th>
                                            <th>Apa Yang Baru?</th>
                                            <th>Juknisnya</th>
                                            <th>Tanggal Rilis</th>
                                            <th style="width: 5%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($versi as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kode_versi }}</td>
                                                <td>{!! $item->pembaruan !!}</td>
                                                <td>
                                                    <a href="{{ asset('Juknis/' . $item->juknis) }}" target="_blank">
                                                        {{ $item->juknis ? $item->juknis : 'null' }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $item->tgl_rilis ? $item->tgl_rilis->translatedFormat('d F Y') : ' ' }}
                                                </td>

                                                <td>
                                                    @if (auth()->user()->jabatan == 'TSI')
                                                        <form action="{{ url('lastes-version/' . $item->id_version) }}"
                                                            method="post" onsubmit="return confirm('Yakin Hapus Data?')"
                                                            class="d-inline">
                                                            {{-- DEKLARASI METHODE ROUTING --}}
                                                            @method('delete')
                                                            {{-- CSRF TOKEN --}}
                                                            @csrf
                                                            <button class="btn btn-danger btn-icon-split btn-sm mb-2">
                                                                <span class="icon text-white-50">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </span>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-danger btn-icon-split btn-sm mb-2 disabled">
                                                            <span class="icon text-white-50">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </span>
                                                        </button>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
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
        @include('home.List-Version-modal')
        {{-- end modal --}}

        {{-- mengamibil user untuk menentukan tombol export --}}
        <input hidden type="text" id="user" value="{{ Auth::user()->level }}">

    </div>

@section('script')
    <script>
        $(document).ready(function() {
            $('#table_index').DataTable();
        });
    </script>
@endsection
@endsection
