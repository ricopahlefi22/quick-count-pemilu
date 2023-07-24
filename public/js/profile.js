var Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    timer: 3000,
});

var dropify = $("#photo").dropify({
    messages: {
        default: "Klik atau seret gambar ke sini",
        replace: "Klik atau seret untuk mengubah gambar",
        remove: "Hapus",
        error: "Oops, Terjadi Kesalahan",
    },
});

dropify.on("dropify.afterClear", function () {
    $("#hiddenPhoto").val("");
});

$("#editProfileForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        dataType: "json",
        contentType: false,
        beforeSend: function () {
            $("#name").removeClass("is-invalid");
            $("#email").removeClass("is-invalid");
            $("#phoneNumber").removeClass("is-invalid");

            $("#button").html(
                '<div class="text-center"><div class="spinner-border spinner-border-sm text-white"></div> Memproses...</div>'
            );
        },
        success: function (response) {
            Swal.fire({
                type: "success",
                title: response.status,
                text: response.message,
                confirmButtonText: "Lanjut",
                confirmButtonColor: "#007BFF",
                backdrop: true,
                allowOutsideClick: () => {
                    console.log("Klik Tombol Lanjut");
                },
            }).then((result) => {
                if (result.value == true) {
                    window.location.reload();
                }
            });
        },
        error: function (error) {
            $("#button").html("Simpan");

            if (error.status == 422) {
                var responseError = error["responseJSON"]["errors"];
                $("#nameError").html(responseError["name"]);
                $("#emailError").html(responseError["email"]);
                $("#phoneNumberError").html(responseError["phone_number"]);

                if (responseError["phone_number"]) {
                    $("#phoneNumber").addClass("is-invalid").focus();
                }

                if (responseError["email"]) {
                    $("#email").addClass("is-invalid").focus();
                }

                if (responseError["name"]) {
                    $("#name").addClass("is-invalid").focus();
                }
            } else {
                Toast.fire({
                    type: "error",
                    title: "Error " + error.status + "! \nTerjadi masalah",
                });
            }
        },
    });
});

$("#changePasswordForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        dataType: "json",
        contentType: false,
        beforeSend: function () {
            $("#oldPassword").removeClass("is-invalid");
            $("#newPassword").removeClass("is-invalid");
            $("#confirmPassword").removeClass("is-invalid");

            $("#changePasswordButton").html(
                '<div class="text-center"><div class="spinner-border spinner-border-sm text-white"></div> Memproses...</div>'
            );
        },
        success: function (response) {
            Swal.fire({
                type: "success",
                title: response.status,
                text: response.message,
                confirmButtonText: "Lanjut",
                confirmButtonColor: "#007BFF",
                backdrop: true,
                allowOutsideClick: () => {
                    console.log("Klik Tombol Lanjut");
                },
            }).then((result) => {
                if (result.value == true) {
                    window.location.reload();
                }
            });
        },
        error: function (error) {
            console.log(error);
            $("#changePasswordButton").html("Simpan");

            if (error.status == 422) {
                var responseError = error["responseJSON"]["errors"];
                $("#oldPasswordError").html(responseError["old_password"]);
                $("#newPasswordError").html(responseError["new_password"]);
                $("#confirmPasswordError").html(responseError["confirm_password"]);

                if (responseError["confirm_password"]) {
                    $("#confirmPassword").addClass("is-invalid").focus();
                }

                if (responseError["new_password"]) {
                    $("#newPassword").addClass("is-invalid").focus();
                }

                if (responseError["old_password"]) {
                    $("#oldPassword").addClass("is-invalid").focus();
                }
            } else {
                Toast.fire({
                    type: "error",
                    title: "Error " + error.status + "! \nTerjadi masalah",
                });
            }
        },
    });
});
