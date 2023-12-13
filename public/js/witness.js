$(document).ready(function () {
    $("#votingPlaceId").select2({
        dropdownParent: $("#witnessModal"),
    });

    $("#voterId").select2({
        dropdownParent: $("#witnessModal"),
    });

    var columns = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
        },
        {
            data: "voter",
            name: "voter",
        },
        {
            data: "voting_place",
            name: "voting_place",
        },
        {
            data: "district",
            name: "district",
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
        $("#button").prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "/witnesses/voting-places",
            success: function (response) {
                $("#witnessModal").modal("show");
                $("#modalTitle").html("Tambah Data Saksi");
                $("#button")
                    .html("Simpan")
                    .removeClass("btn-warning")
                    .addClass("btn-primary");

                $("#votingPlaceId").val("");
                $("#voterId").val("");

                var options = "";
                $.each(response, function (_, value) {
                    options +=
                        '<option value="' +
                        value["id"] +
                        '">' +
                        value["village"]["name"] +
                        " (" +
                        "TPS " +
                        value["name"] +
                        ")" +
                        "</option>";
                });

                $("#votingPlaceId").html(
                    '<option value="" disabled selected hidden>*PILIH TPS*</option>' +
                        options
                );

                $("#voterId")
                    .html(
                        '<option value="" selected hidden disabled>*PILIH TPS DAHULU</option>'
                    )
                    .prop("disabled", true);
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

    $("#votingPlaceId").on("change", function () {
        var votingPlaceId = this.value;
        $.ajax({
            type: "POST",
            url: "/witnesses/voters",
            data: {
                id: votingPlaceId,
            },
            success: function (response) {
                var options = "";
                if (response.length != 0) {
                    $.each(response, function (_, value) {
                        options +=
                            '<option value="' +
                            value["id"] +
                            '">' +
                            value["name"] +
                            " (" +
                            value["age"] +
                            " Tahun)" +
                            "</option>";
                    });

                    $("#voterId")
                        .html(
                            '<option value="" disabled selected hidden>*PILIH SAKSI*</option>' +
                                options
                        )
                        .prop("disabled", false);
                } else {
                    $("#voterId")
                        .html(
                            '<option value="" disabled selected hidden>*TIDAK ADA DATA*</option>' +
                                options
                        )
                        .prop("disabled", true);
                }
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

    $("#voterId").on("change", function () {
        $("#button").prop("disabled", false);
    });

    $("body").on("click", ".edit", function () {
        $.ajax({
            type: "POST",
            url: "/witnesses/check",
            data: { id: $(this).data("id") },
            success: function (data) {
                $("#witnessModal").modal("show");
                $("#modalTitle").html("Edit Data Saksi");
                $("#button")
                    .html("Simpan Perubahan")
                    .removeClass("btn-primary")
                    .addClass("btn-warning")
                    .prop("disabled", true);

                $("#votingPlaceId")
                    .html(
                        '<option value="" disabled selected hidden>*TUNGGU SEBENTAR*</option>'
                    )
                    .prop("disabled", true);

                $("#voterId")
                    .html(
                        '<option value="" selected hidden disabled>*TUNGGU SEBENTAR</option>'
                    )
                    .prop("disabled", true);

                $("#id").val(data.id);

                $.ajax({
                    type: "POST",
                    url: "/witnesses/voting-places",
                    data: {
                        id: data.id,
                    },
                    success: function (response) {
                        $("#votingPlaceId").val("");
                        $("#voterId").val("");

                        var options = "";
                        $.each(response, function (_, value) {
                            options +=
                                '<option value="' +
                                value["id"] +
                                '">' +
                                value["village"]["name"] +
                                " (" +
                                "TPS " +
                                value["name"] +
                                ")" +
                                "</option>";
                        });

                        $("#votingPlaceId")
                            .html(
                                '<option value="" disabled selected hidden>*PILIH TPS*</option>' +
                                    options
                            )
                            .val(data.voting_place_id)
                            .prop("disabled", false);

                        $.ajax({
                            type: "POST",
                            url: "/witnesses/voters",
                            data: {
                                id: data.voting_place_id,
                            },
                            success: function (response) {
                                var options = "";
                                if (response.length != 0) {
                                    $.each(response, function (_, value) {
                                        options +=
                                            '<option value="' +
                                            value["id"] +
                                            '">' +
                                            value["name"] +
                                            " (" +
                                            value["age"] +
                                            " Tahun)" +
                                            "</option>";
                                    });

                                    $("#voterId")
                                        .html(
                                            '<option value="" disabled selected hidden>*PILIH SAKSI*</option>' +
                                                options
                                        )
                                        .prop("disabled", false)
                                        .val(data.voter_id);
                                } else {
                                    $("#voterId")
                                        .html(
                                            '<option value="" disabled selected hidden>*TIDAK ADA DATA*</option>' +
                                                options
                                        )
                                        .prop("disabled", true);
                                }
                            },
                            error: function (error) {
                                Swal.fire({
                                    type: "error",
                                    title: error.status,
                                    text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi",
                                });
                            },
                        });
                    },
                    error: function (error) {
                        Swal.fire({
                            type: "error",
                            title: error.status,
                            text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi",
                        });
                    },
                });
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

    $("body").on("click", ".delete", function () {
        if (
            confirm(
                "Menghapus data dapat menimbulkan kesalahan. Yakin ingin menghapus data ini?"
            ) === true
        ) {
            $.ajax({
                type: "DELETE",
                url: "/witnesses/destroy",
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
                    console.error(error);
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
                $("#witnessModal").modal("hide");
                table.ajax.reload(null, false);
                $("#button").html("Simpan");
            },
            error: function (error) {
                $("#button").html("Simpan");
                Swal.fire({
                    type: "error",
                    title: error.status,
                    text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
                });
            },
        });
    });
});
