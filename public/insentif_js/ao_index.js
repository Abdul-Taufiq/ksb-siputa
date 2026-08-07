// Data tables
$(document).ready(function () {
    loadtable();
});

function loadtable(min, max, id_cabang, cari) {
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
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                    },
                },
                {
                    extend: "excelHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                    },
                },
                {
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
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
            order: [[1, "desc"]], // default urut kolom pertama (atau sesuaikan)
            ajax: {
                // type: "post",
                url: "/insentif/ao",
                data: function (d) {
                    d.min = min;
                    d.max = max;
                    d.id_cabang = id_cabang;
                    d.kode = kode;
                    d.cari = cari;
                },
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
                    data: "cabang",
                    name: "cabang",
                },
                {
                    data: "nama_ao",
                    name: "nama_ao",
                },
                {
                    data: "hasil",
                    name: "hasil",
                    render: function (data, type, row) {
                        if (type === "display") {
                            // fungsi helper format rupiah
                            const formatRupiah = (angka) => {
                                return (
                                    "Rp " +
                                    parseInt(angka, 10).toLocaleString("id-ID")
                                );
                            };

                            return `
                                <b>Periode: </b> ${row.periode}<br>
                                <b>Target: </b> ${formatRupiah(row.target)}<br>
                                <b>Pencapaian: </b> ${formatRupiah(row.pencapaian)}<br>
                                <b>Hasil: </b> ${row.hasil}<br>
                            `;
                        }
                        return data;
                    },
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
                    sortable: false,
                    orderColumn: false,
                    ordering: false,
                    searchable: false,
                },
                {
                    data: "action",
                    name: "action",
                    sortable: false,
                    orderColumn: false,
                    ordering: false,
                    searchable: false,
                },
            ],

            columnDefs: [
                {
                    targets: [5, 6],
                    visible: false,
                },
            ],

            dom:
                "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            buttons: buttons,
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "Semua"],
            ],
        });
    });
}

$(document).on("click", "#btn-filter", function () {
    let min = $("#min").val();
    let max = $("#max").val();
    let id_cabang = $("#id_cabang").val();
    $("#table_index").DataTable().destroy();
    loadtable(min, max, id_cabang);
});

$(document).on("click", "#btn-refresh", function () {
    $("#table_index").DataTable().destroy();
    loadtable();
});

$(document).on("click", "#btn-cari", function () {
    let cari = $("#cari").val().trim(); // Menggunakan trim() untuk menghapus spasi di awal dan akhir input.
    $("#table_index").DataTable().destroy();
    loadtable(null, null, id_cabang, cari); // Menggunakan fungsi loadtable dengan tiga argumen, di mana argumen ketiga adalah nilai input pencarian.
});
// end datatables

//  =
//
//  =

//  ========================================
//  ========================================
// {{ detail data modal }}
$(document).ready(function () {
    $("body").on("click", ".detail_data", function () {
        var Id = $(this).attr("id");
        var kode_form = $(this).data("kode_form");

        var modalId = "myModal" + Id;
        // console.log(modalId);

        $("#myModal").attr("id", modalId); //merubah id dari modal
        $("#modalHeader").text("DETAIL DATA - " + kode_form);
        $("#frameDetail").attr("src", "/insentif/ao/" + Id); //merubah link frame

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
//approve data modal
$(document).ready(function () {
    $("body").on("click", ".approve", function () {
        var id = $(this).data("id");
        var kode = $(this).data("kode_form");
        $("#encryptedId").val(id);

        // console.log("Nama Kredit:", id, kode);
        console.log("Copyright by Abdul Taufiq");
        $("#modalApproveLabel").text("APPROVE DATA " + kode);
        // Ubah action form untuk menyertakan ID
        var formAction = "/insentif/get-ao-status/" + id + "/Approve";
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
        var id = $(this).data("id");
        var kode = $(this).data("kode_form");
        $("#encryptedId").val(id);

        // console.log("Nama Kredit:", id, kode);
        console.log("Copyright by Abdul Taufiq");
        $("#modalRejectLabel").text("REJECT DATA " + kode);
        // Ubah action form untuk menyertakan ID
        var formAction = "/insentif/get-ao-status/" + id + "/Reject";
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
