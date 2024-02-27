// Data tables
$(document).ready(function () {
    loadtable();
});

function loadtable(min, max, cari) {
    $(document).ready(function () {
        // Mendapatkan nilai kode dari URL (jika ada)
        var urlParams = new URLSearchParams(window.location.search);
        var kode = urlParams.get("kode");

        // kondisi memunculkan button export
        var level = $("#user").val();
        var buttons = ["colvis"];
        if (level == "SUPER USER" || level == "DIREKTUR") {
            var show = true;
        } else {
            var show = false;
        }

        if (show) {
            buttons.push([
                {
                    extend: "copyHtml5",
                    // exportOptions: {
                    //     columns: [
                    //         0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
                    //         15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27,
                    //     ],
                    // },
                },
                {
                    extend: "excelHtml5",
                    // exportOptions: {
                    //     columns: [
                    //         0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
                    //         15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27,
                    //     ],
                    // },
                },
                {
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                    },
                },
            ]);
        }
        // End kondisi memunculkan button export

        $("#table_index").DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,

            processing: true,
            serverSide: true,
            ajax: {
                // type: "post",
                url: "user-ecoll",
                data: {
                    min: min,
                    max: max,
                    kode: kode,
                    cari: cari,
                },
                // headers: {
                //     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                //         "content"
                //     ),
                // },
            },
            columns: [
                {
                    data: null,
                    sortable: false,
                    orderColumn: false,
                    ordering: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "kode_form",
                    name: "kode_form",
                },
                {
                    data: "id_cabang",
                    name: "id_cabang.cabang",
                },
                {
                    data: "keperluan",
                    name: "keperluan",
                },
                {
                    data: "nik",
                    name: "nik",
                },
                {
                    data: "nama",
                    name: "nama",
                },
                {
                    data: "jabatan",
                    name: "jabatan",
                },
                {
                    data: "keterangan",
                    name: "keterangan",
                },

                {
                    data: null,
                    render: function (data, type, row) {
                        return moment(data.created_at)
                            .locale("id")
                            .format("DD MMM YYYY, HH:mm");
                    },
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return moment(data.updated_at)
                            .locale("id")
                            .format("DD MMM YYYY, HH:mm");
                    },
                },
                {
                    data: "status",
                    name: "status",
                },
                {
                    data: "action",
                    name: "action",
                },
            ],

            columnDefs: [
                {
                    targets: [7, 8, 9],
                    visible: false,
                },
            ],

            dom:
                "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            buttons: buttons,
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "Semua"],
            ],
        });
    });
}

$(document).on("click", "#btn-filter", function () {
    let min = $("#min").val();
    let max = $("#max").val();
    $("#table_index").DataTable().destroy();
    loadtable(min, max);
});

$(document).on("click", "#btn-refresh", function () {
    $("#table_index").DataTable().destroy();
    loadtable();
});

$(document).on("click", "#btn-cari", function () {
    let cari = $("#cari").val().trim(); // Menggunakan trim() untuk menghapus spasi di awal dan akhir input.
    $("#table_index").DataTable().destroy();
    loadtable(null, null, cari); // Menggunakan fungsi loadtable dengan tiga argumen, di mana argumen ketiga adalah nilai input pencarian.
});
// end datatables

//
//
//

//  ========================================
// {{ detail data modal }}
$(document).ready(function () {
    $("body").on("click", ".detail_data", function () {
        var Id = $(this).attr("id");
        var kode_form = $(this).data("kode_form");

        var modalId = "myModal" + Id;
        $("#myModal").attr("id", modalId); //merubah id dari modal
        $("#modalHeader").text("DETAIL DATA - " + kode_form);
        $("#frameDetail").attr("src", "/user-ecoll/" + Id); //merubah link frame

        // Tambahkan event listener untuk menangkap penutupan modal
        $("#" + modalId).on("hidden.bs.modal", function () {
            // Kembalikan ID modal ke nilai default
            $(this).attr("id", "myModal");
        });
    });
});
// end detail

//
//
//
//

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

function hanyaAngka(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}
// end add data modal

//
//
//

//  ========================================
// edit data
$(document).ready(function () {
    $("body").on("click", ".edit", function () {
        var Id = $(this).attr("id");
        var Kode = $(this).data("kode_form");

        console.log("Nama Kredit:", Id, Kode);
        console.log("Copyright by Abdul Taufiq");
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
        });

        $.ajax({
            type: "GET",
            url: "/user-ecoll/" + Id + "/edit",
            success: function (response) {
                console.log("Rz wuzz here");
                $("#keperluan_edit").val(response.data.keperluan);
                $("#nik_edit").val(response.data.nik);
                $("#nama_edit").val(response.data.nama);
                $("#jabatan_edit").val(response.data.jabatan);
                $("#no_telp_edit").val(response.data.no_telp);
                $("#keterangan_edit").val(response.data.keterangan);
                console.log(response.data.nik);

                // link formnya
                $("#editForm").attr("action", "/user-ecoll/" + Id);
            },
        });
    });
});
// end edit data

//
//
//
//approve data modal
$(document).ready(function () {
    $("body").on("click", ".approve", function () {
        var idKredit = $(this).data("id");
        var NoSPK = $(this).data("kode_form");
        $("#encryptedId").val(idKredit);

        // console.log("Nama Kredit:", idKredit, NoSPK);
        console.log("Copyright by Abdul Taufiq");
        $("#modalApproveLabel").text("APPROVE DATA " + NoSPK);
        // Ubah action form untuk menyertakan ID
        var formAction = "/user-ecoll-approve/" + idKredit;
        $("#approveForm").attr("action", formAction);
    });

    $("#approveForm").submit(function (event) {
        // Dapatkan nilai textarea
        var rejectReason = $("#rejectReason").val();

        // Ubah nilai textarea menjadi input tersembunyi
        var hiddenInput = $("<input>")
            .attr("type", "hidden")
            .attr("name", "rejectReason")
            .val(rejectReason);
        $(this).append(hiddenInput);

        // Modal otomatis tertutup setelah klik "Simpan"
        $("#modalApprove").modal("hide");
    });
});

//
//
//
//rejexcct data modal
$(document).ready(function () {
    $("body").on("click", ".reject", function () {
        var idKredit = $(this).data("id");
        var NoSPK = $(this).data("kode_form");
        $("#encryptedId").val(idKredit);

        // console.log("Nama Kredit:", idKredit, NoSPK);
        console.log("Copyright by Abdul Taufiq");
        $("#modalRejectLabel").text("REJECT DATA " + NoSPK);
        // Ubah action form untuk menyertakan ID
        var formAction = "/user-ecoll-reject/" + idKredit;
        $("#rejectForm").attr("action", formAction);
    });

    $("#rejectForm").submit(function (event) {
        // Dapatkan nilai textarea
        var rejectReason = $("#rejectReason").val();

        // Ubah nilai textarea menjadi input tersembunyi
        var hiddenInput = $("<input>")
            .attr("type", "hidden")
            .attr("name", "rejectReason")
            .val(rejectReason);
        $(this).append(hiddenInput);

        // Modal otomatis tertutup setelah klik "Simpan"
        $("#modalReject").modal("hide");
    });
});
