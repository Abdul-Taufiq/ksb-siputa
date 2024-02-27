@extends('partial.main')
@section('konten')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="m-0" style="letter-spacing: 2px;">
                                    <b>{{ $title }}</b>
                                </h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                    <li class="breadcrumb-item active">{{ $title }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="col-md-12">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Daftar Kontak Karyawan</b></h3>

                                    <div class="card-tools">
                                        <span class="badge badge-info">{{ $jumlah_user }} Kontak</span>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="ml-4 mt-2">
                                        <form id="quickForm" action="{{ url('contact-search') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-2">
                                                        <input type="text" name="cari" id="cari"
                                                            class="form-control" placeholder="Cari Kontak..."
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <button id="btn-cari" class="btn btn-success">Cari</button>
                                                    <a href="/contact" class="btn btn-info">Refresh</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <br>

                                    <ul class="users-list clearfix">

                                        @foreach ($data as $item)
                                            <li>
                                                <img style="width: 100px; height: 100px;"
                                                    src="{{ asset('file_upload/foto profil/' . ($item->gambar ? $item->gambar : 'user profil.png')) }}"
                                                    alt="User Image">
                                                <a class="users-list-name" href="#">{{ $item->nama }}</a>
                                                <span class="users-list-name">{{ $item->jabatan }}</span>

                                                <a data-toggle="modal" data-target="#ModalChat<?php echo $item['id']; ?>"
                                                    id="<?php echo $item['id']; ?>" class="btn btn-tool detail_data">
                                                    <span class="icon">
                                                        <i class="fas fa-comments"></i>
                                                    </span>
                                                </a>

                                                <a data-toggle="modal" data-target="#myModal<?php echo $item['id']; ?>"
                                                    type="button" class="btn btn-tool">
                                                    <span class="icon">
                                                        <i class="fa fa-circle-info"></i>
                                                    </span>
                                                </a>

                                            </li>
                                        @endforeach

                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                            </div>
                            <!--/.card -->
                        </div>

                    </div>
                </div>
            </div>





    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>

    {{-- TABEL ON MODAL --}}
    @foreach ($data as $item)
        <div class="modal fade" id="myModal<?php echo $item['id']; ?>" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Info Kontak</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table style="width: 100%; ">
                            <tr style="text-align: center">
                                <td colspan="2">
                                    <img style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; cursor: pointer;"
                                        src="{{ asset('file_upload/foto profil/' . ($item->gambar ? $item->gambar : 'user profil.png')) }}"
                                        alt="User Image" data-toggle="modal" data-target="#previewModal">
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Nama</th>
                                <td>{{ $item->nama }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Email</th>
                                <td>{{ $item->email }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Jabatan</th>
                                <td>{{ $item->jabatan }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Cabang</th>
                                <td> {{ $item->cabang->cabang ?? 'None' }} </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    {{-- modal chat --}}
    <div class="modal" id="ModalChat" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeader" style="letter-spacing: 2px; font-weight: bold;">
                        Redirect Chat
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <iframe id="frameDetail" type="" width="100%" height="400px"></iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal untuk preview gambar -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="previewImage" src="" style="width: 100%;" alt="Preview Image">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- JavaScript untuk menampilkan gambar yang diklik di modal -->
    <script>
        $(document).ready(function() {
            $('img[data-toggle="modal"]').click(function() {
                var imageUrl = $(this).attr('src');
                $('#previewImage').attr('src', imageUrl);
            });
        });
    </script>


    {{-- chat --}}
    <script>
        $(document).ready(function() {
            $("body").on("click", ".detail_data", function() {
                var Id = $(this).attr("id");
                var kode_form = $(this).data("kode_form");

                var modalId = "ModalChat" + Id;
                $("#ModalChat").attr("id", modalId); //merubah id dari modal
                $("#frameDetail").attr("src", "/contact/" + Id); //merubah link frame

                // Tambahkan event listener untuk menangkap penutupan modal
                $("#" + modalId).on("hidden.bs.modal", function() {
                    // Kembalikan ID modal ke nilai default
                    $(this).attr("id", "ModalChat");
                });
            });
        });
        // end detail
    </script>



    <script>
        $(document).ready(function() {
            $("#tbuser").DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,

                lengthMenu: [
                    [5, 10, 20, 50, -1],
                    [5, 10, 20, 50, "Semua"],
                ],
            });

        });
    </script>
@endsection
