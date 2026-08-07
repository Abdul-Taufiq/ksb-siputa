$("input").attr("autocomplete", "off");
$(document).ready(function () {
    // Default semua form diberi border merah
    $(".input").addClass("is-invalid");

    // Event listener untuk semua elemen dengan class .input
    $(document).on("input change", ".input", function () {
        var value = $(this).val();

        if (value && value.toString().trim() !== "") {
            // Ada value → hijau
            $(this).addClass("is-valid").removeClass("is-invalid");
        } else {
            // Kosong → merah
            $(this).addClass("is-invalid").removeClass("is-valid");
        }
    });

    // Cek kondisi awal (misalnya form edit sudah ada value)
    $(".input").each(function () {
        var value = $(this).val();
        if (value && value.toString().trim() !== "") {
            $(this).addClass("is-valid").removeClass("is-invalid");
        }
    });

    for (let i = 1; i <= 20; i++) {
        if (document.getElementById(`nama_${i}`)) {
            autoFill(i);
            updateAdminSurvey(i);
        }
    }
});

// penghubung server
// search by nama ao dan nama debitur
function autoFill(i) {
    document.getElementById(`nama_${i}`).addEventListener("input", function () {
        let nama_ao = document.getElementById("nama_ao").value;
        let query = this.value;

        // Mulai cari jika pengguna sudah mengetik minimal 2 karakter
        if (query.length >= 2) {
            fetch(
                `/insentif/get-data-kredit?nama_ao=${nama_ao}&nama_deb=${query}`,
            )
                .then((response) => response.json())
                .then((data) => {
                    let datalist = document.getElementById(
                        `nama_datalist_${i}`,
                    );
                    datalist.innerHTML = ""; // Kosongkan data lama

                    data.forEach((item) => {
                        let option = document.createElement("option");
                        option.value = item.nama_debitur;
                        datalist.appendChild(option);
                    });
                })
                .catch((error) => console.error("Error fetching data:", error));
        }
    });

    // event pilih dabitur
    document
        .getElementById(`nama_${i}`)
        .addEventListener("change", function () {
            let nama_ao = document.getElementById("nama_ao").value;
            let query = this.value;

            const norek = document.getElementById(`norek_${i}`);
            const nominal = document.getElementById(`nominal_${i}`);
            const biaya_adm = document.getElementById(`biaya_adm_${i}`);
            const biaya_survey = document.getElementById(`biaya_survey_${i}`);
            const total_adm_survey = document.getElementById(
                `total_adm_survey_${i}`,
            );
            const status_referal = document.getElementById(
                `status_referal_${i}`,
            );
            const nama_referal = document.getElementById(`nama_referal_${i}`);

            // cek apakah value ada di datalist
            let datalist = document.getElementById(`nama_datalist_${i}`);
            let isValid = Array.from(datalist.options).some(
                (option) => option.value === query,
            );

            if (!isValid) {
                // kalau tidak valid, kosongkan field lain dan stop
                [
                    norek,
                    nominal,
                    biaya_adm,
                    biaya_survey,
                    total_adm_survey,
                ].forEach((el) => {
                    el.classList.add("is-invalid");
                    el.classList.remove("is-valid");
                });
                return;
            }

            fetch(
                `/insentif/get-detail-data-kredit?nama_ao=${nama_ao}&nama_deb=${query}`,
            )
                .then((response) => response.json())
                .then((data) => {
                    // tampilkan detail ke UI sesuai kebutuhan

                    norek.value = data.norek_tabungan;
                    nominal.value = new Intl.NumberFormat("id-ID", {
                        style: "decimal",
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0,
                    }).format(data.jumlah_disetujui);
                    biaya_adm.value = new Intl.NumberFormat("id-ID", {
                        style: "decimal",
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0,
                    }).format(data.biaya_adm);
                    biaya_survey.value = new Intl.NumberFormat("id-ID", {
                        style: "decimal",
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0,
                    }).format(data.biaya_survey);

                    if (data.asal_kredit == "Referal") {
                        nama_referal.value = data.petugas_referal;
                        status_referal.value = "Referal";
                    } else {
                        nama_referal.value = "-";
                    }

                    let admSurvey = data.biaya_adm + data.biaya_survey;
                    total_adm_survey.value = new Intl.NumberFormat("id-ID", {
                        style: "decimal",
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0,
                    }).format(admSurvey);

                    if (
                        data.norek_tabungan !== null &&
                        data.norek_tabungan !== "0" &&
                        data.norek_tabungan !== "-"
                    ) {
                        norek.classList.add("is-valid");
                        norek.classList.remove("is-invalid");
                    }

                    [
                        nominal,
                        biaya_adm,
                        biaya_survey,
                        nama_referal,
                        total_adm_survey,
                    ].forEach((el) => {
                        el.classList.add("is-valid");
                        el.classList.remove("is-invalid");
                    });

                    // otomatis bikin event listener agar jalan
                    updateTotalPlafond();
                    updateTotalBiayaAdm();
                    updateTotalBiayaSurvey();
                    updateTotalAdmSurvey();
                    updateTotalReferal();
                });
        });
}

