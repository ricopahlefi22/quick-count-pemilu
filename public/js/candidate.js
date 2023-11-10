$("#partyId").select2({
    dropdownParent: $("#candidateModal"),
});

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

var columns = [
    {
        data: "number",
        name: "number",
    },
    {
        data: "name",
        name: "name",
    },
    {
        data: "party",
        name: "party",
    },
    {
        data: "gender",
        name: "gender",
    },
    {
        data: "city",
        name: "city",
    },
    {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false,
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
    serverSide: true,
    processing: true,
    deferRender: true,
    select: true,
    autoWidth: false,
    responsive: true,
    ajax: document.URL,
    columns: columns,
    oLanguage: oLanguage,
});

$("body").on("click", ".image-popup-no-margins", function (e) {
    e.preventDefault();

    $(".image-popup-no-margins").magnificPopup({
        type: "image",
        closeOnContentClick: !0,
        closeBtnInside: !1,
        fixedContentPos: !0,
        mainClass: "mfp-no-margins mfp-with-zoom",
        image: {
            verticalFit: !0,
        },
        zoom: {
            enabled: !0,
            duration: 300,
        },
    });
});

$("#createButton").click(function () {
    $("#candidateModal").modal("show");
    $("#modalTitle").html("Tambah Data Calon Legislatif");

    var photo = $("#photo").dropify({
        defaultFile: null,
    });

    photo = photo.data("dropify");
    photo.resetPreview();
    photo.clearElement();
    photo.settings.defaultFile = null;
    photo.destroy();
    photo.init();

    $("#id").val("");
    $("#number").removeClass("is-invalid").val("").prop("readonly", false);
    $("#name").removeClass("is-invalid").val("");
    $('input[name="gender"]').val([]);
    $("#genderError").html("");
    $("#city").removeClass("is-invalid").val("");
    $("#partyId").removeClass("is-invalid").val(null).trigger("change");
});

$("body").on("click", ".edit", function () {
    $.ajax({
        type: "POST",
        url: "/candidates/check",
        data: { id: $(this).data("id") },
        success: function (data) {
            $("#number").removeClass("is-invalid");
            $("#name").removeClass("is-invalid");
            $("#genderError").html("");
            $("#city").removeClass("is-invalid");
            $("#partyId").removeClass("is-invalid");

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

            $("#hiddenPhoto").val(data.photo);
            $("#id").val(data.id);
            $("#name").val(data.name);
            $("#number").val(data.number).prop("readonly", true);
            $('input[name="gender"]').val([data.gender]);
            $("#city").val(data.city);
            $("#partyId").val(data.party_id).trigger("change");

            $("#candidateModal").modal("show");
            $("#modalTitle").html("Edit Data Calon Legislatif");
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

$("body").on("click", ".delete", function () {
    if (
        confirm(
            "Menghapus data dapat menimbulkan kesalahan. Yakin ingin menghapus data ini?"
        ) === true
    ) {
        $.ajax({
            type: "DELETE",
            url: "/candidates/destroy",
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
            $("#number").removeClass("is-invalid");
            $("#name").removeClass("is-invalid");
            $("#genderError").html("");
            $("#city").removeClass("is-invalid");
            $("#partyId").removeClass("is-invalid");

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
            $("#candidateModal").modal("hide");
            table.ajax.reload(null, false);
        },
        error: function (error) {
            $("#button").html("Simpan");
            if (error.status == 422) {
                var rspError = error["responseJSON"]["errors"];
                $("#numberError").html(rspError["number"]);
                $("#nameError").html(rspError["name"]);
                $("#genderError").html(rspError["gender"]);
                $("#cityError").html(rspError["city"]);
                $("#partyIdError").html(rspError["party_id"]);

                if (rspError["party_id"]) {
                    $("#partyId").addClass("is-invalid");
                }

                if (rspError["city"]) {
                    $("#city").addClass("is-invalid").focus();
                }

                if (rspError["gender"]) {
                    $("#gender").addClass("is-invalid").focus();
                }

                if (rspError["name"]) {
                    $("#name").addClass("is-invalid").focus();
                }

                if (rspError["number"]) {
                    $("#number").addClass("is-invalid").focus();
                }
            }
        },
    });
});
