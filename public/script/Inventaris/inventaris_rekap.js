$(document).on("click", "#btn-filter", function () {
    let min = $("#min").val();
    let max = $("#max").val();
    let pilih_laporan = $("#pilih_laporan").val();
    let id_cabang = $("#id_cabang").val();

    // Konversi string tanggal menjadi objek Date
    let minDate = new Date(min);
    let maxDate = new Date(max);

    if (!min || maxDate < minDate) {
        alert(
            "Filter Tanggal Tidak Valid! \n (Tanggal Akhir Lebih Kecil Dari Tanggal Awal)"
        );
    } else if (!id_cabang) {
        alert("Filter Kantor Cabang Tidak Boleh Kosong!");
    } else if (!pilih_laporan) {
        alert("Filter Objek Pemeriksaan Tidak Boleh Kosong!");
    } else if (!max) {
        let openning = document.getElementById("openning");
        openning.classList.add("d-none");
        maxDate = "11-11-1111";

        $("#rekap_inventaris").attr(
            "src",
            "/inventaris-rekap/" +
                min +
                "/" +
                maxDate +
                "/" +
                id_cabang +
                "/" +
                pilih_laporan
        ); //merubah link frame
    } else {
        // disable
        let openning = document.getElementById("openning");
        openning.classList.add("d-none");

        $("#rekap_inventaris").attr(
            "src",
            "/inventaris-rekap/" +
                min +
                "/" +
                max +
                "/" +
                id_cabang +
                "/" +
                pilih_laporan
        ); //merubah link frame
    }
});

$(document).on("click", "#btn-refresh", function () {
    $("#rekap_inventaris").attr("src", ""); //merubah link frame
    $("#min").val("");
    $("#max").val("");
    $("#id_cabang").val("00");
    $("#pilih_laporan").val("00");

    let openning = document.getElementById("openning");
    openning.classList.remove("d-none");
});

$(document).on("click", "#btn-cetak", function () {
    let min = $("#min").val();
    let max = $("#max").val();
    let pilih_laporan = $("#pilih_laporan").val();
    let id_cabang = $("#id_cabang").val();

    // Konversi string tanggal menjadi objek Date
    let minDate = new Date(min);
    let maxDate = new Date(max);

    if (!min || maxDate < minDate) {
        alert(
            "Filter Tanggal Tidak Valid! \n (Tanggal Akhir Lebih Kecil Dari Tanggal Awal)"
        );
    } else if (!id_cabang) {
        alert("Filter Kantor Cabang Tidak Boleh Kosong!");
    } else if (!pilih_laporan) {
        alert("Filter Objek Pemeriksaan Tidak Boleh Kosong!");
    } else if (!max) {
        let openning = document.getElementById("openning");
        openning.classList.add("d-none");
        maxDate = "11-11-1111";

        Swal.fire({
            title: "Konfirmasi Cetak",
            html: "Ada Ingin Mencetak File?",
            showCancelButton: true,
            confirmButtonText: "Cetak Data!",
            confirmButtonColor: "#27a844",
            cancelButtonColor: "#dc3546",
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(
                    "/inventaris-rekap-cetak/" +
                        min +
                        "/" +
                        maxDate +
                        "/" +
                        id_cabang +
                        "/" +
                        pilih_laporan,
                    "_blank" // Ini akan membuka link di tab baru
                );
            }
        });

        $("#rekap_inventaris").attr(
            "src",
            "/inventaris-rekap/" +
                min +
                "/" +
                maxDate +
                "/" +
                id_cabang +
                "/" +
                pilih_laporan
        ); // merubah link frame
    } else {
        let openning = document.getElementById("openning");
        openning.classList.add("d-none");

        Swal.fire({
            title: "Konfirmasi Cetak",
            html: "Ada Ingin Mencetak File?",
            showCancelButton: true,
            confirmButtonText: "Cetak Data!",
            confirmButtonColor: "#27a844",
            cancelButtonColor: "#dc3546",
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(
                    "/inventaris-rekap-cetak/" +
                        min +
                        "/" +
                        max +
                        "/" +
                        id_cabang +
                        "/" +
                        pilih_laporan,
                    "_blank" // Ini akan membuka link di tab baru
                );
            }
        });

        $("#rekap_inventaris").attr(
            "src",
            "/inventaris-rekap/" +
                min +
                "/" +
                max +
                "/" +
                id_cabang +
                "/" +
                pilih_laporan
        ); // merubah link frame
    }
});

// end datatables