// Fungsi untuk mengambil semua input dinamis dan menghitung total
let totalPlafond = document.getElementById("total_nominal");
let pencapaian = document.getElementById("pencapaian");
function updateTotalPlafond() {
    let total = 0;
    document.querySelectorAll("[id^='nominal_']").forEach((input) => {
        total += toAngka(input.dataset.rawValue || input.value);
    });
    totalPlafond.value = setRpId(total);
    totalPlafond.classList.remove("is-invalid");
    totalPlafond.classList.add("is-valid");

    pencapaian.value = setRpId(total);
    pencapaian.classList.remove("is-invalid");
    pencapaian.classList.add("is-valid");

    PersenPencapaian();
}

// Fungsi untuk mengambil semua input dinamis dan menghitung total
const totalBiayaAdm = document.getElementById("total_biaya_adm");
function updateTotalBiayaAdm() {
    let total = 0;
    document.querySelectorAll("[id^='biaya_adm_']").forEach((input) => {
        total += toAngka(input.dataset.rawValue || input.value);
    });
    totalBiayaAdm.value = setRpId(total);
    totalBiayaAdm.classList.remove("is-invalid");
    totalBiayaAdm.classList.add("is-valid");
}

// Fungsi untuk mengambil semua input dinamis dan menghitung total
const totalBiayaSurvey = document.getElementById("total_biaya_survey");
function updateTotalBiayaSurvey() {
    let total = 0;
    document.querySelectorAll("[id^='biaya_survey_']").forEach((input) => {
        total += toAngka(input.dataset.rawValue || input.value);
    });
    totalBiayaSurvey.value = setRpId(total);
    totalBiayaSurvey.classList.remove("is-invalid");
    totalBiayaSurvey.classList.add("is-valid");
}

// Fungsi untuk mengambil semua input dinamis dan menghitung total
const totalAdmSurvey = document.getElementById("total_biaya_admin_survey");
const totalAdmSurveyPst = document.getElementById(
    "total_biaya_admin_survey_pst",
);
function updateTotalAdmSurvey() {
    let total = 0;
    document.querySelectorAll("[id^='total_adm_survey_']").forEach((input) => {
        total += toAngka(input.dataset.rawValue || input.value);
    });
    totalAdmSurvey.value = setRpId(total);
    totalAdmSurvey.classList.remove("is-invalid");
    totalAdmSurvey.classList.add("is-valid");

    admSurveyPst();
    totalInsentif();
    insentifFinal();
}

