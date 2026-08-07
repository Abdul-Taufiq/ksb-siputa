//
// Tambahkan event listener ke semua elemen dengan class "setRp"
document.querySelectorAll(".setRp").forEach(function (input) {
    input.addEventListener("input", function () {
        this.value = formatRupiah(this.value);
    });
});

function setRupiah() {
    document.querySelectorAll(".setRp").forEach(function (input) {
        input.addEventListener("input", function () {
            this.value = formatRupiah(this.value);
        });
    });
}

/* Fungsi formatRupiah */
function formatRupiah(angka) {
    var numberString = angka.replace(/[^,\d]/g, "").toString(),
        split = numberString.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;

    return rupiah;
}

// Fungsi untuk mengubah angka ke format Rupiah
function setFormatRupiah(angka) {
    return angka.toLocaleString("id-ID");
}
