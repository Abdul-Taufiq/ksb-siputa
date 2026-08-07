$("input").attr("autocomplete", "off");
$(document).ready(function () {
    // Default semua form diberi border merah
    $(".input").addClass("is-invalid");

    // Event listener untuk semua elemen dengan class .input
    $(document).on("input change", ".input", function () {
        var value = $(this).val();

        if (value && value.toString().trim() !== "") {
            // Ada value → hijau
            $(this).addClass("is-valid").removeClass("is-invalid");
        } else {
            // Kosong → merah
            $(this).addClass("is-invalid").removeClass("is-valid");
        }
    });

    // Cek kondisi awal (misalnya form edit sudah ada value)
    $(".input").each(function () {
        var value = $(this).val();
        if (value && value.toString().trim() !== "") {
            $(this).addClass("is-valid").removeClass("is-invalid");
        }
    });
});

let before_kode_form = $("#kode_form_sebelumnya");
let div_kode_form = $("#head_kode_form_sebelumnya");
$("#status_form").on("change", function () {
    if ($(this).val() === "Dilimpahkan") {
        before_kode_form.prop("required", true);
        div_kode_form.removeClass("d-none");
    } else {
        before_kode_form.prop("required", false);
        div_kode_form.addClass("d-none");
    }
});

// tambah data
document.addEventListener("DOMContentLoaded", function () {
    let container = document.getElementById("tambahan_data_debitur");

    container.addEventListener("input", function (event) {
        if (event.target.classList.contains("setRp")) {
            event.target.value = formatRupiah(event.target.value);
        }
    });

    container.addEventListener("input", function (event) {
        // Jika input tidak kosong, ganti kelas menjadi 'is-valid'
        if (event.target.value.trim() !== "") {
            event.target.classList.remove("is-invalid");
            event.target.classList.add("is-valid");
        } else {
            // Jika input kosong, ganti kelas menjadi 'is-invalid'
            event.target.classList.remove("is-valid");
            event.target.classList.add("is-invalid");
        }
    });

    const addBtn = document.getElementById("tambah_data");

    addBtn.addEventListener("click", function () {
        let inputElement = document.querySelectorAll('input[name^="nama_"]');

        let angka_besar = 0;
        let counter = 0;

        if (inputElement.length > 0) {
            inputElement.forEach(function (inputEl) {
                var match = inputEl.name.match(/\d+/);

                if (match && parseInt(match[0]) > angka_besar) {
                    counter = parseInt(match[0]);
                }
            });
        } else {
            counter = 0;
        }

        // console.log("Nomor Terbesar: " + counter);
        counter++;

        if (counter <= 50) {
            let newTr = document.createElement("tr");

            let innerHTML = `
                                <td>
                                    ${counter}
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm input is-invalid"
                                        id="nama_${counter}" name="nama_${counter}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm input is-invalid"
                                        id="norek_${counter}" name="norek_${counter}" required>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text"
                                            class="form-control form-control-sm is-invalid input setRp" id="plafond_${counter}"
                                            name="plafond_${counter}" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text"
                                            class="form-control form-control-sm is-invalid input setRp"
                                            id="bakidebet_${counter}" name="bakidebet_${counter}" required>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm is-invalid input"
                                        id="kol_${counter}" name="kol_${counter}" required list="kol_datalist_${counter}">
                                    <datalist id="kol_datalist_${counter}">
                                        <option value="DPK">DPK</option>
                                        <option value="KL">KL</option>
                                        <option value="D">D</option>
                                        <option value="M">M</option>
                                    </datalist>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm input is-invalid"
                                        id="target_${counter}" name="target_${counter}" required list="target_list_${counter}">
                                    <datalist id="target_list_${counter}">
                                        <option value="Lunas">Lunas</option>
                                    </datalist>
                                </td>
                    `;

            newTr.innerHTML = innerHTML;
            container.appendChild(newTr);
        } else {
            alert("Melebihi Batas Maximum!");
        }
    });

    // delete
    const delBtn = document.getElementById("kurangi_data");
    delBtn.addEventListener("click", function () {
        let inputElement = document.querySelectorAll('input[name^="nama_"]');

        let angka_besar = 0;
        let counter = 0;

        if (inputElement.length > 0) {
            inputElement.forEach(function (inputEl) {
                var match = inputEl.name.match(/\d+/);
                if (match && parseInt(match[0]) > angka_besar) {
                    counter = parseInt(match[0]);
                }
            });
        } else {
            counter = 0;
        }

        if (counter <= 1) {
            alert("Tidak dapat dikurangi!");
        } else {
            // hapus tr terakhir
            let lastRow = container.lastElementChild;
            if (lastRow) {
                container.removeChild(lastRow);
                counter--;
            }
        }
    });
});
