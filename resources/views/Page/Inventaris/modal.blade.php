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



{{-- modal add --}}
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="quickForm" action="{{ url('inventaris-pengajuan') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add" style="letter-spacing: 2px; font-weight: bold;">
                        Tambah {{ $title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jns_pembelian">Jenis Pembelian :</label>
                                        <select name="jns_pembelian" id="jns_pembelian" autocomplete="off" required
                                            class="form-control input">
                                            <option disabled selected hidden>- Pilih Jenis Inventaris -
                                            </option>
                                            <option value="Pembelian Dengan Speksifikasi Cabang"
                                                {{ old('jns_pembelian') == 'Pembelian Dengan Speksifikasi Cabang' ? 'selected' : null }}>
                                                Pembelian Dengan Speksifikasi Cabang</option>
                                            <option value="Pembelian Dengan Speksifikasi KPM"
                                                {{ old('jns_pembelian') == 'Pembelian Dengan Speksifikasi KPM' ? 'selected' : null }}>
                                                Pembelian Dengan Speksifikasi KPM (Khusus Elektronik)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-2">
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
                                        <textarea class="form-control input" name="catatan" id="catatan" cols="30" rows="1" required
                                            placeholder="Catatan"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan" class="wajib">Keterangan :</label>
                                        <textarea class="form-control input" name="keterangan" id="keterangan" cols="30" rows="1" required
                                            placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- ELEKTRONIK --}}
                            <div class="d-none" id="pembungkus_elektronik">
                                {{-- if barang elektronik - Pembandingan 1 --}}
                                <div class="row ml-2">
                                    <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 252)">Data
                                        Pembanding Barang Elektronik 1
                                        &#8628;</h5>
                                    <hr style="width: 95%; margin-left: 5px">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_barang_1">Jenis Barang :</label>
                                            <input type="text" name="jns_barang_1" id="jns_barang_1"
                                                class="form-control input"
                                                placeholder="ex: Printer/Komputer/Laptop atau yang lainnya">
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
                                                class="form-control input"
                                                placeholder="Nama Toko (Market) - ex: ABC (Tokopedia)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="harga_pembelian"_1>Harga :</label>
                                            <input type="text" name="harga_pembelian_1" id="harga_pembelian_1"
                                                class="form-control input" placeholder="Harga">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="file_detail_toko_1">File Detail Toko
                                                (PNG/JPG/JPEG/RAR/ZIP) :</label>
                                            <input type="file" name="file_detail_toko_1" id="file_detail_toko_1"
                                                class="form-control input"
                                                accept="image/jpeg,image/jpg,image/png, .zip, .rar, .7zip">
                                        </div>
                                    </div>
                                </div>

                                {{-- if barang elektronik - Pebandingan 2 --}}
                                <div class="row ml-2">
                                    <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 252)">Data
                                        Pembanding Barang Elektronik 2
                                        &#8628;</h5>
                                    <hr style="width: 95%; margin-left: 5px">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_barang_2">Jenis Barang :</label>
                                            <input type="text" name="jns_barang_2" id="jns_barang_2"
                                                class="form-control input"
                                                placeholder="ex: Printer/Komputer/Laptop atau yang lainnya">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="merk_2">Merk :</label>
                                            <input type="text" name="merk_2" id="merk_2"
                                                class="form-control input" placeholder="Merk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="type_2">Type :</label>
                                            <input type="text" name="type_2" id="type_2"
                                                class="form-control input" placeholder="Type">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="nama_toko_2">Nama Toko :</label>
                                            <input type="text" name="nama_toko_2" id="nama_toko_2"
                                                class="form-control input"
                                                placeholder="Nama Toko (Market) - ex: ABC (Tokopedia)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="harga_pembelian_2">Harga :</label>
                                            <input type="text" name="harga_pembelian_2" id="harga_pembelian_2"
                                                class="form-control input" placeholder="Harga">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="file_detail_toko_2">File Detail Toko
                                                (PNG/JPG/JPEG/RAR/ZIP) :</label>
                                            <input type="file" name="file_detail_toko_2" id="file_detail_toko_2"
                                                class="form-control input"
                                                accept="image/jpeg,image/jpg,image/png, .zip, .rar, .7zip">
                                        </div>
                                    </div>
                                </div>

                                {{-- if barang elektronik - Pebandingan 3 --}}
                                <div class="row ml-2">
                                    <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 252)">Data
                                        Pembanding Barang Elektronik 3
                                        &#8628;</h5>
                                    <hr style="width: 95%; margin-left: 5px">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_barang_3">Jenis Barang :</label>
                                            <input type="text" name="jns_barang_3" id="jns_barang_3"
                                                class="form-control input"
                                                placeholder="ex: Printer/Komputer/Laptop atau yang lainnya">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="merk_3">Merk :</label>
                                            <input type="text" name="merk_3" id="merk_3"
                                                class="form-control input" placeholder="Merk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="type_3">Type :</label>
                                            <input type="text" name="type_3" id="type_3"
                                                class="form-control input" placeholder="Type">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="nama_toko_3">Nama Toko :</label>
                                            <input type="text" name="nama_toko_3" id="nama_toko_3"
                                                class="form-control input"
                                                placeholder="Nama Toko (Market) - ex: ABC (Tokopedia)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="harga_pembelian_3">Harga :</label>
                                            <input type="text" name="harga_pembelian_3" id="harga_pembelian_3"
                                                class="form-control input" placeholder="Harga">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="file_detail_toko_3">File Detail Toko
                                                (PNG/JPG/JPEG/RAR/ZIP) :</label>
                                            <input type="file" name="file_detail_toko_3" id="file_detail_toko_3"
                                                class="form-control input"
                                                accept="image/jpeg,image/jpg,image/png, .zip, .rar, .7zip">
                                        </div>
                                    </div>
                                </div>

                                {{-- tambahan --}}
                                <div id="tambah_barang_pembanding_elektronik_card"></div>
                                <div class="row ml-2">
                                    <input class="btn btn-outline-primary mb-4"
                                        id="tambah_barang_pembanding_elektronik" type="button"
                                        value="(+) Tambah Barang Pembanding Elektronik (+)">
                                </div>
                            </div>

                            {{-- NON-ELEKRONIK --}}
                            <div class="d-none" id="pembungkus_non_elektronik">
                                {{-- if barang NON-elektronik - Pembandingan 1 --}}
                                <div class="row ml-2">
                                    <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 252)">Data
                                        Pembanding Barang Non-Elektronik 1
                                        &#8628;</h5>
                                    <hr style="width: 95%; margin-left: 5px">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_barang_1">Jenis Barang :</label>
                                            <input type="text" name="jns_barang_1" id="jns_barang_1"
                                                class="form-control input"
                                                placeholder="ex: Printer/Komputer/Laptop atau yang lainnya">
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
                                                class="form-control input"
                                                placeholder="Nama Toko (Market) - ex: ABC (Tokopedia)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="harga_pembelian"_1>Harga :</label>
                                            <input type="text" name="harga_pembelian_1" id="harga_pembelian_non_1"
                                                class="form-control input" placeholder="Harga">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="file_detail_toko_1">File Detail Toko
                                                (PNG/JPG/JPEG/RAR/ZIP) :</label>
                                            <input type="file" name="file_detail_toko_1" id="file_detail_toko_1"
                                                class="form-control input"
                                                accept="image/jpeg,image/jpg,image/png, .zip, .rar, .7zip">
                                        </div>
                                    </div>
                                </div>

                                {{-- if barang NON-elektronik - Pebandingan 2 --}}
                                <div class="row ml-2">
                                    <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 252)">Data
                                        Pembanding Barang Non-Elektronik 2
                                        &#8628;</h5>
                                    <hr style="width: 95%; margin-left: 5px">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_barang_2">Jenis Barang :</label>
                                            <input type="text" name="jns_barang_2" id="jns_barang_2"
                                                class="form-control input"
                                                placeholder="ex: Printer/Komputer/Laptop atau yang lainnya">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="merk_2">Merk :</label>
                                            <input type="text" name="merk_2" id="merk_2"
                                                class="form-control input" placeholder="Merk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="type_2">Type :</label>
                                            <input type="text" name="type_2" id="type_2"
                                                class="form-control input" placeholder="Type">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="nama_toko_2">Nama Toko :</label>
                                            <input type="text" name="nama_toko_2" id="nama_toko_2"
                                                class="form-control input"
                                                placeholder="Nama Toko (Market) - ex: ABC (Tokopedia)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="harga_pembelian_2">Harga :</label>
                                            <input type="text" name="harga_pembelian_2" id="harga_pembelian_non_2"
                                                class="form-control input" placeholder="Harga">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="file_detail_toko_2">File Detail Toko
                                                (PNG/JPG/JPEG/RAR/ZIP) :</label>
                                            <input type="file" name="file_detail_toko_2" id="file_detail_toko_2"
                                                class="form-control input"
                                                accept="image/jpeg,image/jpg,image/png, .zip, .rar, .7zip">
                                        </div>
                                    </div>
                                </div>

                                {{-- if barang NON-elektronik - Pebandingan 3 --}}
                                <div class="row ml-2">
                                    <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 252)">Data
                                        Pembanding Barang Non-Elektronik 3
                                        &#8628;</h5>
                                    <hr style="width: 95%; margin-left: 5px">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_barang_3">Jenis Barang :</label>
                                            <input type="text" name="jns_barang_3" id="jns_barang_3"
                                                class="form-control input"
                                                placeholder="ex: Printer/Komputer/Laptop atau yang lainnya">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="merk_3">Merk :</label>
                                            <input type="text" name="merk_3" id="merk_3"
                                                class="form-control input" placeholder="Merk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="type_3">Type :</label>
                                            <input type="text" name="type_3" id="type_3"
                                                class="form-control input" placeholder="Type">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="nama_toko_3">Nama Toko :</label>
                                            <input type="text" name="nama_toko_3" id="nama_toko_3"
                                                class="form-control input"
                                                placeholder="Nama Toko (Market) - ex: ABC (Tokopedia)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="harga_pembelian_3">Harga :</label>
                                            <input type="text" name="harga_pembelian_3" id="harga_pembelian_non_3"
                                                class="form-control input" placeholder="Harga">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="file_detail_toko_3">File Detail Toko
                                                (PNG/JPG/JPEG/RAR/ZIP) :</label>
                                            <input type="file" name="file_detail_toko_3" id="file_detail_toko_3"
                                                class="form-control input"
                                                accept="image/jpeg,image/jpg,image/png, .zip, .rar, .7zip">
                                        </div>
                                    </div>
                                </div>

                                {{-- tambahan --}}
                                <div id="tambah_barang_pembanding_non_elektronik_card"></div>
                                <div class="row ml-2">
                                    <input class="btn btn-outline-primary mb-4"
                                        id="tambah_barang_pembanding_non_elektronik" type="button"
                                        value="(+) Tambah Barang Pembanding Non-Elektronik (+)">
                                </div>
                            </div>



                        </div>
                        <div class="card-footer">
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms" class="custom-control-input"
                                        id="exampleCheck1" required>
                                    <label class="custom-control-label" for="exampleCheck1">
                                        Saya setuju dengan <a href="{{ asset('Juknis/Juknis.pdf') }}"
                                            target="_blank">ketentuan yang berlaku</a>.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card card-outline card-primary mb-0"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="simpan" type="submit" class="btn btn-primary" style="letter-spacing: 2px;">
                        <i class="fa-regular fa-floppy-disk"></i> &nbsp; <b>SIMPAN</b></button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- End modal add --}}



