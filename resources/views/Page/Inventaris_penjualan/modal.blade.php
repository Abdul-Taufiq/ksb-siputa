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


{{-- modal add --}}
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="quickForm" action="{{ url('inventaris-penjualan') }}" method="post" enctype="multipart/form-data">
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
                                        <label for="no_inventaris">Nomor Inventaris :</label>
                                        <input type="text" name="no_inventaris" id="no_inventaris" required
                                            class="form-control input" placeholder="Nomor Inventaris">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="detail_barang" class="wajib">Detail Barang (Type/Merk/dll)
                                            :</label>
                                        <textarea class="summernote" name="detail_barang" id="detail_barang" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kondisi_terakhir" class="wajib">Kondisi Terakhir Barang :</label>
                                        <textarea class="summernote" name="kondisi_terakhir" id="kondisi_terakhir" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file" class="wajib">Foto Barang (PDF/JPG/JPEG/PNG) :</label>
                                        <input type="file" name="file" id="file" class="form-control input"
                                            accept="image/jpeg,image/jpg,image/png, application/pdf">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan" class="wajib">Keterangan :</label>
                                        <textarea class="summernote" name="keterangan" id="keterangan" cols="30" rows="3" required
                                            placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- Penawar --}}
                            <br>
                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <div class="header-container">
                                        <div class="header-line"></div>
                                        <div class="header-text">DATA PENAWAR 1</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik_1">NIK :</label>
                                        <input type="text" name="nik_1" id="nik_1" required
                                            class="form-control input" placeholder="NIK Penawar">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_1">Nama :</label>
                                        <input type="text" name="nama_1" id="nama_1" required
                                            class="form-control input" placeholder="Nama">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat_1" class="wajib">Alamat :</label>
                                        <textarea class="form-control input" name="alamat_1" id="alamat_1" cols="30" rows="3"
                                            placeholder="Alamat"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga_tawar_1" class="wajib">Harga Tawar :</label>
                                        <input type="text" name="harga_tawar_1" id="harga_tawar_1" required
                                            class="form-control input" placeholder="Harga Tawar">
                                    </div>
                                </div>
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
                                (PNG/JPG/JPEG/PDF) :</label>
                            <input type="file" name="file_detail_invoice" id="file_detail_invoice"
                                class="form-control input" accept="image/jpeg,image/jpg,image/png, application/pdf">
                        </div>
                    @endif

                    @if ($jabatan != 'Kasi Operasional')
                        @if ($jabatan == 'Direktur Operasional' || $jabatan == 'Direktur Utama')
                            <div class="form-group">
                                <label for="pembanding_dipilih">Pilih data barang (pembanding) :</label>
                                <select name="pembanding_dipilih" id="pembanding_dipilih"
                                    class="form-control input"></select>
                            </div>
                        @endif
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
