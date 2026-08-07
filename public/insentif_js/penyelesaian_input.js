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

    // set dpi
    document.getElementById("dpi_opsi").addEventListener("change", function () {
        let dpi_persen = document.getElementById("dpi_persen");
        let selected = this.value;

        if (selected == "Diragukan & Macet") {
            dpi_persen.value = 20;
        } else if (selected == "Hapus Buku") {
            dpi_persen.value = 10;
        } else if (selected == "AYDA") {
            dpi_persen.value = 20;
        }

        $("#dpi_persen").addClass("is-valid").removeClass("is-invalid");
        hitungInsentif();
    });
});

// fungsi berhubungan dengan server
document
    .getElementById("kode_form_surtug")
    .addEventListener("input", function () {
        let query = this.value;

        // Mulai cari jika pengguna sudah mengetik minimal 2 karakter
        if (query.length >= 1) {
            fetch(`/insentif/get-kode-form?q=${query}`)
                .then((response) => response.json())
                .then((data) => {
                    let datalist = document.getElementById("kode_datalist");
                    datalist.innerHTML = ""; // Kosongkan data lama

                    data.forEach((item) => {
                        let option = document.createElement("option");
                        option.value = item;
                        datalist.appendChild(option);
                    });
                })
                .catch((error) => console.error("Error fetching data:", error));
        }
    });

document.getElementById("nama").addEventListener("input", function () {
    let kode = document.getElementById("kode_form_surtug").value;
    let k_safe = encodeURIComponent(kode);
    let query = this.value;

    // Mulai cari jika pengguna sudah mengetik minimal 2 karakter
    if (query.length >= 2) {
        fetch(`/insentif/get-nama-form?q=${query}&k=${k_safe}`)
            .then((response) => response.json())
            .then((data) => {
                let datalist = document.getElementById("nama_datalist");
                datalist.innerHTML = ""; // Kosongkan data lama

                data.forEach((item) => {
                    let option = document.createElement("option");
                    option.value = item;
                    datalist.appendChild(option);
                });
            })
            .catch((error) => console.error("Error fetching data:", error));
    }
});

// Event ketika user memilih salah satu opsi dari datalist
document.getElementById("nama").addEventListener("change", function () {
    let kode = document.getElementById("kode_form_surtug").value;
    let k_safe = encodeURIComponent(kode);
    let selected = this.value;

    // lakukan aksi lain, misalnya fetch detail data
    fetch(`/insentif/get-detail-form?q=${selected}&k=${k_safe}`)
        .then((res) => res.json())
        .then((detail) => {
            // console.log("Detail data:", detail);
            // tampilkan detail ke UI sesuai kebutuhan
            const norek = document.getElementById("norek");
            const plafond = document.getElementById("plafond");
            const bakidebet = document.getElementById("bakidebet");
            const kolek = document.getElementById("kolek");

            norek.value = detail.norek;
            plafond.value = new Intl.NumberFormat("id-ID", {
                style: "decimal",
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            }).format(detail.plafond);
            bakidebet.value = new Intl.NumberFormat("id-ID", {
                style: "decimal",
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            }).format(detail.bakidebet);
            kolek.value = detail.kol;

            [norek, plafond, bakidebet, kolek].forEach((el) => {
                el.classList.add("is-valid");
                el.classList.remove("is-invalid");
            });
        });
});
// end fungsi berhubungan dengan server

// setting persen pembagian insentif
document
    .getElementById("komposisi_insentif")
    .addEventListener("change", function () {
        let opt = this.value;
        let persen_1 = document.getElementById("persen_1");
        let persen_2 = document.getElementById("persen_2");
        let persen_3 = document.getElementById("persen_3");
        let persen_4 = document.getElementById("persen_4");

        switch (opt) {
            case "Cabang":
                persen_1.value = 90;
                persen_2.value = 0;
                persen_3.value = 0;
                persen_4.value = 10;
                break;
            case "Remedial":
                persen_1.value = 10;
                persen_2.value = 70;
                persen_3.value = 10;
                persen_4.value = 10;
                break;
            case "Remedial Debitur Prioritas":
                persen_1.value = 10;
                persen_2.value = 80;
                persen_3.value = 0;
                persen_4.value = 10;
                break;

            default:
                break;
        }

        hitungPembagian();

        [persen_1, persen_2, persen_3, persen_4].forEach((el) => {
            el.classList.add("is-valid");
            el.classList.remove("is-invalid");
        });
    });

