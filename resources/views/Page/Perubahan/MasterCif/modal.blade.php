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
        <form id="quickForm" action="{{ url('perubahan-cif') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add" style="letter-spacing: 2px; font-weight: bold;">
                        Tambah Pengajuan Perubahan Transaksi Master CIF
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jns_cif">Jenis Perubahan CIF :</label>
                                        <select name="jns_cif" id="jns_cif" autocomplete="off" required
                                            value="{{ old('jns_cif') }}" class="form-control input">
                                            <option value="" disabled selected hidden>- Pilih Jenis CIF -
                                            </option>
                                            <option value="Merger CIF"
                                                {{ old('jns_cif') == 'Merger CIF' ? 'selected' : null }}>
                                                Merger CIF</option>
                                            <option value="Pengkinian Data CIF"
                                                {{ old('jns_cif') == 'Pengkinian Data CIF' ? 'selected' : null }}>
                                                Pengkinian Data CIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_nasabah">Nama Nasabah :</label>
                                        <input type="text" name="nama_nasabah" id="nama_nasabah" required
                                            class="form-control input" placeholder="Nama Nasabah">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_cif_utama">No CIF Utama :</label>
                                        <input type="text" name="no_cif_utama" id="no_cif_utama"
                                            class="form-control input" placeholder="No CIF Utama" required>
                                    </div>
                                </div>
                                <div class="col-md-6" id="no_cif_merger_1_head">
                                    <div class="form-group">
                                        <label for="no_cif_merger_1" class="wajib">No CIF Merger :</label>
                                        <input type="text" name="no_cif_merger_1" id="no_cif_merger_1"
                                            class="form-control input" placeholder="No CIF Merger">
                                        <input class="btn btn-outline-primary" id="tambah_cif" type="button"
                                            value="(+) Tambah No CIF (+)">
                                    </div>
                                </div>
                                <div style="margin-left: -5px;" id="tambah_cif_card" class="row"></div>

                                <div class="col-md-6" id="ktp_head">
                                    <div class="form-group">
                                        <label for="ktp" class="wajib">Berkas KTP (KArtu Tanda PEnduduk) :</label>
                                        <input type="file" name="ktp" id="ktp" class="form-control input"
                                            placeholder="Berkas KTP (KArtu TAnda PEnduduk)"
                                            accept="image/jpeg,image/jpg,image/png" onchange="upload(this)">
                                    </div>
                                    <div class="me-sm-2"
                                        style="width: 200px; height: 200px; background-color: #ccc; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                                        <img style="max-width: 100%; max-height: 100%; object-fit: cover;"
                                            id="image" alt=""> <br><br>
                                    </div>
                                </div>
                                <div class="col-md-6" id="nama_ibu_head">
                                    <div class="form-group">
                                        <label for="nama_ibu" class="wajib">Nama Ibu Kandung :</label>
                                        <input type="text" name="nama_ibu" id="nama_ibu" class="form-control input"
                                            placeholder="Nama Ibu Kandung">
                                    </div>
                                </div>
                                <div class="col-md-6" id="alasan_head">
                                    <div class="form-group">
                                        <label for="alasan" class="wajib">Alasan :</label>
                                        <input type="text" name="alasan" id="alasan"
                                            class="form-control input" placeholder="Alasan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan" class="wajib">Keterangan :</label>
                                        <textarea class="form-control input" name="keterangan" id="keterangan" cols="30" rows="3" required
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
                        Tambah Pengajuan Perubahan Transaksi Master CIF
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jns_cif">Jenis Perubahan CIF :</label>
                                        <select name="jns_cif" id="jns_cif_edit" autocomplete="off" required
                                            value="{{ old('jns_cif') }}" class="form-control input">
                                            <option value="" disabled selected hidden>- Pilih Jenis CIF -
                                            </option>
                                            <option value="Merger CIF"
                                                {{ old('jns_cif') == 'Merger CIF' ? 'selected' : null }}>
                                                Merger CIF</option>
                                            <option value="Pengkinian Data CIF"
                                                {{ old('jns_cif') == 'Pengkinian Data CIF' ? 'selected' : null }}>
                                                Pengkinian Data CIF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_nasabah">Nama Nasabah :</label>
                                        <input type="text" name="nama_nasabah" id="nama_nasabah_edit" required
                                            class="form-control input" placeholder="Nama Nasabah">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_cif_utama" class="wajib">No CIF Utama :</label>
                                        <input type="text" name="no_cif_utama" id="no_cif_utama_edit"
                                            class="form-control input" placeholder="No CIF Utama">
                                    </div>
                                </div>
                                <div class="col-md-6" id="no_cif_merger_head_edit">
                                    <div class="form-group">
                                        <label for="no_cif_merger" class="wajib">No CIF Merger :</label>
                                        <input type="text" name="no_cif_merger" id="no_cif_merger_edit"
                                            class="form-control input" placeholder="No CIF Merger">
                                        <p style="font-size: 8pt"><b>Note : Jika nomor CIF lebih dari satu kasih koma.
                                                cth = no_cif1, no_cif2,
                                                ...</b></p>
                                    </div>
                                </div>

                                <div class="col-md-6" id="ktp_head_edit">
                                    <div class="form-group">
                                        <label for="ktp" class="wajib">Berkas KTP (KArtu Tanda PEnduduk)
                                            :</label>
                                        <input type="file" name="ktp" id="ktp_edit"
                                            class="form-control input" placeholder="Berkas KTP (KArtu TAnda PEnduduk)"
                                            accept="image/jpeg,image/jpg,image/png" onchange="upload_edit(this)">
                                    </div>
                                    <div class="me-sm-2 d-none" id="image_edit_head"
                                        style="width: 200px; height: 200px; background-color: #ccc; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                                        <img style="max-width: 100%; max-height: 100%; object-fit: cover;"
                                            id="image_edit" alt=""> <br><br>
                                    </div>
                                </div>
                                <div class="col-md-6" id="nama_ibu_head_edit">
                                    <div class="form-group">
                                        <label for="nama_ibu" class="wajib">Nama Ibu Kandung :</label>
                                        <input type="text" name="nama_ibu" id="nama_ibu_edit"
                                            class="form-control input" placeholder="Nama Ibu Kandung">
                                    </div>
                                </div>
                                <div class="col-md-6" id="alasan_head_edit">
                                    <div class="form-group">
                                        <label for="alasan" class="wajib">Alasan :</label>
                                        <input type="text" name="alasan" id="alasan_edit"
                                            class="form-control input" placeholder="Alasan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan" class="wajib">Keterangan :</label>
                                        <textarea class="form-control input" name="keterangan" id="keterangan_edit" cols="30" rows="3" required
                                            placeholder="Keterangan"></textarea>
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
{{-- End modal edit --}}



