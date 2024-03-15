@include('partial.header')
@yield('header')


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



<form id="editForm" action=" {{ url('inventaris-pengganti/' . $inventarisPengganti->id_inventaris_pengganti) }}"
    method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="card card-outline card-primary">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kategori_barang">Kategori Pengajuan inventarisPengganti :</label>
                        <select name="kategori_barang" id="kategori_barang" autocomplete="off" required
                            class="form-control input border-success">
                            <option disabled selected hidden>- Pilih Kategori Pengajuan inventarisPengganti -
                            </option>
                            <option value="Elektronik"
                                {{ $inventarisPengganti->kategori_barang == 'Elektronik' ? 'selected' : null }}>
                                Elektronik</option>
                            <option value="Kendaraan"
                                {{ $inventarisPengganti->kategori_barang == 'Kendaraan' ? 'selected' : null }}>
                                Kendaraan</option>
                            <option value="Peralatan/Perlengkapan Kantor"
                                {{ $inventarisPengganti->kategori_barang == 'Peralatan/Perlengkapan Kantor' ? 'selected' : null }}>
                                Peralatan/Perlengkapan Kantor</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jns_pembelian">Jenis Pembelian :</label>
                        <select name="jns_pembelian" id="jns_pembelian" autocomplete="off" required
                            class="form-control input border-success">
                            <option disabled selected hidden>- Pilih Jenis inventarisPengganti -
                            </option>
                            <option value="Pembelian Dengan Speksifikasi Cabang"
                                {{ $inventarisPengganti->jns_pembelian == 'Pembelian Dengan Speksifikasi Cabang' ? 'selected' : null }}>
                                Pembelian Dengan Speksifikasi Cabang</option>
                            <option value="Pembelian Dengan Speksifikasi KPM"
                                {{ $inventarisPengganti->jns_pembelian == 'Pembelian Dengan Speksifikasi KPM' ? 'selected' : null }}>
                                Pembelian Dengan Speksifikasi KPM (Khusus Elektronik)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="qty">QTY (Jumlah Barang) :</label>
                        <input type="number" name="qty" id="qty" required
                            class="form-control input border-success" placeholder="QTY"
                            value="{{ $inventarisPengganti->qty }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="catatan" class="wajib">Catatan :</label>
                        <textarea class="form-control input border-success" name="catatan" id="catatan" cols="30" rows="1" required
                            placeholder="Catatan">{{ $inventarisPengganti->catatan }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan" class="wajib">Keterangan :</label>
                        <textarea class="form-control input border-success" name="keterangan" id="keterangan" cols="30" rows="1"
                            required placeholder="Keterangan">{{ $inventarisPengganti->keterangan }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Diganti --}}
            {{-- tambahan --}}
            <div class="row ml-2">
                @foreach ($diganti as $ganti)
                    <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 200)">Data
                        Barang Yang Diganti 1
                        &#8628;</h5>
                    <hr style="width: 95%; margin-left: 5px">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_inventaris_{{ $loop->iteration }}">Kode Inventaris :</label>
                            <input type="text" name="kode_inventaris_{{ $loop->iteration }}"
                                id="kode_inventaris_{{ $loop->iteration }}" required
                                class="form-control border-danger input" placeholder="Kode Inventaris"
                                value="{{ $ganti->kode_inventaris }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nilai_buku_terakhir_{{ $loop->iteration }}">Nilai Buku Terakhir :</label>
                            <input type="text" name="nilai_buku_terakhir_{{ $loop->iteration }}"
                                id="nilai_buku_terakhir_{{ $loop->iteration }}" required
                                class="form-control border-danger input" placeholder="Nilai Buku Terakhir"
                                value="{{ $ganti->nilai_buku_terakhir }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgl_pembelian_{{ $loop->iteration }}">Tanggal Pembelian :</label>
                            <div class="input-group date" id="date_pembelian_{{ $loop->iteration }}"
                                data-target-input="nearest">
                                <input type="text" class="form-control border-danger datetimepicker-input input"
                                    data-target="#date_pembelian_{{ $loop->iteration }}"
                                    id="tgl_pembelian_{{ $loop->iteration }}"
                                    name="tgl_pembelian_{{ $loop->iteration }}" required
                                    placeholder="format : Tanggal-Bulan-Tahun, contoh: 31-12-2018"
                                    value="{{ optional($ganti->tgl_pembelian)->format('Y-m-d') }}" />
                                <div class="input-group-append" data-target="#date_pembelian_{{ $loop->iteration }}"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kondisi_terakhir_{{ $loop->iteration }}">Kondisi Terakhir :</label>
                            <input type="text" name="kondisi_terakhir_{{ $loop->iteration }}"
                                id="kondisi_terakhir_{{ $loop->iteration }}" required
                                class="form-control border-danger input" placeholder="Kondisi Terakhir"
                                value="{{ $ganti->kondisi_akhir }}">
                        </div>
                    </div>
            </div>
            @endforeach
            <div>
                <div id="tambah_barang_diganti_card"></div>
                <div class="row ml-2">
                    <input class="btn btn-outline-primary mb-4" id="tambah_barang_diganti" type="button"
                        value="(+) Tambah Barang Yang Diganti (+)">
                </div>
            </div>

            {{-- ELEKTRONIK --}}
            <input type="text" name="angka_1" id="angka_1" hidden>
            <div class="d-none" id="pembungkus_elektronik">
                {{-- tambahan --}}
                <div id="tambah_barang_pembanding_elektronik_card"></div>
                <div class="row ml-2">
                    <input class="btn btn-outline-primary mb-4" id="tambah_barang_pembanding_elektronik"
                        type="button" value="(+) Tambah Barang Pembanding Elektronik (+)">
                </div>
            </div>

            {{-- NON-ELEKRONIK --}}
            <div class="d-none" id="pembungkus_non_elektronik">
                {{-- tambahan --}}
                <div id="tambah_barang_pembanding_non_elektronik_card"></div>
                <div class="row ml-2">
                    <input class="btn btn-outline-primary mb-4" id="tambah_barang_pembanding_non_elektronik"
                        type="button" value="(+) Tambah Barang Pembanding Non-Elektronik (+)">
                </div>
            </div>


        </div>
        <div class="card-footer">
            <div class="form-group mb-0">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1" required>
                    <label class="custom-control-label" for="exampleCheck1">
                        Saya setuju dengan <a href="{{ asset('Juknis/Juknis.pdf') }}" target="_blank">ketentuan yang
                            berlaku</a>.
                    </label>
                </div>
            </div>
            <div class="form-group d-flex justify-content-end">
                <button id="simpan" type="submit" class="btn btn-primary" style="letter-spacing: 2px;">
                    <i class="fa-regular fa-floppy-disk"></i> &nbsp; <b>SIMPAN</b></button>
            </div>
        </div>
        <div class="card card-outline card-primary mb-0"></div>
    </div>
</form>



@section('script')
    <script src="{{ asset('script/inventaris_pengganti/inventaris_edit.js') }}"></script>
@endsection
@yield('footer')
@include('partial.footer')
