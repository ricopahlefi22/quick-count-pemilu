$(document).ready(function () {
    var file = $("#file").dropify({
        messages: {
            default: "Klik atau seret file ke sini",
            replace: "Klik atau seret untuk mengubah file",
            remove: "Hapus",
            error: "Oops, Terjadi Kesalahan",
        },
    });

    $("#file").on("change", function () {
        $("#submit").prop("disabled", false);
    });

    $("#form").on("submit", function (event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function () {
                $("#submit").html(
                    '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Mengirim'
                );
            },
            success: function (response) {
                var file = $("#file").dropify({
                    defaultFile: null,
                });

                file = file.data("dropify");
                file.resetPreview();
                file.clearElement();
                file.settings.defaultFile = null;
                file.destroy();
                file.init();

                if (response.code == 200) {
                    Swal.fire({
                        type: "success",
                        title: response.status,
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        type: "warning",
                        title: response.status,
                        text: response.message,
                    });
                }
                $("#submit").html("Kirim");
            },
            error: function (error) {
                if (error.status == 422) {
                    Swal.fire({
                        type: "error",
                        title: "Gagal!",
                        text: "Pilih file terlebih dahulu",
                        showConfirmButton: !1,
                        timer: 1500,
                    });
                }
                $("#submit").html("Kirim");
            },
        });
    });
});
