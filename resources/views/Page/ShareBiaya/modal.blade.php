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
        <form id="quickForm" action="{{ url('share-biaya') }}" method="post" enctype="multipart/form-data">
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
                                        <label for="kc">Kantor Cabang :</label>
                                        <select name="kc" id="kc" autocomplete="off" required
                                            class="form-control input">
                                            <option disabled selected>- Pilih Kantor Cabang -</option>
                                            <option value="All Cabang">All Cabang</option>
                                            <option value="AREA 1">AREA 1</option>
                                            <option value="AREA 2">AREA 2</option>
                                            <option value="AREA 3">AREA 3</option>
                                            <option value="KPO">Kantor Pusat Operasional</option>
                                            <option value="KC Temanggung">KC Temanggung</option>
                                            <option value="KC Wonosobo">KC Wonosobo</option>
                                            <option value="KC Ambarawa">KC Ambarawa</option>
                                            <option value="KC Semarang">KC Semarang</option>
                                            <option value="KC Mranggen">KC Mranggen</option>
                                            <option value="KC Sukorejo">KC Sukorejo</option>
                                            <option value="KC Weleri">KC Weleri</option>
                                            <option value="KC Delanggu">KC Delanggu</option>
                                            <option value="KC Gombong">KC Gombong</option>
                                            <option value="KC Sokaraja">KC Sokaraja</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_transaksi">Tgl Transaksi :</label>
                                        <input type="date" name="tgl_transaksi" id="tgl_transaksi" required
                                            class="form-control input" placeholder="Tgl Transaksi">
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
                                        <label for="file_lampiran">Lampiran File : <i
                                                style="color: grey">Opsional</i></label>
                                        <input type="file" name="file_lampiran" id="file_lampiran"
                                            class="form-control input" placeholder="file_lampiran"
                                            accept="application/pdf">
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
                        Tambah {{ $title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <h6>Data Yang Lama</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-striped table-sm">
                                        <tr>
                                            <th>Kantor Cabang</th>
                                            <td id="kc_info"></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Transaksi</th>
                                            <td id="tgl_transaksi_info"></td>
                                        </tr>
                                        <tr>
                                            <th>Nominal</th>
                                            <td id="nominal_info"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-striped table-sm">
                                        <tr>
                                            <th>Lampiran File</th>
                                            <td id="lampiran_file_info"></td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td id="keterangan_info"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card card-outline card-primary mb-0"></div>
                    </div>


                    <div class="card card-outline card-warning">
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kc">Kantor Cabang :</label>
                                        <select name="kc" id="kc" autocomplete="off"
                                            class="form-control input">
                                            <option disabled selected>- Pilih Kantor Cabang -</option>
                                            <option value="All Cabang">All Cabang</option>
                                            <option value="AREA 1">AREA 1</option>
                                            <option value="AREA 2">AREA 2</option>
                                            <option value="AREA 3">AREA 3</option>
                                            <option value="KPO">Kantor Pusat Operasional</option>
                                            <option value="KC Temanggung">KC Temanggung</option>
                                            <option value="KC Wonosobo">KC Wonosobo</option>
                                            <option value="KC Ambarawa">KC Ambarawa</option>
                                            <option value="KC Semarang">KC Semarang</option>
                                            <option value="KC Mranggen">KC Mranggen</option>
                                            <option value="KC Sukorejo">KC Sukorejo</option>
                                            <option value="KC Weleri">KC Weleri</option>
                                            <option value="KC Delanggu">KC Delanggu</option>
                                            <option value="KC Gombong">KC Gombong</option>
                                            <option value="KC Sokaraja">KC Sokaraja</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_transaksi">Tgl Transaksi :</label>
                                        <input type="date" name="tgl_transaksi" id="tgl_transaksi"
                                            class="form-control input" placeholder="Tgl Transaksi">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nominal">Nominal :</label>
                                        <input type="text" name="nominal" id="nominal_edit"
                                            class="form-control input" placeholder="Nominal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file_lampiran">Lampiran File :</label>
                                        <input type="file" name="file_lampiran" id="file_lampiran"
                                            class="form-control input" placeholder="file_lampiran">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan :</label>
                                        <textarea class="form-control input" name="keterangan" id="keterangan" cols="30" rows="3"
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
                        <div class="card card-outline card-warning mb-0"></div>
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
