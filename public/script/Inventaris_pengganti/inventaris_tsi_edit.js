//  ========================================
// {{ add data modal }}
// protect form input
$("input").attr("autocomplete", "off");
$(document).ready(function () {
    $(".input").addClass("border-success");

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
    var currentElement = document.getElementById(
        `harga_pembelian_non_${counter}`
    );

    // Periksa apakah elemen ada sebelum menetapkan listener
    if (currentElement) {
        hargaPembelianElements[`harga_pembelian_non_${counter}`] =
            currentElement;

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

// kondisi
// lainnya terbaru
$("#jns_pembelian").on("change", function () {
    var selectopt = $(this).val();
    var kategori_barang = $("#kategori_barang").val();
    var elektronik = document.getElementById("pembungkus_elektronik");

    console.log(kategori_barang);

    if (selectopt == "Pembelian Dengan Speksifikasi KPM") {
        elektronik.classList.add("d-none");
        $(elektronik).find(".form-control").prop("required", false);
    } else {
        elektronik.classList.remove("d-none");
        $(elektronik).find(".form-control").prop("required", false);
    }
});

// =========================-
// {{ tambah Data PEmbanding }}
// UNTUK ELEKTRONIK
document.addEventListener("DOMContentLoaded", function () {
    var container = document.getElementById(
        "tambah_barang_pembanding_elektronik_card_tsi"
    ); // Ganti dengan ID atau selektor yang sesuai

    container.addEventListener("input", function (event) {
        event.target.classList.add("border-danger");
        // Periksa apakah elemen yang memicu perubahan input adalah input dengan class 'form-control border-danger'
        if (event.target.classList.contains("form-control border-danger")) {
            // Jika input tidak kosong, ganti kelas menjadi 'border-success'
            if (event.target.value.trim() !== "") {
                event.target.classList.remove("border-danger");
                event.target.classList.add("border-success");
            } else {
                // Jika input kosong, ganti kelas menjadi 'border-danger'
                event.target.classList.remove("border-success");
                event.target.classList.add("border-danger");
            }
        }
    });

    var addButton = document.querySelector(
        'input[value="(+) Tambah Barang Pembanding Elektronik (+)"]'
    );
    var container = document.getElementById(
        "tambah_barang_pembanding_elektronik_card_tsi"
    );

    addButton.addEventListener("click", function () {
        // Temukan semua elemen input dengan nama yang sesuai pola
        var inputElements = document.querySelectorAll(
            'input[name^="jns_barang_"]'
        );

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
                        <h5 style="font-weight: bold; font-style: italic; color: rgb(0, 101, 252)">Data
                            Pembanding Barang Elektronik ${counter}
                            &#8628;</h5>
                        <hr style="width: 95%; margin-left: 5px">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="wajib" for="jns_barang_${counter}">Jenis Barang :</label>
                                <input type="text" name="jns_barang_${counter}" id="jns_barang_${counter}"
                                    class="form-control input border-danger"
                                    placeholder="ex: Printer/Komputer/Laptop atau yang lainnya">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="wajib" for="merk_${counter}">Merk :</label>
                                <input type="text" name="merk_${counter}" id="merk_${counter}"
                                    class="form-control input border-danger" placeholder="Merk">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="wajib" for="type_${counter}">Type :</label>
                                <input type="text" name="type_${counter}" id="type_${counter}"
                                    class="form-control input border-danger" placeholder="Type">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="wajib" for="nama_toko_${counter}">Nama Toko :</label>
                                <input type="text" name="nama_toko_${counter}" id="nama_toko_${counter}"
                                    class="form-control input border-danger"
                                    placeholder="Nama Toko (Market) - ex: ABC (Tokopedia)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="wajib" for="harga_pembelian_${counter}">Harga :</label>
                                <input type="text" name="harga_pembelian_${counter}" id="harga_pembelian_${counter}"
                                    class="form-control input border-danger" placeholder="Harga">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="wajib" for="file_detail_toko_${counter}">File Detail Toko
                                    (PNG/JPG/JPEG/RAR/ZIP) :</label>
                                <input type="file" name="file_detail_toko_${counter}" id="file_detail_toko_${counter}"
                                    class="form-control input border-danger"
                                    accept="image/jpeg,image/jpg,image/png, .zip, .rar, .7zip">
                            </div>
                        </div>
                        <input class="btn btn-outline-danger mb-1" type="button" value="(-) Kurangi Data Pembanding Elektronik (-)">
                `;

            newDiv.innerHTML = innerHTML;
            container.appendChild(newDiv);
        } else {
            alert("Melebihi Batas Data Pembanding!");
        }

        // harga pembelian
        var currentElement = document.getElementById(
            `harga_pembelian_${counter}`
        );

        // Periksa apakah elemen ada sebelum menetapkan listener
        if (currentElement) {
            hargaPembelianElements[`harga_pembelian_${counter}`] =
                currentElement;

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
            e.target.value === "(-) Kurangi Data Pembanding Elektronik (-)"
        ) {
            e.preventDefault();
            var currentDiv = e.target.parentNode;
            container.removeChild(currentDiv);
            counter--;
        }
    });
});
