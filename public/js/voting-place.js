$("#villageId").select2({
    dropdownParent: $("#votingPlaceModal"),
});

$("[data-mask]").inputmask();

var columns = [
    {
        data: "voting_place",
        name: "voting_place",
    },
    {
        data: "district",
        name: "district",
    },
    {
        data: "address",
        name: "address",
    },
    {
        data: "coordinate",
        name: "coordinate",
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

$("#createButton").click(function () {
    $("#votingPlaceModal").modal("show");
    $("#modalTitle").html("Tambah Data Tempat Pemungutan Suara");

    $("#id").val("");
    $("#name").removeClass("is-invalid").val("");
    $("#address").removeClass("is-invalid").val("");
    $("#latitude").removeClass("is-invalid").val("");
    $("#longitude").removeClass("is-invalid").val("");

    $("#villageId")
        .html(
            '<option value="" selected hidden disabled>*PILIH KECAMATAN DAHULU</option>'
        )
        .prop("disabled", true);

    $("#districtId").removeClass("is-invalid").val("");
});

$("#districtId").change(function () {
    $.ajax({
        type: "POST",
        url: "/villages/json",
        data: {
            district_id: $(this).val(),
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

$("body").on("click", ".edit", function () {
    $.ajax({
        type: "POST",
        url: "/voting-places/check",
        data: { id: $(this).data("id") },
        success: function (data) {
            $("#name").removeClass("is-invalid");
            $("#address").removeClass("is-invalid");
            $("#latitude").removeClass("is-invalid");
            $("#longitude").removeClass("is-invalid");
            $("#villageId").removeClass("is-invalid");
            $("#villageId").removeClass("is-invalid");
            $("#districtId").removeClass("is-invalid");

            $("#id").val(data.id);
            $("#name").val(data.name);
            $("#address").val(data.address);
            $("#latitude").val(data.latitude);
            $("#longitude").val(data.longitude);
            $("#districtId").val(data.district_id);

            $("#villageId")
                .html("<option selected hidden disabled>*MOHON TUNGGU</option>")
                .prop("disabled", true);

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
                    },
                });
            }

            $("#votingPlaceModal").modal("show");
            $("#modalTitle").html("Sunting Data Tempat Pemungutan Suara");
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
            url: "/voting-places/destroy",
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
            $("#address").removeClass("is-invalid");
            $("#latitude").removeClass("is-invalid");
            $("#longitude").removeClass("is-invalid");
            $("#villageId").removeClass("is-invalid");
            $("#districtId").removeClass("is-invalid");

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
            $("#votingPlaceModal").modal("hide");
            table.ajax.reload(null, false);
        },
        error: function (error) {
            console.error(error);
            $("#button").html("Simpan");
            if (error.status == 422) {
                var rspError = error["responseJSON"]["errors"];
                $("#nameError").html(rspError["name"]);
                $("#addressError").html(rspError["address"]);
                $("#latitudeError").html(rspError["latitude"]);
                $("#longitudeError").html(rspError["longitude"]);

                if (rspError["district_id"]) {
                    $("#districtId").addClass("is-invalid").focus();
                }

                if (rspError["village_id"]) {
                    $("#villageId").addClass("is-invalid").focus();
                }

                if (rspError["longitude"]) {
                    $("#longitude").addClass("is-invalid").focus();
                }

                if (rspError["latitude"]) {
                    $("#latitude").addClass("is-invalid").focus();
                }

                if (rspError["address"]) {
                    $("#address").addClass("is-invalid").focus();
                }

                if (rspError["name"]) {
                    $("#name").addClass("is-invalid").focus();
                }
            }
        },
    });
});
