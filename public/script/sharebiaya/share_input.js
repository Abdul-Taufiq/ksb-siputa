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

// rupiah
var nominal = document.getElementById("nominal");
nominal.addEventListener("input", function (e) {
    this.value = formatRupiah(this.value, "Rp. ");
});

// edit data
$(document).ready(function () {
    $("body").on("click", ".edit", function () {
        var Id = $(this).attr("id");
        var Kode = $(this).data("kc");

        // console.log("Nama Kredit:", Id, Kode);
        // console.log("Copyright by Abdul Taufiq");
        $("#modalEditLabel").text("EDIT DATA - " + Kode);
        $("#modalEdit").modal("show");

        // Setiap kali tombol edit diklik, atur border menjadi border-success
        $("#editForm .input")
            .addClass("border-success")
            .removeClass("border-danger");

        $(document).on("input", "#editForm .input", function () {
            if ($(this).val().trim() === "") {
                // Jika kosong, berikan border warna merah dan hapus border warna hijau
                $(this).addClass("border-danger").removeClass("border-success");
            } else {
                // Jika tidak kosong, berikan border warna hijau dan hapus border warna merah
                $(this).addClass("border-success").removeClass("border-danger");
            }

            // rupiah
            var nominal = document.getElementById("nominal_edit");
            nominal.addEventListener("input", function (e) {
                this.value = formatRupiah(this.value, "Rp. ");
            });
        });

        $.ajax({
            type: "GET",
            url: "/share-biaya/" + Id + "/edit",
            success: function (response) {
                $("#kc_info").text(response.data.kc);
                $("#tgl_transaksi_info").text(response.tgl);
                $("#nominal_info").text(response.data.nominal);
                $("#lampiran_file_info").html(response.file);
                $("#keterangan_info").text(response.data.keterangan);

                // link formnya
                $("#editForm").attr("action", "/share-biaya/" + Id);
            },
        });
    });
});
// end edit data