{{-- modal detail --}}
<div class="modal" id="myModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader" style="letter-spacing: 2px; font-weight: bold;">DETAIL
                    DATA
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
                <button class="btn btn-primary btnPrint" type="button">
                    <i class="fa fa-print" aria-hidden="true"></i> &nbsp;
                    Cetak
                </button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>




{{-- modal edit --}}
<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel" style="letter-spacing: 2px; font-weight: bold;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="frameEdit" type="" width="100%" height="400px"></iframe>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
{{-- End modal edit --}}



<!-- Modal Reject -->
<input hidden value="{{ $jabatan = auth()->user()->jabatan }}">
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="modalRejectLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRejectLabel">Reject Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="rejectForm" action="/status-spk-rej" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="catatan">Catatan Reject:</label>
                        <textarea class="form-control input" id="catatan" name="catatan" required></textarea>
                    </div>
                    <input type="hidden" name="encryptedId" id="encryptedId" value="">
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck3"
                                required>
                            <label class="custom-control-label" for="exampleCheck3">Saya setuju dengan<a
                                    href="#"> ketentuan yang berlaku</a>.</label>
                            <label class="text-danger"><i>Coution: </i> Pastikan bahwa Anda telah yakin untuk
                                melakukan aksi ini!</label>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Lanjutkan Reject Pengajuan Ini!</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Modal Approve -->
