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



<form id="editForm" action=" {{ url('pengajuan-lainnya/' . $pLainnya->id) }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="row ml-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jns_pengajuan" class="wajib">Jenis Pengajuan :</label>
                        <select name="jns_pengajuan" id="jns_pengajuan" autocomplete="off" class="form-control input">
                            <option disabled selected hidden>- Pilih Jenis Pengajuan -
                            </option>
                            <option value="Renovasi" {{ $pLainnya->jns_pengajuan == 'Renovasi' ? 'selected' : null }}>
                                Renovasi</option>
                            <option value="Upgrade Bandwidth WIFI"
                                {{ $pLainnya->jns_pengajuan == 'Upgrade Bandwidth WIFI' ? 'selected' : null }}>
                                Upgrade Bandwidth WIFI</option>
                            <option value="Ganti Provider WIFI"
                                {{ $pLainnya->jns_pengajuan == 'Ganti Provider WIFI' ? 'selected' : null }}>
                                Ganti Provider WIFI</option>
                            <option value="Maintenance/Pembersihan"
                                {{ old('jns_pengajuan') == 'Maintenance/Pembersihan' ? 'selected' : null }}>
                                Maintenance/Pembersihan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="file_pendukung">File Pendukung (PDF) : opsional</label>
                        <input type="file" name="file_pendukung" id="file_pendukung" class="form-control "
                            accept="application/pdf">
                    </div>
                </div>
            </div>

            <div class="row ml-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="detail_kerusakan" class="wajib">Detail Keadaan/kerusakan/lainnya
                            :</label>
                        <textarea class="summernote" name="detail_kerusakan" id="detail_kerusakan" cols="20" rows="7">{!! $pLainnya->detail_kerusakan !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="row ml-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="detail_diharapkan" class="wajib">Detail Diharapkan/termasuk biaya
                            jika ada
                            :</label>
                        <textarea class="summernote" name="detail_diharapkan" id="detail_diharapkan" cols="20" rows="7">{!! $pLainnya->detail_diharapkan !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="row ml-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="keterangan" class="wajib">Keterangan Lainnya :</label>
                        <textarea class="summernote" name="keterangan" id="keterangan" cols="20" rows="7">{{ $pLainnya->keterangan }}</textarea>
                    </div>
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
    <script src="{{ asset('script/Lainnya/input.js') }}"></script>
@endsection
@yield('footer')
@include('partial.footer')
