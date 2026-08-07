let counter = 1;
let maxCounter = 30;

function tambahDeb() {
    let container = document.getElementById("tambahan_deb");
    let inputElements = document.querySelectorAll('div[id^="head_deb_"]');
    let angka_besar = 0;

    // cek element terakhir
    if (inputElements.length > 0) {
        inputElements.forEach(function (inputElement) {
            // Menggunakan ekspresi reguler untuk mencocokkan nomor pada nama input
            var match = inputElement.id.match(/\d+/);

            // Jika ada kecocokan dan nomornya lebih besar dari yang sudah ada
            if (match && parseInt(match[0]) > angka_besar) {
                counter = parseInt(match[0]);
            }
        });
    } else {
        counter = 0;
    }

    // tambah counter
    counter++;
    // console.log(counter);

    if (counter <= maxCounter) {
        let newDiv = document.createElement("div");
        newDiv.className = "row mb-3";
        newDiv.id = `head_div_deb_${counter}`;
        newDiv.innerHTML = `
                <div class="row ml-2" id="head_deb_${counter}">
                    <div class="col-md-12">
                        <strong>→ DATA DEBITUR ${counter}</strong>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tgl_realisasi_${counter}">Tanggal Realisasi</label>
                            <input type="date" class="is-invalid form-control form-control-sm input" required
                                id="tgl_realisasi_${counter}" name="tgl_realisasi_${counter}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nama_${counter}">Nama Debitur</label>
                            <input type="text" class="form-control form-control-sm input is-invalid" required
                                id="nama_${counter}" name="nama_${counter}" list="nama_datalist_${counter}">
                            <datalist id="nama_datalist_${counter}"></datalist>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="norek_${counter}">Norek</label>
                            <input type="text" class="is-invalid form-control form-control-sm input" required
                                id="norek_${counter}" name="norek_${counter}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="wajib" for="nominal_${counter}">Nominal</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="is-invalid form-control form-control-sm input setRp"
                                    id="nominal_${counter}" name="nominal_${counter}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="wajib" for="biaya_adm_${counter}">Biaya Adm</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="is-invalid form-control form-control-sm input setRp"
                                    id="biaya_adm_${counter}" name="biaya_adm_${counter}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="wajib" for="biaya_survey_${counter}">Biaya Survey</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="is-invalid form-control form-control-sm input setRp"
                                    id="biaya_survey_${counter}" name="biaya_survey_${counter}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="wajib" for="total_adm_survey_${counter}">Adm + Survey</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="is-invalid form-control form-control-sm input setRp"
                                    id="total_adm_survey_${counter}" name="total_adm_survey_${counter}" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status_referal_${counter}">AO/Referal</label>
                            <select name="status_referal_${counter}" id="status_referal_${counter}"
                                class="form-select form-select-sm is-valid" required>
                                <option selected value="AO">AO</option>
                                <option value="Referal">Referal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nama_referal_${counter}">Nama Referal</label>
                            <input type="text" class="is-valid form-control form-control-sm input" required
                                id="nama_referal_${counter}" name="nama_referal_${counter}" value="-">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="wajib" for="insentif_referal_${counter}">Insentif Referal</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="is-valid form-control form-control-sm input setRp"
                                    id="insentif_referal_${counter}" name="insentif_referal_${counter}" required
                                    value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="wajib" for="putusan_${counter}">Putusan</label>
                            <select name="putusan_${counter}" id="putusan_${counter}"
                                class="form-select form-select-sm input is-valid" required>
                                <option selected value="CABANG">CABANG</option>
                                <option value="AREA">AREA</option>
                                <option value="PUSAT">PUSAT</option>
                            </select>
                        </div>
                    </div>
                </div>
        `;

        // untuk tombol kurangi
        newDiv.innerHTML += `
            <div>
                <div class="text-center"">
                    <button class="btn btn-outline-warning w-100" id="kurangi_slik_${counter}" data-id="head_div_deb_${counter}" type="button" onclick="kurangiDeb()">
                        <i class="fa-solid fa-circle-minus"></i> Kurangi Data <i class="fa-solid fa-circle-minus"></i>
                    </button>
                </div>
            </div>
            <div>
                <hr>
            </div>
        `;

        container.appendChild(newDiv);

        // Inisialisasi tooltip untuk elemen baru
        const tooltipTrigger = newDiv.querySelector(
            '[data-bs-toggle="tooltip"]',
        );
        if (tooltipTrigger) {
            new bootstrap.Tooltip(tooltipTrigger);
        }

        setRupiah();
        autoFill(counter);
        updateAdminSurvey(counter);
    } else {
        console.error("Maximum number of SLIK reached.");
        alert("Maksimal SLIK yang dapat ditambahkan adalah 100.");
    }
}

function kurangiDeb() {
    // console.log("kurangiJaminan() called");
    // Ambil elemen tombol yang diklik
    let button = event.target;
    let idDiv = button.getAttribute("data-id");

    // Log data-id untuk memastikan nilainya benar
    console.log("ID Div yang akan dihapus:", idDiv);

    // Hapus elemen berdasarkan data-id
    let container = document.getElementById("tambahan_deb");
    let divToRemove = document.getElementById(idDiv);
    // Ambil angka dari idDiv menggunakan RegEx
    let AmbilId = parseInt(idDiv.match(/\d+$/)[0]); // Mengambil angka di akhir string
    let IdNextEl = AmbilId + 1; // Mengurangi 1 dari angka yang diambil
    // console.log(`ID untuk penjamin baru: ${IdNextEl}`);

    if (divToRemove && container.contains(divToRemove)) {
        container.removeChild(divToRemove); // Hapus elemen dari container
        counter--; // Kurangi counter hanya jika elemen berhasil dihapus
        // console.log(`Penjamin dengan ID ${idDiv} berhasil dihapus.`);

        // Perbarui ID dan atribut elemen yang tersisa
        let NextElement = document.getElementById("head_div_deb_" + IdNextEl);
        // console.log(NextElement);

        // kondisi jika NextElement ada
        if (NextElement) {
            idForNew = `head_div_deb_${AmbilId}`; // Perbarui ID elemen
            // console.log(idForNew);
            NextElement.id = idForNew; // Perbarui ID elemen

            // Perbarui semua atribut dan elemen di dalamnya
            NextElement.querySelectorAll(
                "[id], [name], [data-id], [for]",
            ).forEach((element) => {
                if (element.for) {
                    element.for = element.for.replace(/\d+$/, AmbilId);
                }
                if (element.id) {
                    element.id = element.id.replace(/\d+$/, AmbilId);
                }
                if (element.name) {
                    element.name = element.name.replace(/\d+$/, AmbilId);
                }
                if (element.getAttribute("data-id")) {
                    element.setAttribute("data-id", `head_div_deb_${AmbilId}`);
                }
            });

            // Perbarui teks judul
            let titles = NextElement.querySelectorAll("strong");
            if (titles) {
                titles[0].textContent = `→ DATA DEBITUR ${AmbilId}`;
            }
        }
    } else {
        console.error("Elemen tidak ditemukan atau tidak dapat dihapus.");
    }
}
