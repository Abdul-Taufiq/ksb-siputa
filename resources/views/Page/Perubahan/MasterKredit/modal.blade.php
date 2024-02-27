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

    label:has(+ input[])::after {
        content: "  *";
        color: red;
        font-style: italic;
    }

    label:has(+ select[])::after {
        content: "  *";
        color: red;
        font-style: italic;
    }

    label:has(+ textarea[])::after {
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
        <form id="quickForm" action="{{ url('perubahan-kredit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add" style="letter-spacing: 2px; font-weight: bold;">
                        Tambah Pengajuan Perubahan Master Kredit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="wajib" for="jns_kredit">Jenis Transaksi Kredit :</label>
                                        <select name="jns_kredit" id="jns_kredit" autocomplete="off"
                                            class="form-control input">
                                            <option value="" disabled selected>- Pilih Jenis Transaksi Kredit -
                                            </option>
                                            <option value="Cara Angsur"
                                                {{ old('jns_kredit') == 'Cara Angsur' ? 'selected' : null }}>
                                                Cara Angsur</option>
                                            <option value="Data Agunan"
                                                {{ old('jns_kredit') == 'Data Agunan' ? 'selected' : null }}>
                                                Data Agunan</option>
                                            <option value="Lainnya"
                                                {{ old('jns_kredit') == 'Lainnya' ? 'selected' : null }}>
                                                Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none" id="keterangan_jns_kredit_head">
                                    <div class="form-group">
                                        <label class="wajib" for="keterangan_jns_kredit">Keterangan Jenis Kredit
                                            :</label>
                                        <input type="text" name="keterangan_jns_kredit" id="keterangan_jns_kredit"
                                            class="form-control input" placeholder="Keterangan Jenis Kredit">
                                    </div>
                                </div>
                                <div class="col-md-6 d-none" id="id_agunan_head">
                                    <div class="form-group">
                                        <label class="wajib" for="id_agunan">ID Agunan :</label>
                                        <input type="text" name="id_agunan" id="id_agunan" class="form-control input"
                                            placeholder="ID Agunan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="wajib" for="no_rek">Nomor Rekening :</label>
                                        <input type="text" name="no_rek" id="no_rek" class="form-control input"
                                            placeholder="Nomor Rekening">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="wajib" for="nama">Nama Nasabah :</label>
                                        <input type="text" name="nama" id="nama" class="form-control input"
                                            placeholder="Nama Nasabah">
                                    </div>
                                </div>

                                <div class="row d-none" id="selain_agunan">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="data_salah">Data Salah :</label>
                                            <input type="text" name="data_salah" id="data_salah"
                                                class="form-control input" placeholder="Data Salah">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="pembetulan">Data Pembetulan :</label>
                                            <input type="text" name="pembetulan" id="pembetulan"
                                                class="form-control input" placeholder="Data Pembetulan">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>


                                <div class="row d-none" id="data_agunan">
                                    <div class="col-md-12">
                                        <hr>
                                        <h5>Data Salah</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_agunan">Data Salah (Jenis Agunan) :</label>
                                            <input type="text" name="jns_agunan" id="jns_agunan"
                                                class="form-control input" placeholder="Data Salah (Jenis Agunan)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_perikatan">Data Salah (Jenis Perikatan)
                                                :</label>
                                            <input type="text" name="jns_perikatan" id="jns_perikatan"
                                                class="form-control input" placeholder="Data Salah (Jenis Perikatan)">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <h5>Data Pembetulan</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_agunan_p">Data Pembetulan (Jenis Agunan)
                                                :</label>
                                            <input type="text" name="jns_agunan_p" id="jns_agunan_p"
                                                class="form-control input"
                                                placeholder="Data Pembetulan (Jenis Agunan)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_perikatan_p">Data Pembetulan (Jenis
                                                Perikatan) :</label>
                                            <input type="text" name="jns_perikatan_p" id="jns_perikatan_p"
                                                class="form-control input"
                                                placeholder="Data Pembetulan (Jenis Perikatan)">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>


                                <div class="col-md-6" id="user_head">
                                    <div class="form-group">
                                        <label class="wajib" for="user">User :</label>
                                        <input type="text" name="user" id="user"
                                            class="form-control input" placeholder="User Pelaku">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="wajib" for="alasan">Alasan Pembetulan :</label>
                                        <input type="text" name="alasan" id="alasan"
                                            class="form-control input" placeholder="Alasan Pembetulan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="wajib" for="keterangan">Keterangan :</label>
                                        <textarea class="form-control input" name="keterangan" id="keterangan" cols="30" rows="3"
                                            placeholder="Keterangan"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" required name="terms" class="custom-control-input"
                                        id="exampleCheck1">
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
                        Tambah Pengajuan Perubahan Master Kredit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="wajib" for="jns_kredit">Jenis Transaksi Kredit :</label>
                                        <select name="jns_kredit" id="jns_kredit_edit" autocomplete="off"
                                            class="form-control input">
                                            <option value="" disabled selected>- Pilih Jenis Transaksi Kredit -
                                            </option>
                                            <option value="Cara Angsur"
                                                {{ old('jns_kredit') == 'Cara Angsur' ? 'selected' : null }}>
                                                Cara Angsur</option>
                                            <option value="Data Agunan"
                                                {{ old('jns_kredit') == 'Data Agunan' ? 'selected' : null }}>
                                                Data Agunan</option>
                                            <option value="Lainnya"
                                                {{ old('jns_kredit') == 'Lainnya' ? 'selected' : null }}>
                                                Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none" id="keterangan_jns_kredit_edit_head">
                                    <div class="form-group">
                                        <label class="wajib" for="keterangan_jns_kredit">Keterangan Jenis Kredit
                                            :</label>
                                        <input type="text" name="keterangan_jns_kredit"
                                            id="keterangan_jns_kredit_edit" class="form-control input"
                                            placeholder="Keterangan Jenis Kredit">
                                    </div>
                                </div>
                                <div class="col-md-6 d-none" id="id_agunan_edit_head">
                                    <div class="form-group">
                                        <label class="wajib" for="id_agunan">ID Agunan :</label>
                                        <input type="text" name="id_agunan" id="id_agunan_edit"
                                            class="form-control input" placeholder="ID Agunan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="wajib" for="no_rek">Nomor Rekening :</label>
                                        <input type="text" name="no_rek" id="no_rek_edit"
                                            class="form-control input" placeholder="Nomor Rekening">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="wajib" for="nama">Nama Nasabah :</label>
                                        <input type="text" name="nama" id="nama_edit"
                                            class="form-control input" placeholder="Nama Nasabah">
                                    </div>
                                </div>

                                <div class="row d-none" id="selain_agunan_edit">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="data_salah">Data Salah :</label>
                                            <input type="text" name="data_salah" id="data_salah_edit"
                                                class="form-control input_khusus" placeholder="Data Salah">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="pembetulan">Data Pembetulan :</label>
                                            <input type="text" name="pembetulan" id="pembetulan_edit"
                                                class="form-control input_khusus" placeholder="Data Pembetulan">
                                        </div>
                                    </div>
                                </div>


                                <div class="row d-none" id="data_agunan_edit">
                                    <div class="col-md-12">
                                        <hr>
                                        <h5>Data Salah</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_agunan">Data Salah (Jenis Agunan) :</label>
                                            <input type="text" name="jns_agunan" id="jns_agunan"
                                                class="form-control input_khusus"
                                                placeholder="Data Salah (Jenis Agunan)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_perikatan">Data Salah (Jenis Perikatan)
                                                :</label>
                                            <input type="text" name="jns_perikatan" id="jns_perikatan"
                                                class="form-control input_khusus"
                                                placeholder="Data Salah (Jenis Perikatan)">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <h5>Data Pembetulan</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_agunan">Data Pembetulan (Jenis Agunan)
                                                :</label>
                                            <input type="text" name="jns_agunan" id="jns_agunan"
                                                class="form-control input_khusus"
                                                placeholder="Data Pembetulan (Jenis Agunan)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="wajib" for="jns_perikatan">Data Pembetulan (Jenis
                                                Perikatan) :</label>
                                            <input type="text" name="jns_perikatan" id="jns_perikatan"
                                                class="form-control input_khusus"
                                                placeholder="Data Pembetulan (Jenis Perikatan)">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>


                                <div class="col-md-6" id="user_head">
                                    <div class="form-group">
                                        <label class="wajib" for="user">User :</label>
                                        <input type="text" name="user" id="user_edit"
                                            class="form-control input" placeholder="User Pelaku">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="wajib" for="alasan">Alasan Pembetulan :</label>
                                        <input type="text" name="alasan" id="alasan_edit"
                                            class="form-control input" placeholder="Alasan Pembetulan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="wajib" for="keterangan">Keterangan :</label>
                                        <textarea class="form-control input" name="keterangan" id="keterangan_edit" cols="30" rows="3"
                                            placeholder="Keterangan"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" required name="terms" class="custom-control-input"
                                        id="exampleCheck2">
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
                    @if ($jabatan == 'Pembukuan' || $jabatan == 'Direktur Operasional' || $jabatan == 'TSI')
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
                        <label class="wajib" for="catatan">Catatan Reject:</label>
                        <textarea class="form-control input" id="catatan" name="catatan"></textarea>
                    </div>
                    <input type="hidden" name="encryptedId" id="encryptedId" value="">
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" required name="terms" class="custom-control-input"
                                id="exampleCheck3">
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
                    @if ($jabatan == 'Pembukuan' || $jabatan == 'Direktur Operasional' || $jabatan == 'TSI')
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
                        <label class="wajib" for="catatan">Catatan Approve:</label>
                        <textarea class="form-control input" id="catatan" name="catatan"></textarea>
                    </div>
                    <input type="hidden" name="encryptedId" id="encryptedId" value="">
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" required name="terms" class="custom-control-input"
                                id="exampleCheck4">
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
