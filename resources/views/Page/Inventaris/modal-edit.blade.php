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



<form id="editForm" action=" {{ url('inventaris-pengajuan/' . $inventaris->id_inventaris_baru) }}" method="post"
    enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="card card-outline card-primary">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kategori_barang">Kategori Pengajuan Inventaris :</label>
                        <select name="kategori_barang" id="kategori_barang" autocomplete="off" required
                            class="form-control input border-success">
                            <option disabled selected hidden>- Pilih Kategori Pengajuan Inventaris -
                            </option>
                            <option value="Elektronik"
                                {{ $inventaris->kategori_barang == 'Elektronik' ? 'selected' : null }}>
                                Elektronik</option>
                            <option value="Kendaraan"
                                {{ $inventaris->kategori_barang == 'Kendaraan' ? 'selected' : null }}>
                                Kendaraan</option>
                            <option value="Peralatan/Perlengkapan Kantor"
                                {{ $inventaris->kategori_barang == 'Peralatan/Perlengkapan Kantor' ? 'selected' : null }}>
                                Peralatan/Perlengkapan Kantor</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jns_pembelian">Jenis Pembelian :</label>
                        <select name="jns_pembelian" id="jns_pembelian" autocomplete="off" required
                            class="form-control input border-success">
                            <option disabled selected hidden>- Pilih Jenis Inventaris -
                            </option>
                            <option value="Pembelian Dengan Speksifikasi Cabang"
                                {{ $inventaris->jns_pembelian == 'Pembelian Dengan Speksifikasi Cabang' ? 'selected' : null }}>
                                Pembelian Dengan Speksifikasi Cabang</option>
                            <option value="Pembelian Dengan Speksifikasi KPM"
                                {{ $inventaris->jns_pembelian == 'Pembelian Dengan Speksifikasi KPM' ? 'selected' : null }}>
                                Pembelian Dengan Speksifikasi KPM (Khusus Elektronik)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="qty">QTY (Jumlah Barang) :</label>
                        <input type="number" name="qty" id="qty" required
                            class="form-control input border-success" placeholder="QTY" value="{{ $inventaris->qty }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="catatan" class="wajib">Catatan :</label>
                        <textarea class="form-control input border-success" name="catatan" id="catatan" cols="30" rows="1" required
                            placeholder="Catatan">{{ $inventaris->catatan }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan" class="wajib">Keterangan :</label>
                        <textarea class="form-control input border-success" name="keterangan" id="keterangan" cols="30" rows="1"
                            required placeholder="Keterangan">{{ $inventaris->keterangan }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ELEKTRONIK --}}
            <div class="d-none" id="pembungkus_elektronik">
                {{-- tambahan --}}
                <div id="tambah_barang_pembanding_elektronik_card"></div>
                <div class="row ml-2">
                    <input class="btn btn-outline-primary mb-4" id="tambah_barang_pembanding_elektronik" type="button"
                        value="(+) Tambah Barang Pembanding Elektronik (+)">
                </div>
            </div>

            {{-- NON-ELEKRONIK --}}
            <div class="d-none" id="pembungkus_non_elektronik">
                {{-- tambahan --}}
                <div id="tambah_barang_pembanding_non_elektronik_card"></div>
                <div class="row ml-2">
                    <input class="btn btn-outline-primary mb-4" id="tambah_barang_pembanding_non_elektronik"
                        type="button" value="(+) Tambah Barang Pembanding Non-Elektronik (+)">
                </div>
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
    <script src="{{ asset('script/Inventaris/inventaris_edit.js') }}"></script>
@endsection
@yield('footer')
@include('partial.footer')
