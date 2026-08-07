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
                        action="{{ $tipe == 'create' ? route('ao.store') : route('ao.update', base64_encode($insenAo->id)) }}"
                        enctype="multipart/form-data" method="POST" id="quickForm">
                        @csrf
                        @if ($tipe != 'create')
                            @method('patch')
                        @endif
                        <div class="card-body">
                            <i><strong>DATA AO</strong></i>
                            <hr>
                            <div class="row ml-2 mb-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_ao">Nama AO</label>
                                        <input type="text" class="form-control form-control-sm input" required
                                            id="nama_ao" name="nama_ao" value="{{ $insenAo->nama_ao ?? null }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="periode">Periode</label>
                                        <input type="text" class="form-control form-control-sm input" required
                                            id="periode" name="periode" value="{{ $insenAo->periode ?? null }}"
                                            list="periode_list">
                                        <datalist id="periode_list">
                                            <option value="JANUARI {{ now()->format('Y') }}">JANUARI
                                                {{ now()->format('Y') }}</option>
                                            <option value="FEBRUARI {{ now()->format('Y') }}">FEBRUARI
                                                {{ now()->format('Y') }}</option>
                                            <option value="MARET {{ now()->format('Y') }}">MARET {{ now()->format('Y') }}
                                            </option>
                                            <option value="APRIL {{ now()->format('Y') }}">APRIL {{ now()->format('Y') }}
                                            </option>
                                            <option value="MEI {{ now()->format('Y') }}">MEI {{ now()->format('Y') }}
                                            </option>
                                            <option value="JUNI {{ now()->format('Y') }}">JUNI {{ now()->format('Y') }}
                                            </option>
                                            <option value="JULI {{ now()->format('Y') }}">JULI {{ now()->format('Y') }}
                                            </option>
                                            <option value="AGUSTUS {{ now()->format('Y') }}">AGUSTUS
                                                {{ now()->format('Y') }}</option>
                                            <option value="SEPTEMBER {{ now()->format('Y') }}">SEPTEMBER
                                                {{ now()->format('Y') }}</option>
                                            <option value="OKTOBER {{ now()->format('Y') }}">OKTOBER
                                                {{ now()->format('Y') }}</option>
                                            <option value="NOVEMBER {{ now()->format('Y') }}">NOVEMBER
                                                {{ now()->format('Y') }}</option>
                                            <option value="DESEMBER {{ now()->format('Y') }}">DESEMBER
                                                {{ now()->format('Y') }}</option>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="wajib" for="target">Target</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="target" name="target"
                                                value="{{ $insenAo == null ? null : number_format($insenAo->target, 0, ',', '.') }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <i><strong>DATA DEBITUR</strong></i>
                            <hr>
                            @if ($debca != null && $debca->isNotEmpty())
                                @foreach ($debca as $item)
                                    <div class="row ml-2" id="head_deb_{{ $loop->iteration }}">
                                        <div class="col-md-12">
                                            <strong>→ DATA DEBITUR {{ $loop->iteration }}</strong>
                                            <select name="aksi_{{ $loop->iteration }}" id="aksi_{{ $loop->iteration }}"
                                                class="form-select form-select-sm input" required>
                                                <option selected disabled>-PILIH-</option>
                                                <option value="Edit">🖊️ Edit</option>
                                                <option value="Hapus">🗑️ Hapus</option>
                                            </select>
                                            <input type="hidden" name="id_debca_{{ $loop->iteration }}"
                                                id="id_debca_{{ $loop->iteration }}"
                                                value="{{ base64_encode($item->id) }}">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tgl_realisasi_{{ $loop->iteration }}">Tanggal Realisasi</label>
                                                <input type="date" class="form-control form-control-sm input" required
                                                    id="tgl_realisasi_{{ $loop->iteration }}"
                                                    name="tgl_realisasi_{{ $loop->iteration }}"
                                                    value="{{ $item->tgl_realisasi->format('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nama_{{ $loop->iteration }}">Nama Debitur</label>
                                                <input type="text" class="form-control form-control-sm input" required
                                                    id="nama_{{ $loop->iteration }}" name="nama_{{ $loop->iteration }}"
                                                    list="nama_datalist_{{ $loop->iteration }}"
                                                    value="{{ $item->nama }}">
                                                <datalist id="nama_datalist_{{ $loop->iteration }}"></datalist>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="norek_{{ $loop->iteration }}">Norek</label>
                                                <input type="text" class="form-control form-control-sm input" required
                                                    id="norek_{{ $loop->iteration }}" name="norek_{{ $loop->iteration }}"
                                                    value="{{ $item->norek }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="wajib" for="nominal_{{ $loop->iteration }}">Nominal
                                                    Plafond</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="nominal_{{ $loop->iteration }}"
                                                        name="nominal_{{ $loop->iteration }}" required
                                                        value="{{ number_format($item->nominal, 0, ',', '.') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="wajib" for="biaya_adm_{{ $loop->iteration }}">Biaya
                                                    Adm</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="biaya_adm_{{ $loop->iteration }}"
                                                        name="biaya_adm_{{ $loop->iteration }}" required
                                                        value="{{ number_format($item->biaya_adm, 0, ',', '.') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="wajib" for="biaya_survey_{{ $loop->iteration }}">Biaya
                                                    Survey</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="biaya_survey_{{ $loop->iteration }}"
                                                        name="biaya_survey_{{ $loop->iteration }}" required
                                                        value="{{ number_format($item->biaya_survey, 0, ',', '.') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="wajib" for="total_adm_survey_{{ $loop->iteration }}">Adm +
                                                    Survey</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="total_adm_survey_{{ $loop->iteration }}"
                                                        name="total_adm_survey_{{ $loop->iteration }}" required
                                                        value="{{ number_format($item->total_adm_survey, 0, ',', '.') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status_referal_{{ $loop->iteration }}">AO/Referal</label>
                                                <select name="status_referal_{{ $loop->iteration }}"
                                                    id="status_referal_{{ $loop->iteration }}"
                                                    class="form-select form-select-sm is-valid" required>
                                                    <option selected value="AO"
                                                        {{ $item->status_referal == 'AO' ? 'selected' : null }}>AO</option>
                                                    <option value="Referal"
                                                        {{ $item->status_referal == 'Referal' ? 'selected' : null }}>
                                                        Referal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nama_referal_{{ $loop->iteration }}">Nama Referal</label>
                                                <input type="text" class="form-control form-control-sm input" required
                                                    id="nama_referal_{{ $loop->iteration }}"
                                                    name="nama_referal_{{ $loop->iteration }}"
                                                    value="{{ $item->nama_referal ?? '-' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="wajib"
                                                    for="insentif_referal_{{ $loop->iteration }}">Insentif
                                                    Referal</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="insentif_referal_{{ $loop->iteration }}"
                                                        name="insentif_referal_{{ $loop->iteration }}" required
                                                        value="{{ number_format($item->insentif_referal, 0, ',', '.') ?? '0' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="wajib"
                                                    for="putusan_{{ $loop->iteration }}">Putusan</label>
                                                <select name="putusan_{{ $loop->iteration }}"
                                                    id="putusan_{{ $loop->iteration }}"
                                                    class="form-select form-select-sm input" required>
                                                    <option selected value="CABANG"
                                                        {{ $item->putusan == 'CABANG' ? 'selected' : null }}>CABANG
                                                    </option>
                                                    <option value="AREA"
                                                        {{ $item->putusan == 'AREA' ? 'selected' : null }}>AREA</option>
                                                    <option value="PUSAT"
                                                        {{ $item->putusan == 'PUSAT' ? 'selected' : null }}>PUSAT</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row ml-2" id="head_deb_1">
                                    <div class="col-md-12">
                                        <strong>→ DATA DEBITUR 1</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tgl_realisasi_1">Tanggal Realisasi</label>
                                            <input type="date" class="form-control form-control-sm input" required
                                                id="tgl_realisasi_1" name="tgl_realisasi_1">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_1">Nama Debitur</label>
                                            <input type="text" class="form-control form-control-sm input" required
                                                id="nama_1" name="nama_1" list="nama_datalist_1">
                                            <datalist id="nama_datalist_1"></datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="norek_1">Norek</label>
                                            <input type="text" class="form-control form-control-sm input" required
                                                id="norek_1" name="norek_1">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="wajib" for="nominal_1">Nominal Plafond</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="text" class="form-control form-control-sm input setRp"
                                                    id="nominal_1" name="nominal_1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="wajib" for="biaya_adm_1">Biaya Adm</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="text" class="form-control form-control-sm input setRp"
                                                    id="biaya_adm_1" name="biaya_adm_1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="wajib" for="biaya_survey_1">Biaya Survey</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="text" class="form-control form-control-sm input setRp"
                                                    id="biaya_survey_1" name="biaya_survey_1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="wajib" for="total_adm_survey_1">Adm + Survey</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="text" class="form-control form-control-sm input setRp"
                                                    id="total_adm_survey_1" name="total_adm_survey_1" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_referal_1">AO/Referal</label>
                                            <select name="status_referal_1" id="status_referal_1"
                                                class="form-select form-select-sm is-valid" required>
                                                <option selected value="AO">AO</option>
                                                <option value="Referal">Referal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_referal_1">Nama Referal</label>
                                            <input type="text" class="form-control form-control-sm input" required
                                                id="nama_referal_1" name="nama_referal_1" value="-">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="wajib" for="insentif_referal_1">Insentif Referal</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="text" class="form-control form-control-sm input setRp"
                                                    id="insentif_referal_1" name="insentif_referal_1" required
                                                    value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="wajib" for="putusan_1">Putusan</label>
                                            <select name="putusan_1" id="putusan_1"
                                                class="form-select form-select-sm input" required>
                                                <option selected value="CABANG">CABANG</option>
                                                <option value="AREA">AREA</option>
                                                <option value="PUSAT">PUSAT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            @endif

                            {{-- tambahan --}}
                            <div id="tambahan_deb"></div>
                            <div class="row">
                                <div class="text-center">
                                    <button class="btn btn-outline-primary w-100" id="tambah_slik" type="button"
                                        onclick="tambahDeb()">
                                        <i class="fa-solid fa-circle-plus"></i> Tambah Data <i
                                            class="fa-solid fa-circle-plus"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- target --}}
                            <br>
                            <div class="row ml-2">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="wajib" for="total_nominal">Total Plafond</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="total_nominal" name="total_nominal"
                                                value="{{ $insenAo == null ? null : number_format($insenAo->total_nominal, 0, ',', '.') }}"
                                                required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="wajib" for="total_biaya_adm">Total Biaya Adm</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="total_biaya_adm" name="total_biaya_adm"
                                                value="{{ $insenAo == null ? null : number_format($insenAo->total_biaya_adm, 0, ',', '.') }}"
                                                required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="wajib" for="total_biaya_survey">Total Biaya Survey</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="total_biaya_survey" name="total_biaya_survey"
                                                value="{{ $insenAo == null ? null : number_format($insenAo->total_biaya_survey, 0, ',', '.') }}"
                                                required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="wajib" for="total_biaya_admin_survey">Total Biaya Admin +
                                            Survey</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="total_biaya_admin_survey" name="total_biaya_admin_survey"
                                                value="{{ $insenAo == null ? null : number_format($insenAo->total_biaya_admin_survey, 0, ',', '.') }}"
                                                required readonly>
                                            <input type="hidden" name="total_biaya_admin_survey_pst"
                                                id="total_biaya_admin_survey_pst">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="wajib" for="total_referal">Total Referal</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control form-control-sm input setRp"
                                                id="total_referal" name="total_referal"
                                                value="{{ $insenAo == null ? '0' : number_format($insenAo->total_referal, 0, ',', '.') }}"
                                                required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- par npl --}}
                            <br>
                            <hr>
                            <div class="ml-2">
                                <table class="table table-sm table-bordered table-hover table-responsive-md">
                                    <thead class="text-center">
                                        <tr>
                                            <th>DATA PAR & NPL</th>
                                            <th>NOMINAL</th>
                                            <th>PERSENTASE</th>
                                            <th>LAYAK/TIDAK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Target</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="target_bawah" name="target_bawah" required
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->target, 0, ',', '.') }}"
                                                        readonly>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Pencapaian</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="pencapaian" name="pencapaian" required
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->pencapaian, 0, ',', '.') }}"
                                                        readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="pencapaian_persen" name="pencapaian_persen" required
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->pencapaian_persen, 0, ',', '.') }}"
                                                        readonly>
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="pencapaian_status" id="pencapaian_status"
                                                    class="form-control form-control-sm input"
                                                    value="{{ $insenAo->pencapaian_status ?? 'Tidak' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PAR</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="par" name="par" required
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->par, 0, ',', '.') }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="par_persen" name="par_persen" required
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->par_persen, 0, ',', '.') }}">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="par_status" id="par_status"
                                                    class="form-control form-control-sm input"
                                                    value="{{ $insenAo->par_status ?? 'Tidak' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NPL Desember Tahun Lalu</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="npl_lampau" name="npl_lampau" required
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->npl_lampau, 0, ',', '.') }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="npl_lampau_persen" name="npl_lampau_persen" required
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->npl_lampau_persen, 0, ',', '.') }}">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <select class="form-select form-select-sm input" name="npl_lampau_status"
                                                    id="npl_lampau_status" required>
                                                    <option selected disabled>-Pilih-</option>
                                                    <option value="Layak"
                                                        {{ $insenAo?->npl_lampau_status == 'Layak' ? 'selected' : null }}>
                                                        Layak</option>
                                                    <option value="Tidak"
                                                        {{ $insenAo?->npl_lampau_status == 'Tidak' ? 'selected' : null }}>
                                                        Tidak</option>
                                                </select> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NPL Periode Insentif</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="npl_insentif" name="npl_insentif" required
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->npl_insentif, 0, ',', '.') }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="npl_insentif_persen" name="npl_insentif_persen" required
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->npl_insentif_persen, 0, ',', '.') }}">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <select class="form-select form-select-sm input" name="npl_lampau_status"
                                                    id="npl_lampau_status" required>
                                                    <option selected disabled>-Pilih-</option>
                                                    <option value="Layak"
                                                        {{ $insenAo?->npl_lampau_status == 'Layak' ? 'selected' : null }}>
                                                        Layak</option>
                                                    <option value="Tidak"
                                                        {{ $insenAo?->npl_lampau_status == 'Tidak' ? 'selected' : null }}>
                                                        Tidak</option>
                                                </select> --}}
                                                <input type="text" name="npl_lampau_status" id="npl_lampau_status"
                                                    class="form-control form-control-sm input"
                                                    value="{{ $insenAo->npl_lampau_status ?? 'Tidak' }}" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- final result --}}
                            <br>
                            <div class="ml-2">
                                <table class="table table-sm table-bordered table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="text-align: center">FINAL RESULT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 40%">Hasil (insentif layak diberikan/tidak)</td>
                                            <td>
                                                {{-- <select class="form-select form-select-sm input" name="hasil"
                                                    id="hasil" required>
                                                    <option selected disabled>-Pilih-</option>
                                                    <option value="Layak"
                                                        {{ $insenAo?->hasil == 'Layak' ? 'selected' : null }}>
                                                        Layak</option>
                                                    <option value="Tidak"
                                                        {{ $insenAo?->hasil == 'Tidak' ? 'selected' : null }}>
                                                        Tidak</option>
                                                </select> --}}
                                                <input type="text" name="hasil" id="hasil"
                                                    class="form-control form-control-sm input"
                                                    value="{{ $insenAo->hasil ?? 'Tidak' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Perhitungan Insentif</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="perhitungan_insentif" name="perhitungan_insentif" required
                                                        readonly
                                                        value="{{ $insenAo == null ? null : number_format($insenAo->perhitungan_insentif, 0, ',', '.') }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pinalti PAR (20% atau 50%)</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="pinalti_par" name="pinalti_par" required
                                                        value="{{ $insenAo == null ? '0' : number_format($insenAo->pinalti_par, 0, ',', '.') }}"
                                                        readonly>
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pinalti Masa Kerja 6 Bulan (20%)</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="pinalti_masa_kerja" name="pinalti_masa_kerja" required
                                                        value="{{ $insenAo == null ? '0' : number_format($insenAo->pinalti_masa_kerja, 0, ',', '.') }}">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Insentif Referal</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="insentif_referal" name="insentif_referal" required
                                                        value="{{ $insenAo == null ? '0' : number_format($insenAo->insentif_referal, 0, ',', '.') }}"
                                                        readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Insentif Final</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control form-control-sm input setRp"
                                                        id="insentif_final" name="insentif_final" required
                                                        value="{{ $insenAo == null ? '0' : number_format($insenAo->insentif_final, 0, ',', '.') }}">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <div class="modal-footer">
                                <button id="simpan" type="button" class="btn btn-primary"
                                    style="letter-spacing: 2px;">
                                    <i class="fa-regular fa-floppy-disk"></i> &nbsp; <b>SIMPAN</b></button>
                                <a href="{{ route('surtug.index') }}" type="button"
                                    class="btn btn-secondary">Kembali</a>
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
    <script src="{{ asset('insentif_js/ao_input.js') }}"></script>
    <script src="{{ asset('insentif_js/ao_input_flex.js') }}"></script>
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
