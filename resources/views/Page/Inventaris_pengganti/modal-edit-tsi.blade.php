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



<form id="editForm" action=" {{ url('inventaris-pengganti-edit/' . $inventarisPengganti->id_inventaris_pengganti) }}"
    method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="card card-outline card-primary">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kategori_barang">Kategori Pengajuan Inventaris :</label>
                        <select name="kategori_barang" id="kategori_barang" autocomplete="off" required
                            class="form-control input border-success" readonly disabled>
                            <option disabled selected hidden>- Pilih Kategori Pengajuan Inventaris -
                            </option>
                            <option value="Elektronik"
                                {{ $inventarisPengganti->kategori_barang == 'Elektronik' ? 'selected' : null }}>
                                Elektronik</option>
                            <option value="Kendaraan"
                                {{ $inventarisPengganti->kategori_barang == 'Kendaraan' ? 'selected' : null }}>
                                Kendaraan</option>
                            <option value="Peralatan/Perlengkapan Kantor"
                                {{ $inventarisPengganti->kategori_barang == 'Peralatan/Perlengkapan Kantor' ? 'selected' : null }}>
                                Peralatan/Perlengkapan Kantor</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jns_pembelian">Jenis Pembelian :</label>
                        <select name="jns_pembelian" id="jns_pembelian" autocomplete="off" required
                            class="form-control input border-success" readonly disabled>
                            <option disabled selected hidden>- Pilih Jenis Inventaris -
                            </option>
                            <option value="Pembelian Dengan Speksifikasi Cabang"
                                {{ $inventarisPengganti->jns_pembelian == 'Pembelian Dengan Speksifikasi Cabang' ? 'selected' : null }}>
                                Pembelian Dengan Speksifikasi Cabang</option>
                            <option value="Pembelian Dengan Speksifikasi KPM"
                                {{ $inventarisPengganti->jns_pembelian == 'Pembelian Dengan Speksifikasi KPM' ? 'selected' : null }}>
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
                            class="form-control input border-success" readonly disabled placeholder="QTY"
                            value="{{ $inventarisPengganti->qty }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="catatan" class="wajib">Catatan :</label>
                        <textarea class="form-control input border-success" readonly disabled name="catatan" id="catatan" cols="30"
                            rows="1" required placeholder="Catatan">{{ $inventarisPengganti->catatan }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan" class="wajib">Keterangan :</label>
                        <textarea class="form-control input border-success" readonly disabled name="keterangan" id="keterangan" cols="30"
                            rows="1" required placeholder="Keterangan">{{ $inventarisPengganti->keterangan }}</textarea>
                    </div>
                </div>
            </div>
            {{-- ELEKTRONIK --}}
            <div>
                {{-- tambahan --}}
                <div id="tambah_barang_pembanding_elektronik_card_tsi"></div>
                <div class="row ml-2">
                    <input class="btn btn-outline-primary mb-4" id="tambah_barang_pembanding_elektronik" type="button"
                        value="(+) Tambah Barang Pembanding Elektronik (+)">
                </div>
            </div>

            <hr>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="catatan_tsi" class="wajib">Catatan TSI :</label>
                    <textarea class="form-control input border-danger" name="catatan_tsi" id="catatan_tsi" cols="30" rows="3"
                        required placeholder="Catatan">{{ $inventarisPengganti->catatan_tsi }}</textarea>
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
                    <i class="fa-regular fa-floppy-disk"></i> &nbsp; <b>Kirim ke DirOps</b></button>
            </div>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>
</form>



@section('script')
    <script src="{{ asset('script/Inventaris_pengganti/inventaris_tsi_edit.js') }}"></script>
@endsection
@yield('footer')
@include('partial.footer')
