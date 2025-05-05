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
        <form id="quickForm" action="{{ url('pengajuan-lainnya') }}" method="post" enctype="multipart/form-data">
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
                                        <label for="jns_pengajuan" class="wajib">Jenis Pengajuan :</label>
                                        <select name="jns_pengajuan" id="jns_pengajuan" autocomplete="off"
                                            class="form-control input">
                                            <option disabled selected hidden>- Pilih Jenis Pengajuan -
                                            </option>
                                            <option value="Renovasi"
                                                {{ old('jns_pengajuan') == 'Renovasi' ? 'selected' : null }}>
                                                Renovasi</option>
                                            <option value="Upgrade Bandwidth WIFI"
                                                {{ old('jns_pengajuan') == 'Upgrade Bandwidth WIFI' ? 'selected' : null }}>
                                                Upgrade Bandwidth WIFI</option>
                                            <option value="Ganti Provider WIFI"
                                                {{ old('jns_pengajuan') == 'Ganti Provider WIFI' ? 'selected' : null }}>
                                                Ganti Provider WIFI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file_pendukung">File Pendukung (PDF) : opsional</label>
                                        <input type="file" name="file_pendukung" id="file_pendukung"
                                            class="form-control " accept="application/pdf">
                                    </div>
                                </div>
                            </div>

                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail_kerusakan" class="wajib">Detail Keadaan/kerusakan/lainnya
                                            :</label>
                                        <textarea class="summernote" name="detail_kerusakan" id="detail_kerusakan" cols="20" rows="7"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail_diharapkan" class="wajib">Detail Diharapkan/termasuk biaya
                                            jika ada
                                            :</label>
                                        <textarea class="summernote" name="detail_diharapkan" id="detail_diharapkan" cols="20" rows="7"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="keterangan" class="wajib">Keterangan Lainnya :</label>
                                        <textarea class="summernote" name="keterangan" id="keterangan" cols="20" rows="7"></textarea>
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
                {{-- <button class="btn btn-primary btnPrint" type="button">
                    <i class="fa fa-print" aria-hidden="true"></i> &nbsp;
                    Cetak
                </button> --}}
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
<input hidden id="jabatan" value="{{ $jabatan = auth()->user()->jabatan }}">
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
