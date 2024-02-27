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



{{-- modal add --}}
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="quickForm" action="{{ url('pembatalan-deposito') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add" style="letter-spacing: 2px; font-weight: bold;">
                        Tambah Pengajuan Pembatalan Transaksi Deposito
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_transaksi">ID Transaksi :</label>
                                        <input type="text" name="id_transaksi" id="id_transaksi" required
                                            class="form-control input" placeholder="ID Transaksi">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_rek">No Rekening :</label>
                                        <input type="text" name="no_rek" id="no_rek" required
                                            class="form-control input" placeholder="No Rekening">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Atas Nama :</label>
                                        <input type="text" name="nama" id="nama" required
                                            class="form-control input" placeholder="Atas Nama">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nominal">Nominal :</label>
                                        <input type="text" name="nominal" id="nominal" class="form-control input"
                                            placeholder="Nominal" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user">User :</label>
                                        <input type="text" name="user" id="user" class="form-control input"
                                            placeholder="User Pelaku" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alasan">Alasan Kesalahan :</label>
                                        <input type="text" name="alasan" id="alasan" class="form-control input"
                                            placeholder="Alasan Kesalahan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan :</label>
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
                        Tambah Pengajuan Pembatalan Transaksi Deposito
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_transaksi">ID Transaksi :</label>
                                        <input type="text" name="id_transaksi" id="id_transaksi_edit" required
                                            class="form-control input" placeholder="ID Transaksi">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_rek">No Rekening :</label>
                                        <input type="text" name="no_rek" id="no_rek_edit" required
                                            class="form-control input" placeholder="No Rekening">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Atas Nama :</label>
                                        <input type="text" name="nama" id="nama_edit" required
                                            class="form-control input" placeholder="Atas Nama">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nominal">Nominal :</label>
                                        <input type="text" name="nominal" id="nominal_edit"
                                            class="form-control input" placeholder="Nominal" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user">User :</label>
                                        <input type="text" name="user" id="user_edit"
                                            class="form-control input" placeholder="User Pelaku" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alasan">Alasan Kesalahan :</label>
                                        <input type="text" name="alasan" id="alasan_edit"
                                            class="form-control input" placeholder="Alasan Kesalahan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan :</label>
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
<input hidden value="{{ $jabatan = auth()->user()->jabatan }}">
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
