@extends('partial.main')
@section('konten')
    <style>
        label {
            font-size: 14px;
            font-weight: normal !important;
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


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="m-0" style="letter-spacing: 2px;">
                                    <b>{{ $title }}</b>
                                </h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                    <li class="breadcrumb-item active">{{ $title }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Konten start --}}
        <section class="content">
            <div class="container-fluid">
                <div class="card card-outline card-primary">
                    <form
                        action="{{ $tipe == 'create' ? route('penyelesaian.store') : route('penyelesaian.update', base64_encode($penyelesaian->id)) }}"
                        enctype="multipart/form-data" method="POST" id="quickForm">
                        @csrf
                        @if ($tipe != 'create')
                            @method('patch')
                        @endif
                        <div class="card-body">
                            <i><strong>DATA DEBITUR</strong></i>
                            <hr>
                            <div class="row ml-2 mb-2">
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="kode_form_surtug">Kode Form Terkait</label>
                                        <input type="text" name="kode_form_surtug" id="kode_form_surtug"
                                            class="form-control form-control-sm input" list="kode_datalist"
                                            value="{{ $penyelesaian->kode_form_surtug ?? null }}" required>
                                        <datalist id="kode_datalist"></datalist>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama"
                                            class="form-control form-control-sm input" list="nama_datalist"
                                            value="{{ $penyelesaian->nama ?? null }}" required>
                                        <datalist id="nama_datalist"></datalist>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="norek">Nomor Rekening</label>
                                        <input type="text" class="form-control form-control-sm input" required
                                            id="norek" name="norek" value="{{ $penyelesaian->norek ?? null }}">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="plafond">Plafond</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="plafond" name="plafond"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->plafond, 0, ',', '.') ?? null }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="bakidebet">Baki Debet</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="bakidebet" name="bakidebet"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->bakidebet, 0, ',', '.') ?? null }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="tunggakan_pokok">Tunggakan Pokok</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="tunggakan_pokok" name="tunggakan_pokok"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->tunggakan_pokok, 0, ',', '.') ?? null }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="tunggakan_bunga">Tunggakan Bunga</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="tunggakan_bunga" name="tunggakan_bunga"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->tunggakan_bunga, 0, ',', '.') ?? null }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="denda">Denda</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="denda" name="denda"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->denda, 0, ',', '.') ?? null }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jns_pinjaman">Jenis Pinjaman</label>
                                        <select class="form-select form-select-sm input" name="jns_pinjaman"
                                            id="jns_pinjaman" required>
                                            <option selected disabled>-Pilih-</option>
                                            <option value="Angsuran"
                                                {{ optional($penyelesaian)->jns_pinjaman == 'Angsuran' ? 'selected' : null }}>
                                                Angsuran</option>
                                            <option value="Berjangka"
                                                {{ optional($penyelesaian)->jns_pinjaman == 'Berjangka' ? 'selected' : null }}>
                                                Berjangka</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="kolek">Kolek</label>
                                        <input type="text" class="form-control form-control-sm input" id="kolek"
                                            name="kolek" required list="kolek_list"
                                            value="{{ $penyelesaian->kolek ?? null }}">
                                        <datalist id="kolek_list">
                                            <option value="DPK">DPK</option>
                                            <option value="KL">KL</option>
                                            <option value="D">D</option>
                                            <option value="M">M</option>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pemutus_kredit">Pemutus Kredit</label>
                                        <select class="form-select form-select-sm input" name="pemutus_kredit"
                                            id="pemutus_kredit" required>
                                            <option selected disabled>-Pilih-</option>
                                            <option value="Cabang"
                                                {{ optional($penyelesaian)->pemutus_kredit == 'Cabang' ? 'selected' : null }}>
                                                Cabang</option>
                                            <option value="Area"
                                                {{ optional($penyelesaian)->pemutus_kredit == 'Area' ? 'selected' : null }}>
                                                Area</option>
                                            <option value="Pusat"
                                                {{ optional($penyelesaian)->pemutus_kredit == 'Pusat' ? 'selected' : null }}>
                                                Pusat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <i><strong>PERHITUNGAN INSENTIF</strong></i>
                            <hr>
                            <div class="row ml-2 mb-2">
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="nominal_dibayar">Nominal Dibayar</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="nominal_dibayar" name="nominal_dibayar"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->nominal_dibayar, 0, ',', '.') ?? null }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="biaya_pihak_ketiga">Biaya Pihak Ketiga</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="biaya_pihak_ketiga" name="biaya_pihak_ketiga"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->biaya_pihak_ketiga, 0, ',', '.') ?? null }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dpi_opsi">Dasar Perhitungan Insentif (Opsi)</label>
                                        <select class="form-select form-select-sm input" name="dpi_opsi" id="dpi_opsi"
                                            required>
                                            <option selected disabled>-Pilih-</option>
                                            <option value="Diragukan & Macet"
                                                {{ optional($penyelesaian)->dpi_opsi == 'Diragukan & Macet' ? 'selected' : null }}>
                                                Diragukan & Macet</option>
                                            <option value="Hapus Buku"
                                                {{ optional($penyelesaian)->dpi_opsi == 'Hapus Buku' ? 'selected' : null }}>
                                                Hapus Buku</option>
                                            <option value="AYDA"
                                                {{ optional($penyelesaian)->dpi_opsi == 'AYDA' ? 'selected' : null }}>
                                                AYDA</option>
                                            <option value="Kolektibilitas M (dengan kasus khusus)"
                                                {{ optional($penyelesaian)->dpi_opsi == 'Kolektibilitas M (dengan kasus khusus)' ? 'selected' : null }}>
                                                Kolektibilitas M (dengan kasus khusus)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="dpi_persen">Dasar Perhitungan Insentif
                                            (persentase)</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="dpi_persen" name="dpi_persen"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->dpi_persen, 0, ',', '.') ?? null }}"
                                                required>
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="dpi">Dasar Perhitungan Insentif (Nominal)</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="dpi" name="dpi"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->dpi, 0, ',', '.') ?? null }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label class="wajib" for="nominal_insentif">Nominal Insentif</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="nominal_insentif" name="nominal_insentif"
                                                value="{{ $penyelesaian == null ? null : number_format($penyelesaian->nominal_insentif, 0, ',', '.') ?? null }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <i><strong>KOMPOSISI PEMBAGIAN</strong></i>
                            <hr>
                            <div class="row ml-2 mb-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="komposisi_insentif">Komposisi Insentif</label>
                                        <select class="form-select form-select-sm input" name="komposisi_insentif"
                                            id="komposisi_insentif" required>
                                            <option selected disabled>-Pilih-</option>
                                            <option value="Cabang"
                                                {{ optional($penyelesaian)->komposisi_insentif == 'Cabang' ? 'selected' : null }}>
                                                Cabang</option>
                                            <option value="Remedial"
                                                {{ optional($penyelesaian)->komposisi_insentif == 'Remedial' ? 'selected' : null }}>
                                                Remedial</option>
                                            <option value="Remedial Debitur Prioritas"
                                                {{ optional($penyelesaian)->komposisi_insentif == 'Remedial Debitur Prioritas' ? 'selected' : null }}>
                                                Remedial Debitur Prioritas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-sm table-bordered table-hover table-responsive-md">
                                        <thead style="text-align: center">
                                            <tr>
                                                <th colspan="7">KOMPOSISI PEMBAGIAN</th>
                                            </tr>
                                            <tr>
                                                <th style="width: 5%">#</th>
                                                <th style="width: 25%">NAMA PETUGAS</th>
                                                <th style="width: 15%">NIK</th>
                                                <th style="width: 20%">JABATAN</th>
                                                <th style="width: 10%">%</th>
                                                <th style="width: 25%">NOMINAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($pembagian != null && $pembagian->isNotEmpty())
                                                @foreach ($pembagian as $item)
                                                    <tr>
                                                        <td>
                                                            {{ $loop->iteration }}
                                                            <input type="hidden"
                                                                name="id_pembagian_{{ $loop->iteration }}"
                                                                id="id_pembagian_{{ $loop->iteration }}"
                                                                value="{{ base64_encode($item->id) }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input"
                                                                id="nama_{{ $loop->iteration }}"
                                                                name="nama_{{ $loop->iteration }}"
                                                                value="{{ $item->nama }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input"
                                                                id="nik_{{ $loop->iteration }}"
                                                                name="nik_{{ $loop->iteration }}"
                                                                value="{{ $item->nik }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input"
                                                                id="jabatan_{{ $loop->iteration }}"
                                                                name="jabatan_{{ $loop->iteration }}" required
                                                                list="jabatan_list_{{ $loop->iteration }}"
                                                                value="{{ $item->jabatan }}">
                                                            <datalist id="jabatan_list_{{ $loop->iteration }}">
                                                                <option value="Pjs Kasi Operasional">Pjs Kasi Operasional
                                                                </option>
                                                                <option value="Pjs Kasi Komersial">Pjs Kasi Komersial
                                                                </option>
                                                                <option value="Pjs Pimpinan Cabang">Pjs Pimpinan Cabang
                                                                </option>
                                                                <option value="Kasi Operasional">Kasi Operasional</option>
                                                                <option value="Kasi Komersial">Kasi Komersial</option>
                                                                <option value="Pimpinan Cabang">Pimpinan Cabang</option>
                                                                <option value="Remedial">Remedial</option>
                                                                <option value="Legal Pusat">Legal Pusat</option>
                                                            </datalist>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input setRp"
                                                                id="persen_{{ $loop->iteration }}"
                                                                name="persen_{{ $loop->iteration }}" required
                                                                value="{{ $item->persen }}">
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-text">Rp.</span>
                                                                <input type="text"
                                                                    class="form-control form-control-sm input setRp"
                                                                    id="nominal_{{ $loop->iteration }}"
                                                                    name="nominal_{{ $loop->iteration }}"
                                                                    value="{{ number_format($item->nominal, 0, ',', '.') }}"
                                                                    required>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @for ($i = 1; $i <= 4; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input"
                                                                id="nama_{{ $i }}"
                                                                name="nama_{{ $i }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input"
                                                                id="nik_{{ $i }}"
                                                                name="nik_{{ $i }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input"
                                                                id="jabatan_{{ $i }}"
                                                                name="jabatan_{{ $i }}" required
                                                                list="jabatan_list_{{ $i }}">
                                                            <datalist id="jabatan_list_{{ $i }}">
                                                                <option value="Pjs Kasi Operasional">Pjs Kasi Operasional
                                                                </option>
                                                                <option value="Pjs Kasi Komersial">Pjs Kasi Komersial
                                                                </option>
                                                                <option value="Pjs Pimpinan Cabang">Pjs Pimpinan Cabang
                                                                </option>
                                                                <option value="Kasi Operasional">Kasi Operasional</option>
                                                                <option value="Kasi Komersial">Kasi Komersial</option>
                                                                <option value="Pimpinan Cabang">Pimpinan Cabang</option>
                                                                <option value="Remedial">Remedial</option>
                                                                <option value="Legal Pusat">Legal Pusat</option>
                                                            </datalist>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input setRp"
                                                                id="persen_{{ $i }}"
                                                                name="persen_{{ $i }}" required>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-text">Rp.</span>
                                                                <input type="text"
                                                                    class="form-control form-control-sm input setRp"
                                                                    id="nominal_{{ $i }}"
                                                                    name="nominal_{{ $i }}" required>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="simpan" type="button" class="btn btn-primary" style="letter-spacing: 2px;">
                                <i class="fa-regular fa-floppy-disk"></i> &nbsp; <b>SIMPAN</b></button>
                            <a href="{{ route('surtug.index') }}" type="button" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                    <div class="card card-outline card-danger mb-0"></div>
                </div>
            </div>
        </section>
        {{-- Konten End --}}

    </div>

@section('script')
    <script src="{{ asset('insentif_js/rupiah.js') }}"></script>
    <script src="{{ asset('insentif_js/penyelesaian_input.js') }}"></script>
    <script src="{{ asset('insentif_js/confirm-submit.js') }}"></script>
    <script>
        $(function() {
            // Event listener untuk semua elemen dengan class .input
            $(document).on("change keyup", ".wajib", function() {
                var value = $(this).val();

                if (value && value.toString().trim() !== "") {
                    // Ada value → hijau
                    $(this).addClass("border-success").removeClass("border-danger");
                } else {
                    // Kosong → merah
                    $(this).addClass("border-danger").removeClass("border-success");
                }
            });
        })
    </script>
@endsection
@endsection
