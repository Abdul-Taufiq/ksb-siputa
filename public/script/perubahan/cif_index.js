// Data tables
$(document).ready(function () {
    loadtable();
});

// preview images
function upload(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#image").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// preview images
function upload_edit(input) {
    $("#image_edit_head").removeClass("d-none");
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#image_edit").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

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
                url: "perubahan-cif",
                data: {
                    min: min,
                    max: max,
                    id_cabang: id_cabang,
                    kode: kode,
                    cari: cari,
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
                    data: "id_cabang",
                    name: "id_cabang.cabang",
                },
                {
                    data: "jns_cif",
                    name: "jns_cif",
                },
                {
                    data: "nama_nasabah",
                    name: "nama_nasabah",
                },
                {
                    data: "no_cif_utama",
                    name: "no_cif_utama",
                },
                {
                    data: "no_cif_merger",
                    name: "no_cif_merger",
                },
                {
                    data: "ktp",
                    name: "ktp",
                },
                // {
                //     data: "ktp",
                //     name: "ktp",
                //     render: function(data, type, row) {
                //         return '<a href="' + '{{ asset('file_upload/perubahan data') }}' +
                //             '/' + data + '" target="_blank">' + data + '</a>';
                //     }
                // },
                {
                    data: "nama_ibu",
                    name: "nama_ibu",
                },
                {
                    data: "alasan",
                    name: "alasan",
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
                    targets: [6, 7, 8, 9, 10, 11, 12],
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
        console.log(Id);
        $("#myModal").attr("id", modalId); //merubah id dari modal
        $("#modalHeader").text("DETAIL DATA - " + kode_form);
        $("#frameDetail").attr("src", "/perubahan-cif/" + Id); //merubah link frame

        // Tambahkan event listener untuk menangkap penutupan modal
        $("#" + modalId).on("hidden.bs.modal", function () {
            // Kembalikan ID modal ke nilai default
            $(this).attr("id", "myModal");
        });
    });
});
// end detail

//  =
//
//  =

//  ========================================
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

//
//

