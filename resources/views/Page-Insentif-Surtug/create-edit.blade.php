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
                        action="{{ $tipe == 'create' ? route('surtug.store') : route('surtug.update', base64_encode($surtug->id)) }}"
                        enctype="multipart/form-data" method="POST" id="quickForm">
                        @csrf
                        @if ($tipe != 'create')
                            @method('patch')
                        @endif
                        <div class="card-body">
                            <div class="row ml-2">
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="status_form">Status Form</label>
                                        <select class="form-select form-select-sm input" name="status_form" id="status_form"
                                            required>
                                            <option selected disabled>-Pilih-</option>
                                            <option value="New"
                                                {{ optional($surtug)->status_form == 'New' ? 'selected' : null }}>
                                                New</option>
                                            <option value="Dilimpahkan"
                                                {{ optional($surtug)->status_form == 'Dilimpahkan' ? 'selected' : null }}>
                                                Dilimpahkan</option>
                                        </select>
                                    </div>
                                    <div class="form-group {{ optional($surtug)->status_form == 'Dilimpahkan' ? '' : 'd-none' }}"
                                        id="head_kode_form_sebelumnya">
                                        <label for="kode_form_sebelumnya">Kode Form Sebelumnya</label>
                                        <input type="text" name="kode_form_sebelumnya" id="kode_form_sebelumnya"
                                            class="form-control form-control-sm input" list="kode_datalist"
                                            value="{{ $surtug->kode_form_sebelumnya ?? null }}">
                                        <datalist id="kode_datalist"></datalist>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="nik_pic">Nomor Induk Karyawan (NIK) PIC</label>
                                        <input type="text" class="form-control form-control-sm input" required
                                            placeholder="NIK PIC" id="nik_pic" name="nik_pic"
                                            value="{{ $surtug->nik_pic ?? null }}">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="nama_pic">Nama PIC</label>
                                        <input type="text" class="form-control form-control-sm input" required
                                            placeholder="Nama PIC" id="nama_pic" name="nama_pic"
                                            value="{{ $surtug->nama_pic ?? null }}">
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="tgl_awal">Tenggat Tanggal Awal</label>
                                        <input type="date" class="form-control form-control-sm input" required
                                            id="tgl_awal" name="tgl_awal"
                                            value="{{ $surtug?->tgl_awal?->format('Y-m-d') ?? null }}">
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="tgl_akhir">Tenggat Tanggal Akhir</label>
                                        <input type="date" class="form-control form-control-sm input" required
                                            id="tgl_akhir" name="tgl_akhir"
                                            value="{{ $surtug?->tgl_awal?->format('Y-m-d') ?? null }}">
                                    </div>
                                </div>
                            </div>
                            <hr class="ml-3">

                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <table class="table table-sm table-bordered table-hover table-responsive-md">
                                        <thead style="text-align: center">
                                            <tr>
                                                <th colspan="7">TARGET PENYELESAIAN KREDIT BERMASALAH</th>
                                            </tr>
                                            <tr>
                                                <th style="width: 5%">#</th>
                                                <th style="width: 20%">DEBITUR</th>
                                                <th style="width: 15%">NOREK</th>
                                                <th style="width: 20%">PLAFON</th>
                                                <th style="width: 18%">BAKI DEBET</th>
                                                <th style="width: 10%">KOL</th>
                                                <th style="width: 15%">TARGET</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($debsur != null && $debsur->isNotEmpty())
                                                @foreach ($debsur as $item)
                                                    <tr>
                                                        <td>
                                                            {{ $loop->iteration }}
                                                            <input type="hidden" name="id_deb_{{ $loop->iteration }}"
                                                                id="id_deb_{{ $loop->iteration }}"
                                                                value="{{ base64_encode($item->id) }}" readonly>
                                                            <select name="aksi_{{ $loop->iteration }}"
                                                                id="aksi_{{ $loop->iteration }}"
                                                                class="wajib border-danger" required>
                                                                <option selected disabled>-</option>
                                                                <option value="Edit">🖊️</option>
                                                                <option value="Hapus">🗑️</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm input"
                                                                id="nama_{{ $loop->iteration }}"
                                                                name="nama_{{ $loop->iteration }}"
                                                                value="{{ $item->nama }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input"
                                                                id="norek_{{ $loop->iteration }}"
                                                                name="norek_{{ $loop->iteration }}"
                                                                value="{{ $item->norek }}" required>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-text">Rp.</span>
                                                                <input type="text"
                                                                    class="form-control form-control-sm input setRp"
                                                                    id="plafond_{{ $loop->iteration }}"
                                                                    name="plafond_{{ $loop->iteration }}"
                                                                    value="{{ number_format($item->plafond, 0, ',', '.') }}"
                                                                    required>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-text">Rp.</span>
                                                                <input type="text"
                                                                    class="form-control form-control-sm input setRp"
                                                                    id="bakidebet_{{ $loop->iteration }}"
                                                                    name="bakidebet_{{ $loop->iteration }}"
                                                                    value="{{ number_format($item->bakidebet, 0, ',', '.') }}"
                                                                    required>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input"
                                                                id="kol_{{ $loop->iteration }}"
                                                                name="kol_{{ $loop->iteration }}" required
                                                                list="kol_datalist_{{ $loop->iteration }}"
                                                                value="{{ $item->kol }}">
                                                            <datalist id="kol_datalist_{{ $loop->iteration }}">
                                                                <option value="DPK">DPK</option>
                                                                <option value="KL">KL</option>
                                                                <option value="D">D</option>
                                                                <option value="M">M</option>
                                                            </datalist>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                class="form-control form-control-sm input"
                                                                id="target_{{ $loop->iteration }}"
                                                                name="target_{{ $loop->iteration }}" required
                                                                list="target_list_{{ $loop->iteration }}"
                                                                value="{{ $item->target }}">
                                                            <datalist id="target_list_{{ $loop->iteration }}">
                                                                <option value="Lunas">Lunas</option>
                                                            </datalist>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm input"
                                                            id="nama_1" name="nama_1" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm input"
                                                            id="norek_1" name="norek_1" required>
                                                    </td>
                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text">Rp.</span>
                                                            <input type="text"
                                                                class="form-control form-control-sm input setRp"
                                                                id="plafond_1" name="plafond_1" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text">Rp.</span>
                                                            <input type="text"
                                                                class="form-control form-control-sm input setRp"
                                                                id="bakidebet_1" name="bakidebet_1" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm input"
                                                            id="kol_1" name="kol_1" required list="kol_datalist_1">
                                                        <datalist id="kol_datalist_1">
                                                            <option value="DPK">DPK</option>
                                                            <option value="KL">KL</option>
                                                            <option value="D">D</option>
                                                            <option value="M">M</option>
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm input"
                                                            id="target_1" name="target_1" required list="target_list_1">
                                                        <datalist id="target_list_1">
                                                            <option value="Lunas">Lunas</option>
                                                        </datalist>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tbody id="tambahan_data_debitur"></tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7">
                                                    <input class="btn btn-outline-warning w-100" type="button"
                                                        value="(-) Kurangi Data (-)" id="kurangi_data">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    <input class="btn btn-outline-primary w-100" id="tambah_data"
                                                        type="button" value="(+) Tambah Data (+)">
                                                </td>
                                            </tr>
                                        </tfoot>
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
    <script src="{{ asset('insentif_js/surtug_input.js') }}"></script>
    <script src="{{ asset('insentif_js/rupiah.js') }}"></script>
    <script src="{{ asset('insentif_js/confirm-submit.js') }}"></script>
    <script>
        document.getElementById('kode_form_sebelumnya').addEventListener('input', function() {
            let query = this.value;

            // Mulai cari jika pengguna sudah mengetik minimal 2 karakter
            if (query.length >= 2) {
                fetch(`/insentif/get-kode-form?q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        let datalist = document.getElementById('kode_datalist');
                        datalist.innerHTML = ''; // Kosongkan data lama

                        data.forEach(item => {
                            let option = document.createElement('option');
                            option.value = item;
                            datalist.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }
        });
    </script>

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