// perhitungan
function hitungDpi() {
    const nominal_dibayar = document.getElementById("nominal_dibayar");
    const bakidebet = document.getElementById("bakidebet");
    const biaya_pihak_ketiga = document.getElementById("biaya_pihak_ketiga");
    const dpi = document.getElementById("dpi");

    let total =
        toNumber(nominal_dibayar.dataset.rawValue || nominal_dibayar.value) -
        toNumber(bakidebet.dataset.rawValue || bakidebet.value) -
        toNumber(
            biaya_pihak_ketiga.dataset.rawValue || biaya_pihak_ketiga.value,
        );

    hitungInsentif();

    dpi.value = setFormatRupiah(total);
    dpi.classList.remove("is-invalid");
    dpi.classList.add("is-valid");
}

const triggerHitungDpi = document.querySelectorAll(
    "#bakidebet, #nominal_dibayar, #biaya_pihak_ketiga",
);

setInputs(triggerHitungDpi, hitungDpi);

// hitung insentif
function hitungInsentif() {
    let dpi_persen = document.getElementById("dpi_persen");
    const dpi = document.getElementById("dpi");
    const nominal_insentif = document.getElementById("nominal_insentif");

    let total =
        (toNumber(dpi_persen.dataset.rawValue || dpi_persen.value) / 100) *
        toNumber(dpi.value);

    nominal_insentif.value = setFormatRupiah(total);
    nominal_insentif.classList.remove("is-invalid");
    nominal_insentif.classList.add("is-valid");

    hitungPembagian();
}

// hitung nominal pembagian
function hitungPembagian() {
    let persen_1 = document.getElementById("persen_1");
    let persen_2 = document.getElementById("persen_2");
    let persen_3 = document.getElementById("persen_3");
    let persen_4 = document.getElementById("persen_4");
    let nominal_1 = document.getElementById("nominal_1");
    let nominal_2 = document.getElementById("nominal_2");
    let nominal_3 = document.getElementById("nominal_3");
    let nominal_4 = document.getElementById("nominal_4");

    const nominal_insentif = document.getElementById("nominal_insentif");

    let nom1 =
        (toNumber(persen_1.dataset.rawValue || persen_1.value) / 100) *
        toNumber(nominal_insentif.value);
    let nom2 =
        (toNumber(persen_2.dataset.rawValue || persen_2.value) / 100) *
        toNumber(nominal_insentif.value);
    let nom3 =
        (toNumber(persen_3.dataset.rawValue || persen_3.value) / 100) *
        toNumber(nominal_insentif.value);
    let nom4 =
        (toNumber(persen_4.dataset.rawValue || persen_4.value) / 100) *
        toNumber(nominal_insentif.value);

    nominal_1.value = setFormatRupiah(nom1);
    nominal_2.value = setFormatRupiah(nom2);
    nominal_3.value = setFormatRupiah(nom3);
    nominal_4.value = setFormatRupiah(nom4);

    [nominal_1, nominal_2, nominal_3, nominal_4].forEach((el) => {
        el.classList.add("is-valid");
        el.classList.remove("is-invalid");
    });
}

function toNumber(value) {
    return parseFloat(value.replace(/\./g, "").replace(",", ".")) || 0;
}

// Fungsi untuk mengubah angka ke format Rupiah
function setFormatRupiah(angka) {
    return angka.toLocaleString("id-ID");
}

// Tambahkan event listener ke semua input
function setInputs(Inputannya, fungsinya) {
    Inputannya.forEach((input) => {
        input.addEventListener("input", formatInput); // Memastikan input tetap berformat Rupiah
        input.addEventListener("keyup", fungsinya); // Memastikan perhitungan tetap berjalan
    });
}

// Fungsi untuk memastikan input selalu dalam format Rupiah saat diketik
function formatInput(event) {
    let rawValue = event.target.value.replace(/\./g, "").replace(",", ".");
    event.target.dataset.rawValue = rawValue; // Simpan nilai asli untuk perhitungan
    event.target.value = setFormatRupiah(parseFloat(rawValue) || 0); // Tampilkan dengan format Rupiah
}