// fungsi total adm + survey BWMK pusat
function admSurveyPst() {
    let totalPst = 0;
    // ambil semua putusan
    document.querySelectorAll("[id^='putusan_']").forEach((putusanInput) => {
        if (putusanInput.value === "PUSAT") {
            // ambil nomor index dari id, misal putusan_3 → 3
            let idx = putusanInput.id.split("_")[1];
            let admInput = document.getElementById("total_adm_survey_" + idx);
            let insentif_referal = document.getElementById(
                "insentif_referal_" + idx,
            );

            if (admInput) {
                totalPst += toAngka(
                    admInput.dataset.rawValue || admInput.value,
                );
            }
        }
    });

    totalAdmSurveyPst.value = setRpId(totalPst);
    totalInsentif();
    insentifFinal();
}

// Fungsi untuk mengambil semua input dinamis dan menghitung total
const totalReferal = document.getElementById("total_referal");
const insenRef = document.getElementById("insentif_referal");
function updateTotalReferal() {
    let total = 0;
    document.querySelectorAll("[id^='insentif_referal_']").forEach((input) => {
        total += toAngka(input.dataset.rawValue || input.value);
    });
    totalReferal.value = setRpId(total);
    totalReferal.classList.remove("is-invalid");
    totalReferal.classList.add("is-valid");

    insenRef.value = setRpId(total);
    insenRef.classList.remove("is-invalid");
    insenRef.classList.add("is-valid");
}

// Biaya Admin + Biaya Survey
function updateAdminSurvey(i) {
    const biaya_adm = document.getElementById(`biaya_adm_${i}`);
    const biaya_survey = document.getElementById(`biaya_survey_${i}`);
    const total_adm_survey = document.getElementById(`total_adm_survey_${i}`);

    biaya_adm.addEventListener("input", function () {
        let total = toAngka(biaya_adm.value) + toAngka(biaya_survey.value);
        total_adm_survey.value = setFormatRupiah(total);

        if (total_adm_survey.value.toString().trim() !== "") {
            total_adm_survey.classList.remove("is-invalid");
            total_adm_survey.classList.add("is-valid");
        } else {
            total_adm_survey.classList.remove("is-valid");
            total_adm_survey.classList.add("is-invalid");
        }
    });

    biaya_survey.addEventListener("input", function () {
        let total = toAngka(biaya_adm.value) + toAngka(biaya_survey.value);
        total_adm_survey.value = setFormatRupiah(total);
        if (total_adm_survey.value.toString().trim() !== "") {
            total_adm_survey.classList.remove("is-invalid");
            total_adm_survey.classList.add("is-valid");
        } else {
            total_adm_survey.classList.remove("is-valid");
            total_adm_survey.classList.add("is-invalid");
        }
    });
}

//
//
// trigger
// trigger
// Pastikan setiap input yang ada dan yang baru dibuat tetap menghitung total
document.addEventListener("input", function (event) {
    const id = event.target.id;

    if (event.target.id.startsWith("insentif_referal_")) {
        updateTotalReferal();
        insentifFinal();
    }

    if (event.target.id.startsWith("biaya_adm_")) {
        updateTotalBiayaAdm();
        updateTotalAdmSurvey(); // karena adm ikut total adm_survey
    }

    if (event.target.id.startsWith("nominal_")) {
        updateTotalPlafond();
    }

    if (event.target.id.startsWith("biaya_survey_")) {
        updateTotalBiayaSurvey();
        updateTotalAdmSurvey(); // survey ikut total adm_survey
    }

    if (event.target.id.startsWith("total_adm_survey_")) {
        updateTotalAdmSurvey();
    }

    if (event.target.id.startsWith("putusan_")) {
        admSurveyPst();
    }

    if (event.target.id.startsWith("aksi_")) {
        updateIfDelete();
    }
});

