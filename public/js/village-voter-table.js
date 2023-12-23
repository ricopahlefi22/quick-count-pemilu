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

$("#coordinatorId").select2({
    dropdownParent: $("#coordinatorModal"),
});

var columns = [
    {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false,
        class: "text-center",
    },
    {
        data: "name",
        name: "name",
        class: "fw-bolder",
    },
    {
        data: "age",
        name: "age",
        class: "text-center",
    },
    {
        data: "address",
        name: "address",
    },
    // {
    //     data: "rt",
    //     name: "rt",
    //     class: "text-center",
    // },
    // {
    //     data: "rw",
    //     name: "rw",
    //     class: "text-center",
    // },
    {
        data: "voting_place",
        name: "voting_place",
        class: "text-center",
    },
    {
        data: "phone_number",
        name: "phone_number",
        class: "text-center",
    },
    {
        data: "coordinator",
        name: "coordinator",
        class: "text-center",
    },
];

var oLanguage = {
    sSearch: "Pencarian",
    sInfoEmpty: "Data Belum Tersedia",
    sInfo: "Menampilkan _PAGE_ dari _PAGES_ halaman",
    sEmptyTable: "Data Belum Tersedia",
    sLengthMenu: "Tampilkan _MENU_ Baris",
    sZeroRecords: "Data Tidak Ditemukan",
    sProcessing: "Sedang Memproses...",
    oPaginate: {
        sFirst: "Pertama",
        sPrevious: "Sebelumnya",
        sNext: "Selanjutnya",
        sLast: "Terakhir",
    },
};

var table = $("#table").DataTable({
    stateSave: true,
    // serverSide: true,
    processing: true,
    // deferRender: true,
    select: true,
    paging: true,
    autoWidth: false,
    responsive: true,
    ajax: document.URL,
    columns: columns,
    oLanguage: oLanguage,
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
    $("#oldIdNumber").val("");
    $("#idNumber").removeClass("is-invalid").val("").prop("readonly", false);
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
                .html(options)
                .val($("#villageIdValue").val())
                .prop("disabled", false)
                .trigger("change");

            $.ajax({
                type: "POST",
                url: "/voting-places/json",
                data: { village_id: $("#villageIdValue").val() },
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

                    $("#votingPlaceId")
                        .html(options)
                        .val($("#votingPlaceIdValue").val())
                        .prop("disabled", false);
                },
            });
        },
    });

    $("#birthplace").val("");
    $("#birthday").val("");
    $('input[name="gender"]').val([]);
    $('input[name="marital_status"]').val([]);
    $('input[name="disability_information"]').val([]);
    $('input[name="e_ktp_record_state"]').val([]);
});

$("#coordinatorId").on("change", function () {
    $("#coordinatorButton").prop("disabled", false);
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

$("body").on("click", ".edit", function () {
    $.ajax({
        type: "POST",
        url: "/voters/check",
        data: { id: $(this).data("id") },
        success: function (data) {
            $("#name").removeClass("is-invalid");
            $("#idNumber").removeClass("is-invalid");
            $("#familyCardNumber").removeClass("is-invalid");
            $("#phoneNumber").removeClass("is-invalid");
            $("#address").removeClass("is-invalid");
            $("#rt").removeClass("is-invalid");
            $("#rw").removeClass("is-invalid");
            $("#districtId").removeClass("is-invalid");
            $("#villageId").removeClass("is-invalid");

            if (data.photo != null) {
                var photo = $("#photo").dropify({
                    defaultFile: "/" + data.photo,
                });

                photo = photo.data("dropify");
                photo.resetPreview();
                photo.clearElement();
                photo.settings.defaultFile = "/" + data.photo;
                photo.destroy();
                photo.init();
            } else {
                var photo = $("#photo").dropify({
                    defaultFile: null,
                });

                photo = photo.data("dropify");
                photo.resetPreview();
                photo.clearElement();
                photo.settings.defaultFile = null;
                photo.destroy();
                photo.init();
            }

            if (data.ktp_image != null) {
                var ktp = $("#ktp").dropify({
                    defaultFile: "/" + data.ktp_image,
                });

                ktp = ktp.data("dropify");
                ktp.resetPreview();
                ktp.clearElement();
                ktp.settings.defaultFile = "/" + data.ktp_image;
                ktp.destroy();
                ktp.init();
            } else {
                var ktp = $("#ktp").dropify({
                    defaultFile: null,
                });

                ktp = ktp.data("dropify");
                ktp.resetPreview();
                ktp.clearElement();
                ktp.settings.defaultFile = null;
                ktp.destroy();
                ktp.init();
            }

            if (data.evidence_image != null) {
                var evidence = $("#evidence").dropify({
                    defaultFile: "/" + data.evidence_image,
                });

                evidence = evidence.data("dropify");
                evidence.resetPreview();
                evidence.clearElement();
                evidence.settings.defaultFile = "/" + data.evidence_image;
                evidence.destroy();
                evidence.init();
            } else {
                var evidence = $("#evidence").dropify({
                    defaultFile: null,
                });

                evidence = evidence.data("dropify");
                evidence.resetPreview();
                evidence.clearElement();
                evidence.settings.defaultFile = null;
                evidence.destroy();
                evidence.init();
            }

            $("#hiddenPhoto").val(data.photo);
            $("#hiddenKTP").val(data.ktp_image);
            $("#hiddenEvidence").val(data.evidence_image);
            $("#id").val(data.id);
            $("#name").val(data.name);

            $("#oldIdNumber").val(data.id_number);
            $("#idNumber").val(data.id_number);

            $("#familyCardNumber").val(data.family_card_number);
            $("#address").val(data.address);
            $("#rt").val(data.rt);
            $("#rw").val(data.rw);

            $("#birthplace").val(data.birthplace);
            $("#birthday").val(data.birthday);
            $("#phoneNumber").val(data.phone_number);
            $("#note").val(data.note);
            $('input[name="gender"]').val([data.gender]);
            $('input[name="marital_status"]').val([data.marital_status]);

            if (data.district_id != null) {
                $("#districtId").val(data.district_id);
                $.ajax({
                    type: "POST",
                    url: "/villages/json",
                    data: { district_id: data.district_id },
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
                            .val(data.village_id)
                            .prop("disabled", false);

                        $.ajax({
                            type: "POST",
                            url: "/voting-places/json",
                            data: { village_id: data.village_id },
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

                                $("#votingPlaceId").html(
                                    '<option value="" selected>*PILIH TPS</option>' +
                                        options
                                );

                                if (data.voting_place_id) {
                                    $("#votingPlaceId")
                                        .val(data.voting_place_id)
                                        .prop("disabled", false);
                                }
                            },
                        });
                    },
                });
            }

            $("#voterModal").modal("show");
            $("#modalTitle").html("Sunting Data Pemilih");
            $("#button")
                .html("Simpan Perubahan")
                .removeClass("btn-dark")
                .addClass("btn-warning");
        },
        error: function (error) {
            Swal.fire({
                type: "error",
                title: error.status,
                text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
            });
        },
    });
});

