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
        <form id="quickForm" action="{{ url('pemeliharaan-perangkat') }}" method="post" enctype="multipart/form-data">
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
                                        <label for="kode_inventaris">Kode Inventaris :</label>
                                        <input type="text" name="kode_inventaris" id="kode_inventaris"
                                            class="form-control input">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="detail_barang">Detail Inventaris :</label>
                                        <input type="text" name="detail_barang" id="detail_barang"
                                            class="form-control input">
                                    </div>
                                </div>
                            </div>

                            <div class="ml-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail_kendala">Detail Kendala :</label>
                                        <input id="detail_kendala" type="hidden" name="detail_kendala"
                                            class="form-control input" placeholder="Detail Kendala" required>
                                        <trix-editor input="detail_kendala" class="input"></trix-editor>
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
                                    <label for="kode_inventaris_edit">Kode Inventaris :</label>
                                    <input type="text" name="kode_inventaris_edit" id="kode_inventaris_edit"
                                        class="form-control input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="detail_barang_edit">Detail Inventaris :</label>
                                    <input type="text" name="detail_barang_edit" id="detail_barang_edit"
                                        class="form-control input">
                                </div>
                            </div>
                        </div>
                        <div class="ml-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail_kendala_edit">Detail Kendala :</label>
                                    <input id="detail_kendala_edit" type="hidden" name="detail_kendala_edit"
                                        class="form-control input" placeholder="Detail Kendala" required>
                                    <trix-editor id="kendala" input="detail_kendala_edit"
                                        class="input"></trix-editor>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input"
                                    id="exampleCheck2" required>
                                <label class="custom-control-label" for="exampleCheck2">
                                    Saya setuju dengan <a href="{{ asset('Juknis/Juknis.pdf') }}"
                                        target="_blank">ketentuan
                                        yang berlaku</a>.
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
                    <div class="form-group">
                        <label for="keputusan_tsi">Keputusan TSI (Perbaiki Sendiri/Sevice):</label>
                        <select name="keputusan_tsi" id="keputusan_tsi" class="form-control input" required>
                            <option selected disabled>- Pilih Status -</option>
                            <option value="Perbaikan Mandiri">Perbaikan Mandiri</option>
                            <option value="Jasa Service/Luar">Jasa Service/Luar</option>
                        </select>
                    </div>
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
    <div class="modal-dialog  modal-lg" role="document">
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
                    <div class="form-group">
                        <label for="keputusan_tsi">Keputusan TSI (Perbaiki Sendiri/Sevice):</label>
                        <select name="keputusan_tsi" id="keputusan_tsi" class="form-control input" required>
                            <option selected disabled>- Pilih Status -</option>
                            <option value="Perbaikan Mandiri">Perbaikan Mandiri</option>
                            <option value="Jasa Service/Luar">Jasa Service/Luar</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="detail_kerusakan">Detail Kerusakannya :</label>
                        <input id="detail_kerusakan" type="hidden" name="detail_kerusakan"
                            class="form-control input" placeholder="Detail Kendala" required>
                        <trix-editor input="detail_kerusakan" class="input"></trix-editor>
                    </div>

                    <div class="form-group">
                        <label for="detail_perbaikan">Detail Perbaikannya :</label>
                        <input id="detail_perbaikan" type="hidden" name="detail_perbaikan"
                            class="form-control input" placeholder="Detail Kendala" required>
                        <trix-editor input="detail_perbaikan" class="input"></trix-editor>
                    </div>


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
                                    href="#"> ketentuan yang berlaku</a>.</label> <br>
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


<!-- Modal sdm -->
<div class="modal fade" id="modalSdm" tabindex="-1" role="dialog" aria-labelledby="modalSdmLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSdmLabel">Lanjutkan Data ke SDM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="SdmForm" action="" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="catatan">Catatan :</label>
                        <textarea class="form-control input" id="catatan" name="catatan" required></textarea>
                    </div>
                    <input type="hidden" name="encryptedId" id="encryptedId" value="">
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck5"
                                required>
                            <label class="custom-control-label" for="exampleCheck5">Saya setuju dengan<a
                                    href="#"> ketentuan yang berlaku</a>.</label> <br>
                            <label class="text-danger"><i>Coution: </i> Pastikan bahwa Anda telah yakin untuk
                                melakukan aksi ini!</label>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan Kirim Ke SDM!</button>
                </div>
            </form>
        </div>
    </div>
</div>