document.addEventListener("change", function (event) {
    const id = event.target.id;

    if (event.target.id.startsWith("status_referal_")) {
        updateTotalReferal();
        insentifFinal();
        updateNomReferal();
    }

    if (event.target.id.startsWith("insentif_referal_")) {
        updateTotalReferal();
        insentifFinal();
    }

    if (event.target.id.startsWith("biaya_adm_")) {
        updateTotalBiayaAdm();
        updateTotalAdmSurvey();
    }

    if (event.target.id.startsWith("nominal_")) {
        updateTotalPlafond();
    }

    if (event.target.id.startsWith("biaya_survey_")) {
        updateTotalBiayaSurvey();
        updateTotalAdmSurvey();
    }

    if (event.target.id.startsWith("total_adm_survey_")) {
        updateTotalAdmSurvey();
    }

    if (event.target.id.startsWith("putusan_")) {
        admSurveyPst();
        updateNomReferal();
    }

    if (event.target.id.startsWith("aksi_")) {
        updateIfDelete();
    }
});

//
//
// RESULT
document.getElementById("target").addEventListener("input", function () {
    const value = $(this).val();
    const target_bawah = document.getElementById("target_bawah");

    target_bawah.value = value;
    target_bawah.classList.remove("is-invalid");
    target_bawah.classList.add("is-valid");

    PersenPencapaian();
});

let hasil = document.getElementById("hasil");
function PersenPencapaian() {
    let pencapaian_persen = document.getElementById("pencapaian_persen");
    let target = document.getElementById("target_bawah");
    let pencapaian = document.getElementById("pencapaian");
    let pencapaian_status = document.getElementById("pencapaian_status");

    let total = (toAngka(pencapaian.value) / toAngka(target.value)) * 100;

    pencapaian_persen.value = formatPercent(total);
    pencapaian_persen.classList.remove("is-invalid");
    pencapaian_persen.classList.add("is-valid");

    if (total < 80) {
        pencapaian_status.value = "Tidak";
        hasil.value = "Tidak";
    } else {
        pencapaian_status.value = "Layak";
        hasil.value = "Layak";
    }
    pencapaian_status.classList.remove("is-invalid");
    pencapaian_status.classList.add("is-valid");
    hasil.classList.remove("is-invalid");
    hasil.classList.add("is-valid");
}

// update pinalti PAR
let pinalti = document.getElementById("pinalti_par");
let par_status = document.getElementById("par_status");
document.getElementById("par_persen").addEventListener("input", function () {
    let par_persen = toAngka($(this).val());

    par_status.value = "Layak";
    par_status.classList.remove("is-invalid");
    par_status.classList.add("is-valid");

    if (par_persen > 5 && par_persen <= 10) {
        pinalti.value = 20;
        hasil.value = "Layak";
    } else if (par_persen > 10 && par_persen <= 15) {
        pinalti.value = 50;
        hasil.value = "Layak";
    } else if (par_persen > 15) {
        pinalti.value = 100;
        par_status.value = "Tidak";
        hasil.value = "Tidak";
    } else {
        pinalti.value = 0;
        hasil.value = "Layak";
    }

    insentifFinal();
});
document
    .getElementById("pinalti_masa_kerja")
    .addEventListener("input", function () {
        insentifFinal();
    });

document
    .getElementById("npl_insentif_persen")
    .addEventListener("input", function () {
        const value = toAngka($(this).val());
        const npl = toAngka(document.getElementById("npl_lampau_persen").value);
        const npl_status = document.getElementById("npl_lampau_status");

        if (value > npl) {
            hasil.value = "Tidak";
            npl_status.value = "Tidak";
        } else {
            hasil.value = "Layak";
            npl_status.value = "Layak";
        }
    });

// update perhitungan insentif Result
let perhitungan_insentif = document.getElementById("perhitungan_insentif");
function totalInsentif() {
    insPutusan =
        (toAngka(totalAdmSurvey.value) - toAngka(totalAdmSurveyPst.value)) *
        0.08;
    insPutusanPst = toAngka(totalAdmSurveyPst.value) * 0.5 * 0.08;
    total = insPutusan + insPutusanPst;

    perhitungan_insentif.value = setRpId(total);
    perhitungan_insentif.classList.remove("is-invalid");
    perhitungan_insentif.classList.add("is-valid");
}