$("body").on("click", ".coordinator", function () {
    const id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: "/check-coordinator",
        data: {
            id: $(this).data("id"),
        },
        success: function (response) {
            $("#idCoordinator").val(id);

            var options = "";
            $.each(response.list, function (key, value) {
                options +=
                    '<option value="' +
                    value["id"] +
                    '">' +
                    value["name"] +
                    " (" +
                    value["village"]["name"] +
                    " TPS " +
                    value["voting_place"]["name"] +
                    ")";
                ("</option>");
            });

            $("#coordinatorId").html(
                '<option value="">*PILIH KOORDINATOR*</option>' + options
            );

            $("#coordinatorId").val(response.data.coordinator_id);

            $("#coordinatorModal").modal("show");
        },
        error: function (error) {
            Swal.fire({
                type: "error",
                title: error.status,
                text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi",
            });
        },
    });
});

$("body").on("click", ".be-coordinator", function () {
    $.ajax({
        type: "POST",
        url: "/voters/check",
        data: {
            id: $(this).data("id"),
        },
        success: function (data) {
            $("#beCoordinatorModal").modal("show");
            $("#idBeCoordinator").val(data.id);
            $(".name-coordinator").html(data.name);
        },
        error: function (error) {
            Swal.fire({
                type: "error",
                title: error.status,
                text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
            });
        },
    });
});

$("body").on("click", ".cancel-coordinator", function () {
    $.ajax({
        type: "POST",
        url: "/voters/check",
        data: {
            id: $(this).data("id"),
        },
        success: function (data) {
            $("#cancelCoordinatorModal").modal("show");
            $("#idCancelCoordinator").val(data.id);
            $(".name-coordinator").html(data.name);
        },
        error: function (error) {
            Swal.fire({
                type: "error",
                title: error.status,
                text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
            });
        },
    });
});

$("body").on("click", ".delete", function () {
    if (
        confirm(
            "Menghapus data dapat menimbulkan kesalahan. Yakin ingin menghapus data ini?"
        ) === true
    ) {
        $.ajax({
            type: "DELETE",
            url: "/voters/destroy",
            data: { id: $(this).data("id") },
            success: function (response) {
                Swal.fire({
                    type: "success",
                    title: "Berhasil",
                    text: response.message,
                    showConfirmButton: !1,
                    timer: 1500,
                });

                table.ajax.reload(null, false);
            },
            error: function (error) {
                Swal.fire({
                    type: "error",
                    title: error.status,
                    text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
                });
            },
        });
    }
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

            table.ajax.reload(null, false);
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

$("#coordinatorForm").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "/list-coordinator",
        data: {
            id: $("#idCoordinator").val(),
            coordinator_id: $("#coordinatorId").val(),
        },
        success: function (response) {
            Swal.fire({
                type: "success",
                title: "Berhasil",
                text: response,
                showConfirmButton: !1,
                timer: 1500,
            });

            $("#coordinatorButton").prop("disabled", true);
            $("#coordinatorModal").modal("hide");
            table.ajax.reload(null, false);
        },
        error: function (error) {
            Swal.fire({
                type: "error",
                title: error.status,
                text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
            });
        },
    });
});

$("#beCoordinatorForm").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "/be-coordinator",
        data: {
            id: $("#idBeCoordinator").val(),
        },
        beforeSend: function () {
            $("#beCoordinatorButton").html(
                '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Melanjutkan'
            );
        },
        success: function (response) {
            Swal.fire({
                type: "success",
                title: "Berhasil",
                text: response,
                showConfirmButton: !1,
                timer: 1500,
            });

            $("#beCoordinatorModal").modal("hide");
            $("#beCoordinatorButton").html("Lanjutkan");

            table.ajax.reload(null, false);
        },
        error: function (error) {
            Swal.fire({
                type: "error",
                title: error.status,
                text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
            });

            $("#beCoordinatorButton").html("Lanjutkan");
        },
    });
});

$("#cancelCoordinatorForm").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "/cancel-coordinator",
        data: {
            id: $("#idCancelCoordinator").val(),
        },
        success: function (response) {
            Swal.fire({
                type: "success",
                title: "Berhasil",
                text: response,
                showConfirmButton: !1,
                timer: 1500,
            });

            $("#cancelCoordinatorModal").modal("hide");
            table.ajax.reload(null, false);
        },
        error: function (error) {
            Swal.fire({
                type: "error",
                title: error.status,
                text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
            });
        },
    });
});
