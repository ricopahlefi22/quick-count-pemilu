$(document).ready(function () {
    $("[data-mask]").inputmask();

    var photo = $("#photo").dropify({
        messages: {
            default: "Klik atau seret gambar ke sini",
            replace: "Klik atau seret untuk mengubah gambar",
            remove: "Hapus",
            error: "Oops, Terjadi Kesalahan",
        },
    });

    photo.on("dropify.afterClear", function (event, element) {
        $("#hiddenPhoto").val("");
    });

    var ktp = $("#ktp").dropify({
        messages: {
            default: "Klik atau seret gambar ke sini",
            replace: "Klik atau seret untuk mengubah gambar",
            remove: "Hapus",
            error: "Oops, Terjadi Kesalahan",
        },
    });

    ktp.on("dropify.afterClear", function (event, element) {
        $("#hiddenKTP").val("");
    });

    var evidence = $("#evidence").dropify({
        messages: {
            default: "Klik atau seret gambar ke sini",
            replace: "Klik atau seret untuk mengubah gambar",
            remove: "Hapus",
            error: "Oops, Terjadi Kesalahan",
        },
    });

    evidence.on("dropify.afterClear", function (event, element) {
        $("#hiddenEvidence").val("");
    });

    $("#createButton").click(function () {
        $("#voterModal").modal("show");
        $("#modalTitle").html("Tambah Data Pemilih");

        var photo = $("#photo").dropify({
            defaultFile: null,
        });

        photo = photo.data("dropify");
        photo.resetPreview();
        photo.clearElement();
        photo.settings.defaultFile = null;
        photo.destroy();
        photo.init();

        var ktp = $("#ktp").dropify({
            defaultFile: null,
        });

        ktp = ktp.data("dropify");
        ktp.resetPreview();
        ktp.clearElement();
        ktp.settings.defaultFile = null;
        ktp.destroy();
        ktp.init();

        var evidence = $("#evidence").dropify({
            defaultFile: null,
        });

        evidence = evidence.data("dropify");
        evidence.resetPreview();
        evidence.clearElement();
        evidence.settings.defaultFile = null;
        evidence.destroy();
        evidence.init();

        $("#name").removeClass("is-invalid").val("");
        $("#idNumber").removeClass("is-invalid").val("");
        $("#familyCardNumber").removeClass("is-invalid").val("");
        $("#phoneNumber").removeClass("is-invalid").val("");
        $("#address").removeClass("is-invalid").val("");
        $("#rt").removeClass("is-invalid").val("");
        $("#rw").removeClass("is-invalid").val("");

        $("#districtId")
            .removeClass("is-invalid")
            .val($("#districtIdValue").val())
            .trigger("change");

        $.ajax({
            type: "POST",
            url: "/villages/json",
            data: {
                district_id: $("#districtIdValue").val(),
            },
            beforeSend: function () {
                $("#villageId")
                    .html(
                        '<option value="" selected disabled hidden>*MOHON TUNGGU</option>'
                    )
                    .prop("disabled", true);
            },
            success: function (response) {
                var options = "";
                $.each(response, function (key, value) {
                    options +=
                        '<option value="' +
                        value["id"] +
                        '">' +
                        value["name"] +
                        "</option>";
                });

                $("#villageId")
                    .html(
                        "<option selected hidden disabled>*PILIH KELURAHAN/DESA</option>" +
                            options
                    )
                    .val($("#villageIdValue").val())
                    .prop("disabled", false)
                    .trigger('change');
            },
        });

        $("#birthplace").val("");
        $("#birthday").val("");
        $('input[name="gender"]').val([]);
        $('input[name="marital_status"]').val([]);
    });

    $("#districtId").change(function () {
        $.ajax({
            type: "POST",
            url: "/villages/json",
            data: {
                district_id: $(this).val(),
            },
            beforeSend: function () {
                $("#villageId")
                    .html(
                        '<option value="" selected disabled hidden>*MOHON TUNGGU</option>'
                    )
                    .prop("disabled", true);
            },
            success: function (response) {
                var options = "";
                $.each(response, function (key, value) {
                    options +=
                        '<option value="' +
                        value["id"] +
                        '">' +
                        value["name"] +
                        "</option>";
                });

                $("#villageId")
                    .html(
                        "<option selected hidden disabled>*PILIH KELURAHAN/DESA</option>" +
                            options
                    )
                    .prop("disabled", false);
            },
        });
    });

    $("#villageId").change(function () {
        $("#votingPlaceOption").html("*PILIH TPS");
        $("#coordinatorOption").html("*PILIH KOORDINATOR");

        $.ajax({
            type: "POST",
            url: "/voting-places/json",
            data: {
                village_id: $(this).val(),
            },
            beforeSend: function () {
                $("#votingPlaceId")
                    .html(
                        '<option value="" selected disabled hidden>*MOHON TUNGGU</option>'
                    )
                    .prop("disabled", true);
            },
            success: function (response) {
                var options = "";
                if (response.length != 0) {
                    $.each(response, function (key, value) {
                        options +=
                            '<option value="' +
                            value["id"] +
                            '">' +
                            value["name"] +
                            "</option>";
                    });
                    $("#votingPlaceId")
                        .html(
                            '<option value="" selected disabled hidden>*PILIH TPS</option>' +
                                options
                        )
                        .prop("disabled", false);
                } else {
                    $("#votingPlaceId").html(
                        "<option selected hidden disabled>*TIDAK ADA TPS</option>"
                    );
                }
            },
        });
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
                $("#name").removeClass("is-invalid");
                $("#idNumber").removeClass("is-invalid");
                $("#familyCardNumber").removeClass("is-invalid");
                $("#phoneNumber").removeClass("is-invalid");
                $("#address").removeClass("is-invalid");
                $("#rt").removeClass("is-invalid");
                $("#rw").removeClass("is-invalid");
                $("#districtId").removeClass("is-invalid");
                $("#villageId").removeClass("is-invalid");
                $("#votingPlaceId").removeClass("is-invalid");

                $("#button").html(
                    '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Menyimpan'
                );
            },
            success: function (response) {
                Swal.fire({
                    type: "success",
                    title: "Berhasil",
                    text: response.message,
                    showConfirmButton: !1,
                    timer: 1500,
                });

                $("#voterModal").modal("hide");
            },
            error: function (error) {
                $("#button").html("Simpan");
                if (error.status == 422) {
                    var rspError = error["responseJSON"]["errors"];
                    $("#nameError").html(rspError["name"]);
                    $("#idNumberError").html(rspError["id_number"]);
                    $("#familyCardNumberError").html(
                        rspError["family_card_number"]
                    );
                    $("#phoneNumberError").html(rspError["phone_number"]);
                    $("#addressError").html(rspError["address"]);
                    $("#rtError").html(rspError["rt"]);
                    $("#rwError").html(rspError["rw"]);
                    $("#districtIdError").html(rspError["district_id"]);
                    $("#villageIdError").html(rspError["village_id"]);
                    $("#votingPlaceIdError").html(rspError["voting_place_id"]);

                    if (rspError["voting_place_id"]) {
                        $("#votingPlaceId").addClass("is-invalid");
                    }

                    if (rspError["village_id"]) {
                        $("#villageId").addClass("is-invalid");
                    }

                    if (rspError["district_id"]) {
                        $("#districtId").addClass("is-invalid");
                    }

                    if (rspError["rw"]) {
                        $("#rw").addClass("is-invalid").focus();
                    }

                    if (rspError["rt"]) {
                        $("#rt").addClass("is-invalid").focus();
                    }

                    if (rspError["address"]) {
                        $("#address").addClass("is-invalid").focus();
                    }

                    if (rspError["phone_number"]) {
                        $("#phoneNumber").addClass("is-invalid").focus();
                    }

                    if (rspError["family_card_number"]) {
                        $("#familyCardNumber").addClass("is-invalid").focus();
                    }

                    if (rspError["id_number"]) {
                        $("#idNumber").addClass("is-invalid").focus();
                    }

                    if (rspError["name"]) {
                        $("#name").addClass("is-invalid").focus();
                    }
                }
            },
        });
    });
});