// =========================-
// {{ tambah }}
document.addEventListener("DOMContentLoaded", function () {
    var container = document.getElementById("tambah_cif_card"); // Ganti dengan ID atau selektor yang sesuai

    container.addEventListener("input", function (event) {
        // Periksa apakah elemen yang memicu perubahan input adalah input dengan class 'form-control border-danger'
        if (event.target.classList.contains("khusus")) {
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
        'input[value="(+) Tambah No CIF (+)"]'
    );
    var container = document.getElementById("tambah_cif_card");

    addButton.addEventListener("click", function () {
        // Temukan semua elemen input dengan nama yang sesuai pola
        var inputElements = document.querySelectorAll(
            'input[name^="no_cif_merger_"]'
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
        console.log("Nomor Terbesar: " + counter);
        counter++;

        if (counter <= 5) {
            // Buat elemen-elemen baru
            var newDiv = document.createElement("div");
            newDiv.className = "col-md-6";

            var innerHTML = `
                        <div class="form-group">
                            <label for="no_cif_merger_${counter}">No CIF Merger ${counter} :</label>
                            <input type="text" name="no_cif_merger_${counter}" id="no_cif_merger_${counter}"
                                class="form-control border-danger khusus" placeholder="No CIF Merger ${counter}" required>
                        </div>
                        <input style="margin-top: -18px; margin-bottom: 10px;" class="btn btn-outline-warning" type="button" value="(-) Kurangi No CIF (-)"> 
                `;

            newDiv.innerHTML = innerHTML;
            container.appendChild(newDiv);
        } else {
            alert("Melebihi Batas Nomor Merger CIF!");
        }
    });

    // Untuk mengurangi inputan
    container.addEventListener("click", function (e) {
        if (
            e.target.tagName === "INPUT" &&
            e.target.value === "(-) Kurangi No CIF (-)"
        ) {
            e.preventDefault();
            var currentDiv = e.target.parentNode;
            container.removeChild(currentDiv);
            counter--;
        }
    });
});

//
//

// pembatasan input
$("#jns_cif").on("change", function () {
    var selectopt = $(this).val();
    var no_cif_merger_1 = document.getElementById("no_cif_merger_1_head");
    var alasan = document.getElementById("alasan_head");
    var tambah = document.getElementById("tambah_cif_card");

    if (selectopt == "Merger CIF") {
        no_cif_merger_1.classList.remove("d-none");
        alasan.classList.remove("d-none");
        tambah.classList.remove("d-none");
        // $("#non_aktif").prop("readonly", true);
        // $("#non_aktif").addClass("border-success").removeClass("border-danger");
    }
    //
    else if (selectopt == "Pengkinian Data CIF") {
        no_cif_merger_1.classList.add("d-none");
        alasan.classList.add("d-none");
        tambah.classList.add("d-none");
        // $("#non_aktif").prop("readonly", false);
        // $("#non_aktif").addClass("border-danger").removeClass("border-success");
    }
});
// end add data modal

//  =
//
//  =
//
//  ========================================
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

        // pembatasan input
        $("#jns_cif_edit").on("change", function () {
            var selectopt = $(this).val();
            var ktp = document.getElementById("ktp_head_edit");
            var nama_ibu = document.getElementById("nama_ibu_head_edit");
            var no_cif_merger_1 = document.getElementById(
                "no_cif_merger_head_edit"
            );
            var alasan = document.getElementById("alasan_head_edit");

            if (selectopt == "Merger CIF") {
                ktp.classList.add("d-none");
                nama_ibu.classList.add("d-none");
                no_cif_merger_1.classList.remove("d-none");
                alasan.classList.remove("d-none");
            }
            //
            else if (selectopt == "Pengkinian Data CIF") {
                ktp.classList.remove("d-none");
                nama_ibu.classList.remove("d-none");
                no_cif_merger_1.classList.add("d-none");
                alasan.classList.add("d-none");
            }
        });
        // end add data modal

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
            url: "/perubahan-cif/" + Id + "/edit",
            success: function (response) {
                console.log("Rz wuzz here");
                $("#jns_cif_edit").val(response.data.jns_cif);
                $("#nama_nasabah_edit").val(response.data.nama_nasabah);
                $("#no_cif_utama_edit").val(response.data.no_cif_utama);

                $("#no_cif_merger_edit").val(response.data.no_cif_merger);
                $("#alasan_edit").val(response.data.alasan);
                // $("#user_edit").val(response.data.user);
                $("#nama_ibu_edit").val(response.data.nama_ibu);
                $("#keterangan_edit").val(response.data.keterangan);

                // Get a reference to our file input
                const fileInput = document.getElementById("ktp_edit");

                // Create a new File object
                const myFile = new File(["Hello World!"], response.data.ktp, {
                    type: "image/jpeg,image/jpg,image/png",
                    lastModified: new Date(),
                });

                // Now let's create a DataTransfer to get a FileList
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(myFile);
                fileInput.files = dataTransfer.files;

                var ktp = document.getElementById("ktp_head_edit");
                var nama_ibu = document.getElementById("nama_ibu_head_edit");
                var no_cif_merger_1 = document.getElementById(
                    "no_cif_merger_head_edit"
                );
                var alasan = document.getElementById("alasan_head_edit");

                if (response.data.jns_cif == "Merger CIF") {
                    ktp.classList.add("d-none");
                    nama_ibu.classList.add("d-none");
                    no_cif_merger_1.classList.remove("d-none");
                    alasan.classList.remove("d-none");
                }
                //
                else if (response.data.jns_cif == "Pengkinian Data CIF") {
                    ktp.classList.remove("d-none");
                    nama_ibu.classList.remove("d-none");
                    no_cif_merger_1.classList.add("d-none");
                    alasan.classList.add("d-none");
                }

                // link formnya
                $("#editForm").attr("action", "/perubahan-cif/" + Id);
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
        var formAction = "/perubahan-cif-approve/" + idKredit;
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
        var formAction = "/perubahan-cif-reject/" + idKredit;
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
