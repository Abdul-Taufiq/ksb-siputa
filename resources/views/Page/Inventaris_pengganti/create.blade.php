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

        .wajib::after {
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
                        <form id="quickForm" action="  {{ url('inventaris-pengajuan') }} " method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="card card-outline card-primary">
                                <div class="card-body">
                                    <div class="row ml-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kategori_barang">Kategori Pengajuan Inventaris :</label>
                                                <select name="kategori_barang" id="kategori_barang" autocomplete="off"
                                                    required class="form-control input">
                                                    <option disabled selected hidden>- Pilih Kategori Pengajuan Inventaris -
                                                    </option>
                                                    <option value="Elektronik"
                                                        {{ old('kategori_barang') == 'Elektronik' ? 'selected' : null }}>
                                                        Elektronik</option>
                                                    <option value="Kendaraan"
                                                        {{ old('kategori_barang') == 'Kendaraan' ? 'selected' : null }}>
                                                        Kendaraan</option>
                                                    <option value="Peralatan/Perlengkapan Kantor"
                                                        {{ old('kategori_barang') == 'Peralatan/Perlengkapan Kantor' ? 'selected' : null }}>
                                                        Peralatan/Perlengkapan Kantor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- if barang elektronik --}}
                                    <div class="row ml-2 " id="elektronik">
                                        <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 252)">Barang
                                            Inventaris Elektronik 1
                                            &#8628;</h5>
                                        <hr style="width: 95%; margin-left: 5px">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jns_inventaris_1">Jenis Inventaris :</label>
                                                <select name="jns_inventaris_1" id="jns_inventaris_1" autocomplete="off"
                                                    required class="form-control input">
                                                    <option disabled selected hidden>- Pilih Jenis Inventaris -
                                                    </option>
                                                    <option value="Inventaris Baru"
                                                        {{ old('jns_inventaris_1') == 'Inventaris Baru' ? 'selected' : null }}>
                                                        Inventaris Baru</option>
                                                    <option value="Inventaris Pengganti"
                                                        {{ old('jns_inventaris_1') == 'Inventaris Pengganti' ? 'selected' : null }}>
                                                        Inventaris Pengganti</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- option pengganti --}}
                                        <div class="row d-none" id="inventaris_pengganti_elektronik">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="wajib" for="kode_inventaris_1">Kode Inventaris :</label>
                                                    <input type="text" name="kode_inventaris_1" id="kode_inventaris_1"
                                                        class="form-control input" placeholder="Kode Inventaris">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="wajib" for="nilai_buku_1">Nilai Buku Terakhir :</label>
                                                    <input type="text" name="nilai_buku_1" id="nilai_buku_1"
                                                        class="form-control input" placeholder="Nilai Buku Terakhir">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="wajib" for="tgl_pembelian_1">Tanggal Pembelian :</label>
                                                    <input type="date" name="tgl_pembelian_1" id="tgl_pembelian_1"
                                                        class="form-control input" placeholder="Tanggal Pembelian">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="wajib" for="kondisi_akhir_1">Kondisi Akhir :</label>
                                                    <input type="text" name="kondisi_akhir_1" id="kondisi_akhir_1"
                                                        class="form-control input" placeholder="Kondisi Akhir">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="wajib" for="nama_barang_1">Nama Barang :</label>
                                                <input type="text" name="nama_barang_1" id="nama_barang_1"
                                                    class="form-control input" placeholder="Nama Barang">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="qty">QTY (Jumlah Barang) :</label>
                                                <input type="number" name="qty" id="qty" required
                                                    class="form-control input" placeholder="QTY">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="catatan" class="wajib">Catatan :</label>
                                                <textarea class="form-control input" name="catatan" id="catatan" cols="30" rows="3" required
                                                    placeholder="Catatan"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="keterangan" class="wajib">Keterangan :</label>
                                                <textarea class="form-control input" name="keterangan" id="keterangan" cols="30" rows="3" required
                                                    placeholder="Keterangan"></textarea>
                                            </div>
                                        </div>

                                        {{-- tambahan --}}
                                        <div id="tambah_barang_elektronik"></div>
                                        <input class="btn btn-outline-primary mb-4" id="tambah_barang" type="button"
                                            value="(+) Tambah Barang Elektronik (+)">
                                    </div>

                                    {{-- if barang selain elektronik --}}
                                    <div class="row ml-2 " id="non_elektronik">
                                        <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 252)">Barang
                                            Inventaris Non-Elektronik 1
                                            &#8628;</h5>
                                        <hr style="width: 95%; margin-left: 5px">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jns_inventaris_1">Jenis Inventaris :</label>
                                                <select name="jns_inventaris_1" id="jns_inventaris_1" autocomplete="off"
                                                    required class="form-control input">
                                                    <option disabled selected hidden>- Pilih Jenis Inventaris -
                                                    </option>
                                                    <option value="Inventaris Baru"
                                                        {{ old('jns_inventaris_1') == 'Inventaris Baru' ? 'selected' : null }}>
                                                        Inventaris Baru</option>
                                                    <option value="Inventaris Pengganti"
                                                        {{ old('jns_inventaris_1') == 'Inventaris Pengganti' ? 'selected' : null }}>
                                                        Inventaris Pengganti</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- option pengganti --}}
                                        <div class="row d-none" id="inventaris_pengganti_non_elektronik">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="wajib" for="kode_inventaris_1">Kode Inventaris
                                                        :</label>
                                                    <input type="text" name="kode_inventaris_1" id="kode_inventaris_1"
                                                        class="form-control input" placeholder="Kode Inventaris">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="wajib" for="nilai_buku_1">Nilai Buku Terakhir :</label>
                                                    <input type="text" name="nilai_buku_1" id="nilai_buku_1"
                                                        class="form-control input" placeholder="Nilai Buku Terakhir">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="wajib" for="tgl_pembelian_1">Tanggal Pembelian
                                                        :</label>
                                                    <input type="date" name="tgl_pembelian_1" id="tgl_pembelian_1"
                                                        class="form-control input" placeholder="Tanggal Pembelian">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="wajib" for="kondisi_akhir_1">Kondisi Akhir :</label>
                                                    <input type="text" name="kondisi_akhir_1" id="kondisi_akhir_1"
                                                        class="form-control input" placeholder="Kondisi Akhir">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="wajib" for="nama_barang_1">Nama Barang :</label>
                                                <input type="text" name="nama_barang_1" id="nama_barang_1"
                                                    class="form-control input" placeholder="Nama Barang">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="wajib" for="merk_1">Merk :</label>
                                                <input type="text" name="merk_1" id="merk_1"
                                                    class="form-control input" placeholder="Merk">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="wajib" for="type_1">Type :</label>
                                                <input type="text" name="type_1" id="type_1"
                                                    class="form-control input" placeholder="Type">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="wajib" for="nama_toko_1">Nama Toko :</label>
                                                <input type="text" name="nama_toko_1" id="nama_toko_1"
                                                    class="form-control input" placeholder="Nama Toko">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="wajib" for="harga_pembelian_1">Harga :</label>
                                                <input type="text" name="harga_pembelian_1" id="harga_pembelian_1"
                                                    class="form-control input" placeholder="Harga">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="wajib" for="file_detail_toko_1">File Detail Toko
                                                    (PNG/JPG/JPEF/RAR/ZIP) :</label>
                                                <input type="file" name="file_detail_toko_1" id="file_detail_toko_1"
                                                    class="form-control input"
                                                    accept="image/jpeg,image/jpg,image/png, .zip, .rar, .7zip">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="qty_1">QTY (Jumlah Barang) :</label>
                                                <input type="number" name="qty_1" id="qty_1" required
                                                    class="form-control input" placeholder="QTY">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="catatan_1" class="wajib">Catatan :</label>
                                                <textarea class="form-control input" name="catatan_1" id="catatan_1" cols="30" rows="3" required
                                                    placeholder="Catatan"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="keterangan" class="wajib">Keterangan :</label>
                                                <textarea class="form-control input" name="keterangan" id="keterangan" cols="30" rows="3" required
                                                    placeholder="Keterangan"></textarea>
                                            </div>
                                        </div>

                                        {{-- tambahan --}}
                                        <div id="tambah_barang_card"></div>
                                        <input class="btn btn-outline-primary mb-4" id="tambah_barang" type="button"
                                            value="(+) Tambah Barang Non-Elektronik(+)">
                                    </div>

                                </div>
                                <div class="card card-outline card-primary mb-0"></div>
                            </div>



                            {{-- tombol save --}}
                            <div class="card card-outline card-danger">
                                <div class="card-body">
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
                                <div class="card card-outline card-danger mb-0"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        {{-- Konten End --}}
    </div>


@section('script')
    {{-- <script src="{{ asset('script/pembatalan/akuntansi_index.js') }}"></script> --}}
@endsection
@endsection
