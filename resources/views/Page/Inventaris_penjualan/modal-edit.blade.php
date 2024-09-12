@include('partial.header')
@yield('header')


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

{{-- headline --}}
<style>
    .header-container {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .header-line {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: #8d8d8d;
    }

    .header-text {
        position: relative;
        background: #fff;
        font-weight: bold;
        /* Warna latar belakang untuk menutupi garis */
        padding: 0 10px;
        /* Sesuaikan padding sesuai kebutuhan */
    }
</style>



<form id="editForm" action=" {{ url('inventaris-penjualan/' . $penjualan->id_inventaris_penjualan) }}" method="post"
    enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="row ml-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kategori_barang">Kategori Pengajuan Inventaris :</label>
                        <select name="kategori_barang" id="kategori_barang" autocomplete="off" required
                            class="form-control input">
                            <option disabled selected hidden>- Pilih Kategori Pengajuan Inventaris -
                            </option>
                            <option value="Elektronik"
                                {{ $penjualan->kategori_barang == 'Elektronik' ? 'selected' : null }}>
                                Elektronik</option>
                            <option value="Kendaraan"
                                {{ $penjualan->kategori_barang == 'Kendaraan' ? 'selected' : null }}>
                                Kendaraan</option>
                            <option value="Peralatan/Perlengkapan Kantor"
                                {{ $penjualan->kategori_barang == 'Peralatan/Perlengkapan Kantor' ? 'selected' : null }}>
                                Peralatan/Perlengkapan Kantor</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_inventaris">Nomor Inventaris :</label>
                        <input type="text" name="no_inventaris" id="no_inventaris" required
                            class="form-control input" placeholder="Nomor Inventaris"
                            value="{{ $penjualan->no_inventaris }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="detail_barang" class="wajib">Detail Barang (Type/Merk/dll)
                            :</label>
                        <textarea class="summernote" name="detail_barang" id="detail_barang" cols="30" rows="10">
                            {!! $penjualan->detail_barang !!}
                        </textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kondisi_terakhir" class="wajib">Kondisi Terakhir Barang :</label>
                        <textarea class="summernote" name="kondisi_terakhir" id="kondisi_terakhir" cols="30" rows="10">
                            {!! $penjualan->kondisi_terakhir !!}
                        </textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="file" class="wajib">Foto Barang (PDF/JPG/JPEG/PNG) :</label>
                        <input type="file" name="file" id="file" class="form-control input"
                            accept="image/jpeg,image/jpg,image/png, application/pdf">
                        File Tersimpan :
                        <a href="{{ asset('file_upload/Inventaris Jual/' . $penjualan->file) }}" target="_blank">
                            {{ $penjualan->file ? $penjualan->file : 'null' }}
                        </a> <br>
                        <span style="font-size: 14px"><i><b>Note: </b> Biarkan saja kolom input <b>Foto Barang</b>
                                jika tidak ingin mengganti gambar!</i></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan" class="wajib">Keterangan :</label>
                        <textarea class="summernote" name="keterangan" id="keterangan" cols="30" rows="3" required
                            placeholder="Keterangan">{!! $penjualan->keterangan !!}</textarea>
                    </div>
                </div>
            </div>

            {{-- Penawar --}}
            <br>
            <div class="row ml-2">
                @foreach ($penjualan->penawar as $item)
                    <input type="hidden" value="{{ $item->id_penawar }}" name="id_penawar_{{ $loop->iteration }}">
                    <div class="col-md-12">
                        <div class="header-container">
                            <div class="header-line"></div>
                            <div class="header-text">DATA PENAWAR {{ $loop->iteration }}</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="aksi_{{ $loop->iteration }}">Aksi Data Ini!</label>
                            <select class="form-control input border-danger" required
                                name="aksi_{{ $loop->iteration }}" id="aksi_{{ $loop->iteration }}">
                                <option style="color: green; font-weight: bold;" value="Edit">
                                    Edit/Biarkan tetap disimpan</option>
                                <option style="color: red; font-weight: bold;" value="Hapus">
                                    Hapus (Jika dipilih data ini tidak akan disimpan lagi!)
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik_{{ $loop->iteration }}">NIK :</label>
                            <input type="text" name="nik_{{ $loop->iteration }}" id="nik_{{ $loop->iteration }}"
                                required class="form-control input" placeholder="NIK Penawar"
                                value="{{ $item->nik }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_{{ $loop->iteration }}">Nama :</label>
                            <input type="text" name="nama_{{ $loop->iteration }}" id="nama_{{ $loop->iteration }}"
                                required class="form-control input" placeholder="Nama" value="{{ $item->nama }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat_{{ $loop->iteration }}" class="wajib">Alamat :</label>
                            <textarea class="form-control input" name="alamat_{{ $loop->iteration }}" id="alamat_{{ $loop->iteration }}"
                                cols="30" rows="3" placeholder="Alamat">{!! $item->alamat !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga_tawar_{{ $loop->iteration }}" class="wajib">Harga Tawar :</label>
                            <input type="text" name="harga_tawar_{{ $loop->iteration }}"
                                id="harga_tawar_{{ $loop->iteration }}" required class="form-control input"
                                placeholder="Harga Tawar"
                                value="{{ $item->harga_tawar ? 'Rp. ' . number_format($item->harga_tawar, 0, ',', '.') : 'belum ada data' }}">
                        </div>
                    </div>
                    <br>
                @endforeach
            </div>

            {{-- tambahan --}}
            <div id="tambah_penawar_card"></div>
            <div class="row ml-2">
                <input class="btn btn-outline-primary mb-4" id="tambah_penawar" type="button"
                    value="(+) Tambah Penawar (+)">
            </div>
        </div>

        <div class="card-footer">
            <div class="form-group mb-0">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1" required>
                    <label class="custom-control-label" for="exampleCheck1">
                        Saya setuju dengan <a href="{{ asset('Juknis/Juknis.pdf') }}" target="_blank">ketentuan yang
                            berlaku</a>.
                    </label>
                </div>
            </div>
            <div class="form-group d-flex justify-content-end">
                <button id="simpan" type="submit" class="btn btn-primary" style="letter-spacing: 2px;">
                    <i class="fa-regular fa-floppy-disk"></i> &nbsp; <b>SIMPAN</b></button>
            </div>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>
</form>



@section('script')
    <script src="{{ asset('script/Inventaris_penjualan/inventaris_edit.js') }}"></script>
@endsection
@yield('footer')
@include('partial.footer')
