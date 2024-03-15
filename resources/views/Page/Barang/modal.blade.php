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

<style>
    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none;
    }
</style>



{{-- modal add --}}
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="quickForm" action="{{ url('tsi-barang-elektro') }}" method="post" enctype="multipart/form-data">
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
                                        <label for="cabang">Kode Cabang :</label>
                                        <select name="cabang" id="cabang" class="input form-control">
                                            <option disabled selected>-Pilih-</option>
                                            <option value="0">KPM</option>
                                            <option value="1">KPO</option>
                                            <option value="2">Temanggung</option>
                                            <option value="3">Wonosobo</option>
                                            <option value="4">Ambarawa</option>
                                            <option value="5">Semarang</option>
                                            <option value="6">Mranggen</option>
                                            <option value="7">Sukorejo</option>
                                            <option value="8">Weleri</option>
                                            <option value="9">Delanggu</option>
                                            <option value="10">Gombong</option>
                                            <option value="11">Sokaraja</option>
                                            <option value="20">Area</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_inventaris">Kode Inventaris :</label>
                                        <input type="text" name="kode_inventaris" id="kode_inventaris"
                                            class="form-control input">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_barang">Kode Barang :</label>
                                        <input type="text" name="kode_barang" id="kode_barang"
                                            class="form-control input" placeholder="Dari TSI/ ketik `-` untuk auto">
                                    </div>
                                </div>
                            </div>

                            <div class="row ml-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jns_barang">Jenis Barang :</label>
                                        <select name="jns_barang" id="jns_barang" class="input form-control">
                                            <option disabled selected>-Pilih-</option>
                                            <option value="Komputer">Komputer</option>
                                            <option value="Laptop">Laptop</option>
                                            <option value="Printer">Printer</option>
                                            <option value="Lainnya (Jaringan)">Lainnya (Jaringan)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="merk">Merk :</label>
                                        <input type="text" name="merk" id="merk" class="form-control input"
                                            placeholder="Merk">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Type :</label>
                                        <input type="text" name="type" id="type" class="form-control input"
                                            placeholder="type">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="posisi">Posisi :</label>
                                        <input type="text" name="posisi" id="posisi" class="form-control input"
                                            placeholder="Posisi Letak PC">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ip_address">IP Address :</label>
                                        <input type="text" name="ip_address" id="ip_address"
                                            class="form-control input" placeholder="IP add">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_pembelian">Tanggal Pembelian :</label>
                                        <input type="date" name="tgl_pembelian" id="tgl_pembelian"
                                            class="form-control input" placeholder="Tanggal Pembelian">
                                    </div>
                                </div>
                            </div>
                            <div class="ml-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="speksifikasi">Speksifikasi :</label>
                                        <input id="speksifikasi" type="hidden" name="speksifikasi"
                                            class="form-control input" placeholder="Speksifikasi" required>
                                        <trix-editor input="speksifikasi" class="input"></trix-editor>
                                    </div>
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



{{-- modal edit --}}
<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editForm" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel" style="letter-spacing: 2px; font-weight: bold;">
                        Tambah {{ $title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card card-outline card-warning">
                    <div class="card-body">
                        <div class="row ml-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cabang_edit">Kode Cabang :</label>
                                    <select name="cabang_edit" id="cabang_edit" class="input form-control">
                                        <option disabled selected>-Pilih-</option>
                                        <option value="0">KPM</option>
                                        <option value="1">KPO</option>
                                        <option value="2">Temanggung</option>
                                        <option value="3">Wonosobo</option>
                                        <option value="4">Ambarawa</option>
                                        <option value="5">Semarang</option>
                                        <option value="6">Mranggen</option>
                                        <option value="7">Sukorejo</option>
                                        <option value="8">Weleri</option>
                                        <option value="9">Delanggu</option>
                                        <option value="10">Gombong</option>
                                        <option value="11">Sokaraja</option>
                                        <option value="20">Area</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_inventaris_edit">Kode Inventaris :</label>
                                    <input type="text" name="kode_inventaris_edit" id="kode_inventaris_edit"
                                        class="form-control input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_barang_edit">Kode Barang :</label>
                                    <input type="text" name="kode_barang_edit" id="kode_barang_edit"
                                        class="form-control input" placeholder="Dari TSI/ ketik `-` untuk auto">
                                </div>
                            </div>
                        </div>

                        <div class="row ml-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jns_barang_edit">Jenis Barang :</label>
                                    <select name="jns_barang_edit" id="jns_barang_edit" class="input form-control">
                                        <option disabled selected>-Pilih-</option>
                                        <option value="Komputer">Komputer</option>
                                        <option value="Laptop">Laptop</option>
                                        <option value="Printer">Printer</option>
                                        <option value="Lainnya (Jaringan)">Lainnya (Jaringan)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="merk_edit">Merk :</label>
                                    <input type="text" name="merk_edit" id="merk_edit" class="form-control input"
                                        placeholder="Merk">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type_edit">Type :</label>
                                    <input type="text" name="type_edit" id="type_edit" class="form-control input"
                                        placeholder="type">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="posisi_edit">Posisi :</label>
                                    <input type="text" name="posisi_edit" id="posisi_edit"
                                        class="form-control input" placeholder="Posisi Letak PC">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ip_address_edit">IP Address :</label>
                                    <input type="text" name="ip_address_edit" id="ip_address_edit"
                                        class="form-control input" placeholder="IP">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_pembelian_edit">Tanggal Pembelian :</label>
                                    <input type="date" name="tgl_pembelian_edit" id="tgl_pembelian_edit"
                                        class="form-control input" placeholder="Tanggal Pembelian">
                                </div>
                            </div>
                        </div>
                        <div class="ml-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="speksifikasi_edit">Speksifikasi :</label>
                                    <input id="speksifikasi_edit" type="hidden" name="speksifikasi_edit"
                                        class="form-control input" placeholder="Speksifikasi_edit" required>
                                    <trix-editor id="spek" input="speksifikasi_edit"
                                        class="input"></trix-editor>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input"
                                    id="exampleCheck2" required>
                                <label class="custom-control-label" for="exampleCheck2">
                                    Saya setuju dengan <a href="{{ asset('Juknis/Juknis.pdf') }}"
                                        target="_blank">ketentuan yang berlaku</a>.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="simpan" type="submit" class="btn btn-primary" style="letter-spacing: 2px;">
                            <i class="fa-regular fa-floppy-disk"></i> &nbsp; <b>SIMPAN</b></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
                </div>
                <div class="card card-outline card-warning mb-0"></div>
            </div>
        </form>
    </div>
</div>
{{-- End modal edit --}}



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
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>