{{-- modal detail --}}
<div class="modal" id="myModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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


<!-- Modal status reject-->
<!-- Modal Reject -->
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
                    <input hidden value="{{ $jabatan = auth()->user()->jabatan }}">

                    @if ($jabatan == 'Pembukuan' || $jabatan == 'Direktur Operasional')
                        <div class="form-group">
                            <label for="pelanggaran">Pelanggaran/Tidak? :</label>
                            <select class="form-control input" name="pelanggaran" id="pelanggaran">
                                <option disabled selected>-Pilih-</option>
                                <option value="Pelanggaran">Pelanggaran</option>
                                <option value="Bukan Pelanggaran">Bukan Pelanggaran</option>
                            </select>
                        </div>
                    @endif
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
                    <input hidden value="{{ $jabatan = auth()->user()->jabatan }}">

                    @if ($jabatan == 'Pembukuan' || $jabatan == 'Direktur Operasional')
                        <div class="form-group">
                            <label for="pelanggaran">Pelanggaran/Tidak? :</label>
                            <select class="form-control input" name="pelanggaran" id="pelanggaran">
                                <option disabled selected>-Pilih-</option>
                                <option value="Pelanggaran">Pelanggaran</option>
                                <option value="Bukan Pelanggaran">Bukan Pelanggaran</option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="catatan">Catatan Approve:</label>
                        <textarea class="form-control input" id="catatan" name="catatan" required></textarea>
                    </div>
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
