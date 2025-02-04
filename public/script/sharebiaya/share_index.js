$(document).ready(function () {
    loadtable();
});

function loadtable(min, max) {
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
            url: "share-biaya",
            data: {
                min: min,
                max: max,
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
                data: "tgl_transaksi",
                name: "tgl_transaksi",
            },
            {
                data: "kc",
                name: "kc",
            },
            {
                data: "nominal",
                name: "nominal",
            },
            {
                data: "keterangan",
                name: "keterangan",
            },
            {
                data: "file",
                name: "file",
                render: function (data, type, row) {
                    // Menggunakan jQuery untuk menginisialisasi HTML dari string
                    // return $('<div/>').html(data).text(); //berhasil
                    // atau
                    var div = document.createElement("div");
                    div.innerHTML = data;
                    return div.innerText;
                },
                sortable: false,
                orderColumn: false,
                ordering: false,
                searchable: false,
            },

            {
                data: null,
                render: function (data, type, row) {
                    return moment(data.created_at)
                        .locale("id")
                        .format("DD MMM YYYY, HH:mm");
                },
                searchable: false,
            },
            {
                data: null,
                render: function (data, type, row) {
                    return moment(data.updated_at)
                        .locale("id")
                        .format("DD MMM YYYY, HH:mm");
                },
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
                targets: [4, 6, 7],
                visible: false,
                searchable: false,
            },
        ],

        dom:
            "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",

        buttons: [
            "colvis",
            {
                extend: "copyHtml5",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
            {
                extend: "excelHtml5",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
            {
                extend: "pdfHtml5",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
        ],

        lengthMenu: [
            [10, 20, 50, -1],
            [10, 20, 50, "Semua"],
        ],
    });
}

$(document).on("click", "#btn-filter", function () {
    let minDate = new Date($("#min").val());
    let maxDate = new Date($("#max").val());
    let min = $("#min").val();
    let max = $("#max").val();

    // console.log("Min" + min + " Max" + max);
    if (minDate > maxDate) {
        alert("Filter Tidak Valid!");
        return; // Mencegah eksekusi lanjut jika filter tidak valid
    }

    $("#table_index").DataTable().destroy();
    loadtable(min, max);
});

$(document).on("click", "#btn-refresh", function () {
    $("#table_index").DataTable().destroy();
    loadtable();
});

// {{ detail data modal }}
$(document).ready(function () {
    $("body").on("click", ".detail_data", function () {
        var Id = $(this).attr("id");
        var kode_form = $(this).data("kc");

        var modalId = "myModal" + Id;
        $("#myModal").attr("id", modalId); //merubah id dari modal
        $("#modalHeader").text("DETAIL DATA - " + kode_form);
        $("#frameDetail").attr("src", "/share-biaya/" + Id); //merubah link frame

        // Tambahkan event listener untuk menangkap penutupan modal
        $("#" + modalId).on("hidden.bs.modal", function () {
            // Kembalikan ID modal ke nilai default
            $(this).attr("id", "myModal");
        });
    });
});
// end detail
