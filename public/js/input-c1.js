var file = $("#file").dropify({
    messages: {
        default: "Klik atau seret file C1 kesini (.pdf)",
        replace: "Klik atau seret untuk mengubah file C1 (.pdf)",
        remove: "Hapus",
        error: "Oops, Terjadi Kesalahan",
    },
});

file.on("dropify.afterClear", function () {
    $("#hiddenFile").val("");
});

$("#form").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        dataType: "json",
        contentType: false,
        beforeSend: function () {
            $("#button")
                .html(
                    '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Menyimpan'
                )
                .prop("disabled", true);
        },
        success: function (response) {
            if (response.code == 200) {
                Swal.fire({
                    type: "success",
                    title: response.status,
                    text: response.message,
                    confirmButtonText: "Lanjut",
                    confirmButtonColor: "#3B5DE7",
                    backdrop: true,
                    allowOutsideClick: () => {
                        console.log("Klik Tombol Lanjut");
                    },
                }).then((result) => {
                    if (result.value == true) {
                        window.location.href = "/input-voting-results";
                    }
                });
            } else {
                Swal.fire({
                    type: "error",
                    title: response.status,
                    text: response.message,
                    confirmButtonText: "Tutup",
                    confirmButtonColor: "#6C757D",
                });
            }

            $("#button").html('Simpan C1 <i class="mdi mdi-send"></i>');
        },
        error: function (error) {
            $("#button").html('Simpan C1 <i class="mdi mdi-send"></i>');
            Swal.fire({
                type: "error",
                title: error.status,
                text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
            });
        },
    });
});
