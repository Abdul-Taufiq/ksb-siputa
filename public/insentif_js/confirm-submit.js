$("#simpan").on("click", function () {
    // Ganti #nama_form sesuai dengan ID formulir Anda
    var $form = $("#quickForm");

    // Validasi input yang diperlukan
    var inputRequired = $form.find("[required]");

    var inputKosong = inputRequired.filter(function () {
        var val = $(this).val();
        return val === null || val.trim() === "";
    });
    console.log(inputKosong);

    if (inputKosong.length > 0) {
        // Jika ada input yang kosong, tampilkan alert gagal simpan
        Swal.fire({
            title: "Gagal Simpan Data!",
            text: "ADA DATA MANDATORI YANG BELUM DIISI, PASTIKAN UNTUK MENGISI SEMUA DATA MANDATORI!",
            icon: "error",
        });
        return;
    } else {
        // Jika semua input diperlukan sudah terisi, tampilkan konfirmasi simpan
        Swal.fire({
            title: "Konfirmasi Simpan Data!",
            text: "SEBELUM MENYIMPAN DATA HARAP PERHATIKAN BAHWA DATA SUDAH BENAR! DAN JANGAN LEWATKAN PERINGATAN SEKECIL APAPUN!",
            icon: "info",
            theme: document.body.classList.contains("darkmode")
                ? "dark"
                : "light",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $form.submit();
            }
        });
    }
});
