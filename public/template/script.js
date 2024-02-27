// {{-- refresh captcha --}}
function refreshCaptcha() {
    $.ajax({
        url: "/refereshcapcha",
        type: "get",
        dataType: "html",
        success: function (json) {
            $(".hasil_refereshrecapcha").html(json);
        },
        error: function (data) {
            alert("Try Again.");
        },
    });
}

// {{-- INPUTAN --}}

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Initialize Select2 Elements
    $(".select2bs4").select2({
        theme: "bootstrap4",
    });

    //Date picker
    $("#date").datetimepicker({
        format: "DD-MM-yyyy",
    });
});