// update Insentif Final
let insentif_final = document.getElementById("insentif_final");
function insentifFinal() {
    let pinalti_masa_kerja =
        document.getElementById("pinalti_masa_kerja").value;
    let pinalti_par = pinalti.value;
    let insenRefVal = insenRef.value;
    let hitungPinaltiPAR = 0;
    let hitungPinaltiMK = 0;

    // hitung jika ada pinalti par
    if (pinalti_par != 0) {
        hitungPinaltiPAR =
            toAngka(perhitungan_insentif.value) * (pinalti_par / 100);
    }

    if (pinalti_masa_kerja != 0) {
        hitungPinaltiMK =
            toAngka(perhitungan_insentif.value) * (pinalti_masa_kerja / 100);
    }

    let total =
        toAngka(perhitungan_insentif.value) -
        hitungPinaltiPAR -
        hitungPinaltiMK -
        toAngka(insenRefVal);

    insentif_final.value = setRpId(total);
}

// fungsi jika yang dipilih hapus
function updateIfDelete() {
    // ambil semua putusan
    document.querySelectorAll("[id^='aksi_']").forEach((aksi) => {
        if (aksi.value === "Hapus") {
            // ambil nomor index dari id, misal putusan_3 → 3
            let idx = aksi.id.split("_")[1];
            let nominalEl = document.getElementById("nominal_" + idx);
            let admEl = document.getElementById("biaya_adm_" + idx);
            let surveyEl = document.getElementById("biaya_survey_" + idx);
            let admSurveyEl = document.getElementById(
                "total_adm_survey_" + idx,
            );
            let refEl = document.getElementById("insentif_referal_" + idx);

            nominalEl.value = 0;
            admEl.value = 0;
            surveyEl.value = 0;
            admSurveyEl.value = 0;
            refEl.value = 0;

            // trigger event supaya listener lain jalan
            nominalEl.dispatchEvent(new Event("input", { bubbles: true }));
            admEl.dispatchEvent(new Event("input", { bubbles: true }));
            surveyEl.dispatchEvent(new Event("input", { bubbles: true }));
            admSurveyEl.dispatchEvent(new Event("input", { bubbles: true }));
            refEl.dispatchEvent(new Event("input", { bubbles: true }));
        }
    });

    totalInsentif();
    insentifFinal();
}

// fungsi jika yang dipilih REFERAL
function updateNomReferal() {
    // ambil semua putusan
    document.querySelectorAll("[id^='status_referal_']").forEach((aksi) => {
        // ambil nomor index dari id, misal putusan_3 → 3
        let parts = aksi.id.split("_");
        let idx = parts[parts.length - 1]; // ambil angka terakhir
        let admSurveyEl = document.getElementById("total_adm_survey_" + idx);
        let refEl = document.getElementById("insentif_referal_" + idx);
        let putusan = document.getElementById("putusan_" + idx);
        let status_referal = document.getElementById("status_referal_" + idx);

        let total = 0;
        if (putusan.value == "PUSAT") {
            total = toAngka(admSurveyEl.value) * 0.5 * 0.08 * 0.5;
        } else {
            total = toAngka(admSurveyEl.value) * 0.08 * 0.5;
        }

        if (status_referal.value == "AO") {
            refEl.value = 0;
        } else {
            refEl.value = setRpId(total);
        }

        // trigger event supaya listener lain jalan
        admSurveyEl.dispatchEvent(new Event("input", { bubbles: true }));
        refEl.dispatchEvent(new Event("input", { bubbles: true }));
    });

    totalInsentif();
    insentifFinal();
}

//
//
// Fungsi pendukung
function toAngka(value) {
    return parseFloat(value.replace(/\./g, "").replace(",", ".")) || 0;
}
// Fungsi untuk mengubah angka ke format Rupiah
function setRpId(angka) {
    return angka.toLocaleString("id-ID");
}

// Untuk angka hasil perhitungan
function formatPercent(number) {
    // pastikan number float
    let rawValue = parseFloat(number).toFixed(2);
    return rawValue.replace(".", ",");
}
