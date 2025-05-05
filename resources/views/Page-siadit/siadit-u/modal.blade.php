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

    .wajib::after {
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
        <form id="quickForm" action="{{ url('user-siadit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add" style="letter-spacing: 2px; font-weight: bold;">
                        Tambah Pengajuan User Si-Adit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keperluan">Keperluan :</label>
                                        <select name="keperluan" id="keperluan" autocomplete="off" required
                                            class="form-control input">
                                            <option disabled selected hidden>- Pilih Keperluan -</option>
                                            <option value="Pengajuan User Baru"
                                                {{ old('keperluan') == 'Pengajuan User Baru' ? 'selected' : null }}>
                                                Pengajuan User Baru
                                            </option>
                                            <option value="Alternate User"
                                                {{ old('keperluan') == 'Alternate User' ? 'selected' : null }}>
                                                Alternate User
                                            </option>
                                            <option value="Penghapusan User"
                                                {{ old('keperluan') == 'Penghapusan User' ? 'selected' : null }}>
                                                Penghapusan User
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK (Nomor Induk Karyawan) :</label>
                                        <input type="text" name="nik" id="nik" required
                                            onkeypress="return hanyaAngka(event)" class="form-control input"
                                            placeholder="NIK (Nomor Induk Karyawan)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Karyawan :</label>
                                        <input type="text" name="nama" id="nama" class="form-control input"
                                            placeholder="Nama Karyawan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan Karyawan :</label>
                                        @if (auth()->user()->jabatan == 'SDM')
                                            <input type="text" name="jabatan" id="jabatan"
                                                class="form-control input" placeholder="Jabatan Karyawan" required>
                                        @else
                                            <select name="jabatan" id="jabatan" class="form-control input" required>
                                                <option disabled selected>-Pilih Jabatan-</option>
                                                <option value="AO Landing">AO Landing</option>
                                                <option value="AO Funding">AO Funding</option>
                                                <option value="Analis Cabang">Analis Cabang</option>
                                                <option value="Admin Tabdep">Admin Tabdep</option>
                                                <option value="Remedial Cabang">Remedial Cabang</option>
                                                <option value="Kasir">Kasir</option>
                                                <option value="Legal (Adm Kredit)">Legal (Adm Kredit)</option>
                                                <option value="Kasi Operasional">Kasi Operasional</option>
                                                <option value="Kasi Komersial">Kasi Komersial</option>
                                                <option value="Pimpinan Cabang">Pimpinan Cabang</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_telp">No Telp/WhatsApp :</label>
                                        <input type="text" name="no_telp" id="no_telp" class="form-control input"
                                            onkeypress="return hanyaAngka(event)"
                                            placeholder="Diawali 62 bukan 0, cth: 085... jadi 6285..." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan :</label>
                                        <textarea class="form-control input" name="keterangan" id="keterangan" cols="30" rows="3" required
                                            placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                                {{-- Trigger --}}
                                <div class="col-md-6 d-none" id="kategori_head">
                                    <div class="form-group">
                                        <label for="kategori">Kategori Masa Aktif:</label>
                                        <select name="kategori" id="kategori" autocomplete="off" required
                                            class="form-control input">
                                            <option disabled selected hidden>- Pilih Kategori -</option>
                                            <option value="Yes"
                                                {{ old('kategori') == 'Masa Aktif Diketahui' ? 'selected' : null }}>
                                                Masa Aktif Diketahui
                                            </option>
                                            <option value="No"
                                                {{ old('kategori') == 'Masa Aktif Tidak Diketahui' ? 'selected' : null }}>
                                                Masa Aktif Tidak Diketahui
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    &nbsp;
                                </div>
                            </div>
                            {{-- optional --}}
                            <div class="row ml-2 d-none" id="awal_akhir">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="aktif" class="wajib">Masa Aktif Awal :</label>
                                        <input type="date" name="aktif" id="aktif"
                                            class="form-control input" placeholder="Masa Aktif Awal">
                                    </div>
                                </div>
                                <div class="col-md-6" id="akhir">
                                    <div class="form-group">
                                        <label for="non_aktif" class="wajib">Masa Aktif Akhir :</label>
                                        <input type="date" name="non_aktif" id="non_aktif"
                                            class="form-control input" placeholder="Masa Aktif Akhir">
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
                        Tambah Pengajuan Email
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keperluan">Keperluan :</label>
                                        <select name="keperluan" id="keperluan_edit" autocomplete="off" required
                                            class="form-control input">
                                            <option disabled selected hidden>- Pilih Keperluan -</option>
                                            <option value="Pengajuan User Baru"
                                                {{ old('keperluan') == 'Pengajuan User Baru' ? 'selected' : null }}>
                                                Pengajuan User Baru
                                            </option>
                                            <option value="Alternate User"
                                                {{ old('keperluan') == 'Alternate User' ? 'selected' : null }}>
                                                Alternate User
                                            </option>
                                            <option value="Penghapusan User"
                                                {{ old('keperluan') == 'Penghapusan User' ? 'selected' : null }}>
                                                Penghapusan User
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK (Nomor Induk Karyawan) :</label>
                                        <input type="text" name="nik" id="nik_edit" required
                                            onkeypress="return hanyaAngka(event)" class="form-control input"
                                            placeholder="NIK (Nomor Induk Karyawan)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Karyawan :</label>
                                        <input type="text" name="nama" id="nama_edit"
                                            class="form-control input" placeholder="Nama Karyawan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan Karyawan :</label>
                                        @if (auth()->user()->jabatan == 'SDM')
                                            <input type="text" name="jabatan" id="jabatan_edit"
                                                class="form-control input" placeholder="Jabatan Karyawan" required>
                                        @else
                                            <select name="jabatan" id="jabatan_edit" class="form-control input"
                                                required>
                                                <option disabled selected>-Pilih Jabatan-</option>
                                                <option value="AO Landing">AO Landing</option>
                                                <option value="AO Funding">AO Funding</option>
                                                <option value="Analis Cabang">Analis Cabang</option>
                                                <option value="Admin Tabdep">Admin Tabdep</option>
                                                <option value="Remedial Cabang">Remedial Cabang</option>
                                                <option value="Kasir">Kasir</option>
                                                <option value="Legal (Adm Kredit)">Legal (Adm Kredit)</option>
                                                <option value="Kasi Operasional">Kasi Operasional</option>
                                                <option value="Kasi Komersial">Kasi Komersial</option>
                                                <option value="Pimpinan Cabang">Pimpinan Cabang</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_telp">No Telp/WhatsApp :</label>
                                        <input type="text" name="no_telp" id="no_telp_edit"
                                            class="form-control input" onkeypress="return hanyaAngka(event)"
                                            placeholder="Diawali 62 bukan 0, cth: 085... jadi 6285..." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan :</label>
                                        <textarea class="form-control input" name="keterangan" id="keterangan_edit" cols="30" rows="3" required
                                            placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                                {{-- Trigger --}}
                                <div class="col-md-6 d-none" id="kategori_head_edit">
                                    <div class="form-group">
                                        <label for="kategori">Kategori Masa Aktif:</label>
                                        <select name="kategori" id="kategori_edit" autocomplete="off" required
                                            class="form-control input">
                                            <option disabled selected hidden>- Pilih Kategori -</option>
                                            <option value="Yes"
                                                {{ old('kategori') == 'Masa Aktif Diketahui' ? 'selected' : null }}>
                                                Masa Aktif Diketahui
                                            </option>
                                            <option value="No"
                                                {{ old('kategori') == 'Masa Aktif Tidak Diketahui' ? 'selected' : null }}>
                                                Masa Aktif Tidak Diketahui
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    &nbsp;
                                </div>
                            </div>
                            {{-- optional --}}
                            <div class="row ml-2 d-none" id="awal_akhir_edit">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="aktif" class="wajib">Masa Aktif Awal :</label>
                                        <input type="date" name="aktif" id="aktif_edit"
                                            class="form-control input" placeholder="Masa Aktif Awal">
                                    </div>
                                </div>
                                <div class="col-md-6" id="akhir">
                                    <div class="form-group">
                                        <label for="non_aktif" class="wajib">Masa Aktif Akhir :</label>
                                        <input type="date" name="non_aktif" id="non_aktif_edit"
                                            class="form-control input" placeholder="Masa Aktif Akhir">
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