<div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="modalApproveLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalApproveLabel">Approve Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="approveForm" action="/status-spk" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="modal-body">
                    @if ($jabatan == 'Kasi Operasional' || $jabatan == 'TSI')
                        <div class="form-group">
                            <label class="wajib" for="file_detail_invoice">File Detail Invoice
                                (PNG/JPG/JPEF/RAR/ZIP) :</label>
                            <input type="file" name="file_detail_invoice" id="file_detail_invoice"
                                class="form-control input" accept="image/jpeg,image/jpg,image/png, .zip, .rar, .7zip">
                        </div>
                    @endif

                    @if ($jabatan != 'Kasi Operasional')
                        <div class="form-group">
                            <label for="catatan">Catatan Approve:</label>
                            <textarea class="form-control input" id="catatan" name="catatan" required></textarea>
                        </div>
                    @endif
                    <input type="hidden" name="encryptedId" id="encryptedId" value="">
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck4"
                                required>
                            <label class="custom-control-label" for="exampleCheck4">Saya setuju dengan<a
                                    href="#"> ketentuan yang berlaku</a>.</label>
                            <label class="text-danger"><i>Coution: </i> Pastikan bahwa Anda telah yakin untuk
                                melakukan aksi ini!</label>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan Approve Pengajuan Ini!</button>
                </div>
            </form>
        </div>
    </div>
</div>
