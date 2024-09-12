//  ========================================
// {{ add data modal }}
// protect form input
$("input").attr("autocomplete", "off");
$(document).ready(function () {
    // default form danger
    $(".input").addClass("border-danger");
    $(document).ready(function () {
        // default form danger
        $(".input").addClass("border-danger");
    });

    $(document).on("input", ".input", function () {
        if ($(this).val().trim() === "") {
            // Jika kosong, berikan border warna merah dan hapus border warna hijau
            $(this).addClass("border-danger").removeClass("border-success");
        } else {
            // Jika tidak kosong, berikan border warna hijau dan hapus border warna merah
            $(this).addClass("border-success").removeClass("border-danger");
        }
    });
});

// Rp.
var hargaPembelianElements = {};

for (var counter = 1; counter <= 50; counter++) {
    var currentElement = document.getElementById(`harga_pembelian_${counter}`);

    // Periksa apakah elemen ada sebelum menetapkan listener
    if (currentElement) {
        hargaPembelianElements[`harga_pembelian_${counter}`] = currentElement;

        // Menetapkan listener ke setiap elemen harga_pembelian
        currentElement.addEventListener("input", function (e) {
            this.value = formatRupiah(this.value, "Rp. ");
        });
    }
}
for (var counter = 1; counter <= 50; counter++) {
    var currentElement = document.getElementById(`harga_tawar_${counter}`);

    // Periksa apakah elemen ada sebelum menetapkan listener
    if (currentElement) {
        hargaPembelianElements[`harga_tawar_${counter}`] = currentElement;

        // Menetapkan listener ke setiap elemen harga_pembelian
        currentElement.addEventListener("input", function (e) {
            this.value = formatRupiah(this.value, "Rp. ");
        });
    }
}

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
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

    return prefix && rupiah ? prefix + rupiah : rupiah;
}
// {{ End Nomor Rupiah }}

//summernote
function initializeSummernote(selector, placeholder, height) {
    $(selector).summernote({
        placeholder: placeholder,
        tabsize: 2,
        height: height,
        callbacks: {
            onInit: function () {
                // Menambahkan kelas CSS ke elemen yang dihasilkan oleh Summernote
                $(selector).next(".note-editor").addClass("input");
            },
        },
    });
}

// Inisialisasi Summernote dengan selector, placeholder, dan tinggi yang berbeda
initializeSummernote(`#detail_barang`, "Detail merk, type dan lainnya...", 200);
initializeSummernote(`#kondisi_terakhir`, "Kondisi Terakhir barangnya...", 200);
initializeSummernote(`#keterangan`, "Keterangan...", 100);

// event hendrler summernote
$(document).on("summernote.change", function (e, contents) {
    var $editor = $(e.target).next(".note-editor");

    // Jika konten editor kosong, tambahkan kelas "border-danger", dan hapus kelas "border-success"
    if (contents.trim() === "") {
        $editor.addClass("border-danger").removeClass("border-success");
    } else {
        // Jika konten editor tidak kosong, tambahkan kelas "border-success", dan hapus kelas "border-danger"
        $editor.addClass("border-success").removeClass("border-danger");
    }
});
// Menonaktifkan tombol codeview untuk semua editor Summernote
$(".btn-codeview").prop("disabled", true);
$(".btn-fullscreen").prop("disabled", true);
$(".note-insert button").prop("disabled", true);

document.addEventListener("DOMContentLoaded", function () {
    var container = document.getElementById("tambah_penawar_card"); // Ganti dengan ID atau selektor yang sesuai

    var addButton = document.querySelector(
        'input[value="(+) Tambah Penawar (+)"]'
    );
    var container = document.getElementById("tambah_penawar_card");

    addButton.addEventListener("click", function () {
        // Temukan semua elemen input dengan nama yang sesuai pola
        var inputElements = document.querySelectorAll('input[name^="nik_"]');

        // Mencari nomor terbesar dari nama input
        var angka_besar = 0;

        if (inputElements.length > 0) {
            inputElements.forEach(function (inputElement) {
                // Menggunakan ekspresi reguler untuk mencocokkan nomor pada nama input
                var match = inputElement.name.match(/\d+/);

                // Jika ada kecocokan dan nomornya lebih besar dari yang sudah ada
                if (match && parseInt(match[0]) > angka_besar) {
                    counter = parseInt(match[0]);
                }
            });
        } else {
            counter = 0;
        }

        // Menampilkan nomor terbesar
        // console.log("Nomor Terbesar: " + counter);
        counter++;

        if (counter <= 10) {
            // Buat elemen-elemen baru
            var newDiv = document.createElement("div");
            newDiv.className = "row  ml-2";

            var innerHTML = `
                        <div class="col-md-12">
                            <div class="header-container">
                                <div class="header-line"></div>
                                <div class="header-text">DATA PENAWAR ${counter}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik_${counter}">NIK :</label>
                                <input required type="text" name="nik_${counter}" id="nik_${counter}" required
                                    class="form-control border-danger input" placeholder="NIK Penawar">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_${counter}">Nama :</label>
                                <input required type="text" name="nama_${counter}" id="nama_${counter}" required
                                    class="form-control border-danger input" placeholder="Nama">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat_${counter}" class="wajib">Alamat :</label>
                                <textarea class="form-control border-danger input" name="alamat_${counter}" id="alamat_${counter}" cols="30"  required rows="3" placeholder="Alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga_tawar_${counter}" class="wajib">Harga Tawar :</label>
                                <input required type="text" name="harga_tawar_${counter}" id="harga_tawar_${counter}" required
                                    class="form-control border-danger input" placeholder="Harga Tawar">
                            </div>
                        </div>

                        <input class="btn btn-outline-danger mb-1" type="button" value="(-) Kurangi Penawar (-)">
                `;

            newDiv.innerHTML = innerHTML;
            container.appendChild(newDiv);
        } else {
            alert("Melebihi Batas Data Pembanding!");
        }

        // harga pembelian
        var currentElement = document.getElementById(`harga_tawar_${counter}`);

        // Periksa apakah elemen ada sebelum menetapkan listener
        if (currentElement) {
            hargaPembelianElements[`harga_tawar_${counter}`] = currentElement;

            // Menetapkan listener ke setiap elemen harga_pembelian
            currentElement.addEventListener("input", function (e) {
                this.value = RupiahSpesial(this.value, "Rp. ");
            });
        }

        /* Fungsi RupiahSpesial */
        function RupiahSpesial(angka, prefix) {
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

            return prefix && rupiah ? prefix + rupiah : rupiah;
        }
        // {{ End Nomor Rupiah }}
    });

    // Untuk mengurangi inputan
    container.addEventListener("click", function (e) {
        if (
            e.target.tagName === "INPUT" &&
            e.target.value === "(-) Kurangi Penawar (-)"
        ) {
            e.preventDefault();
            var currentDiv = e.target.parentNode;
            container.removeChild(currentDiv);
            counter--;
        }
    });
});
