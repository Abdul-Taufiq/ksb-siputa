@extends('partial.main')
@section('konten')
    <style>
        label {
            font-size: 14px;
        }

        .show {
            display: block;
        }

        .hidden {
            display: none;
        }

        .head-judul {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        label:has(+ input[required])::after {
            content: "  *";
            color: red;
            font-style: italic;
        }

        label:has(+ select[required])::after {
            content: "  *";
            color: red;
            font-style: italic;
        }

        label:has(+ textarea[required])::after {
            content: " *";
            color: red;
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
                                    <i class="fa fa-plus-circle" style="color:green"></i>
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
                        <form id="quickForm" action="  {{ url('user-email-pengajuan') }} " method="post"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- f --}}
                            <div class="card card-outline card-primary">
                                <div class="card-body">
                                    <div class="row ml-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="keperluan">Keperluan :</label>
                                                <select name="keperluan" id="keperluan" autocomplete="off" required
                                                    class="form-control">
                                                    <option disabled selected hidden>- Pilih Keperluan -</option>
                                                    <option value="Pengajuan Email Baru"
                                                        {{ old('keperluan') == 'Pengajuan Email Baru' ? 'selected' : null }}>
                                                        Pengajuan Email Baru
                                                    </option>
                                                    <option value="Penghapusan Email"
                                                        {{ old('keperluan') == 'Penghapusan Email' ? 'selected' : null }}>
                                                        Penghapusan Email
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nik">NIK (Nomor Induk Karyawan) :</label>
                                                <input type="text" name="nik" id="nik" required
                                                    onkeypress="return hanyaAngka(event)" class="form-control"
                                                    placeholder="NIK (Nomor Induk Karyawan)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Karyawan :</label>
                                                <input type="nama" name="nama" id="nama" class="form-control"
                                                    placeholder="Nama Karyawan" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_telp">No Telp/WhatsApp :</label>
                                                <input type="no_telp" name="no_telp" id="no_telp" class="form-control"
                                                    onkeypress="return hanyaAngka(event)" placeholder="No Telp/WhatsApp"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan :</label>
                                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="3" required
                                                    placeholder="Keterangan"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="terms" class="custom-control-input"
                                                id="exampleCheck1" required>
                                            <label class="custom-control-label" for="exampleCheck1">Saya setuju dengan<a
                                                    href="#">
                                                    ketentuan yang berlaku</a>.</label>
                                        </div>
                                    </div>
                                    <br>
                                    <button id="simpan" type="button" class="btn btn-primary"
                                        style="letter-spacing: 2px;">
                                        <i class="fa-regular fa-floppy-disk"></i> &nbsp; <b>SIMPAN</b></button>
                                </div>
                                <div class="card card-outline card-primary mb-0"></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
        {{-- Konten End --}}
    </div>

@section('script')
    <script src="{{ asset('script/perjanjian kredit/pkpmk_input.js') }}"></script>

    {{-- SWA submit --}}
    <script>
        $(document).ready(function() {
            $('#simpan').on('click', function(e) {
                e.preventDefault(); // Tambahkan ini untuk mencegah submit default dari tombol

                var $form = $('#quickForm');
                var inputRequired = $form.find('[required]');

                var inputKosong = inputRequired.filter(function() {
                    var val = $(this).val();
                    return val === null || val.trim() === '';
                });

                console.log(inputKosong);

                if (inputKosong.length > 0) {
                    Swal.fire({
                        title: 'Gagal Simpan Data!',
                        text: 'ADA DATA MANDATORI YANG BELUM DIISI, PASTIKAN UNTUK MENGISI SEMUA DATA MANDATORI!',
                        icon: 'error',
                    });
                } else {
                    Swal.fire({
                        title: 'Konfirmasi Simpan Data!',
                        text: 'SEBELUM MENYIMPAN DATA HARAP PERHATIKAN BAHWA DATA SUDAH BENAR! DAN JANGAN LEWATKAN PERINGATAN SEKECIL APAPUN!',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $form.submit();
                        }
                    });
                }
            });
        });
    </script>
@endsection
@endsection
