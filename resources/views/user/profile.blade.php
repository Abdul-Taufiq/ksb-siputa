@extends('partial.main')
@section('konten')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">My Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        {{-- PEMBERITAHUAN DATA BERHASIL/TIDAK DITAMBAH --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row g-4">
                            <center>
                                <div class="rounded-circle me-lg-2"
                                    style="width: 250px; height: 250px; background-color: #ccc; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                                    <img style="max-width: 100%; max-height: 100%; object-fit: cover;" id="image"
                                        src="{{ asset('file_upload/foto profil/' . (Auth::user() && Auth::user()->gambar ? Auth::user()->gambar : 'icon_logo.png')) }}"
                                        alt=""> <br><br>
                                </div>

                                <form id="quickForm" action="  {{ url('profile/upload') }} " method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="gambar" id="gambar"
                                        class="@error('gambar') is-invalid @enderror" accept="image/png, image, image/jpeg"
                                        onchange="upload(this);">

                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <br><br>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                                <br><br>

                                <table style="width: 50%">
                                    <tr>
                                        <th>Nama </th>
                                        <td> : {{ Auth::user()->nama }} </td>
                                    </tr>
                                    <tr>
                                        <th>Kantor Cabang </th>
                                        <td> : {{ Auth::user()->cabang->cabang ?? 'KPM' }} </td>
                                    </tr>
                                    <tr>
                                        <th>Email </th>
                                        <td> : {{ Auth::user()->email }} </td>
                                    </tr>
                                    <tr>
                                        <th>Password </th>
                                        <td> : <a href="{{ route('forget.password.get') }}">Ganti
                                                Password</a> </td>
                                    </tr>
                                    <tr>
                                        <th>Hak Akses </th>
                                        <td> : {{ Auth::user()->jabatan }} </td>
                                    </tr>
                                </table>

                                <br><br><br>
                            </center>

                            &nbsp;
                            <strong>Note : </strong>
                            <p>Demi keamanan akun, password tidak ditampilkan. jika ingin merubah password silahkan klik
                                <i>Ganti
                                    Password</i>. Data profil tidak dapat diubah kecuali foto profil dan password, jika
                                ingin melakukan
                                perubahan data
                                profil silahkan
                                hubungi
                                pihak terkait.
                            </p>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script>
        // preview images
        function upload(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
