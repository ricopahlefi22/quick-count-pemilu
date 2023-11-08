@push('style')
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Dropify -->
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Select2 -->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row mt-4 mt-sm-2 mt-md-1">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title my-4 font-size-18 lh-1">
                        Koordinator di {{ $village->name }}
                    </h4>

                    <div class="page-title-right d-none d-xl-block">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Data Koordinator</a>
                            </li>
                            <li class="breadcrumb-item active">Kecamatan {{ $village->district->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        @if (Auth::user()->level == true)
                            <div class="btn-group dropdown float-start">
                                <button id="btnGroupDropdown" type="button" class="btn btn-sm btn-dark dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi Lainnya <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                                    <button id="createButton" class="dropdown-item" disabled><i
                                            class="fa fa-plus-circle"></i> Tambah
                                        Data</button>
                                    <button class="dropdown-item" disabled><i class="fa fa-file-csv"></i> Ekspor
                                        CSV</button>
                                    <button class="dropdown-item" disabled><i class="fa fa-file-pdf"></i> Cetak PDF</button>
                                </div>
                            </div>
                        @endif

                        <table id="table" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th title="Tempat Pemilihan Suara">TPS</th>
                                    <th>Alamat</th>
                                    <th>Nomor Ponsel</th>
                                    @if (Auth::guard('owner')->check())
                                        <th>Jumlah Anggota</th>
                                    @endif
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th title="Tempat Pemilihan Suara">TPS</th>
                                    <th>Alamat</th>
                                    <th>Nomor Ponsel</th>
                                    @if (Auth::guard('owner')->check())
                                        <th>Jumlah Anggota</th>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    @include('modals.voter')
    @include('modals.cancel-coordinator')
@endsection

@push('script')
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <!-- form mask -->
    <script src="{{ asset('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

    <!-- Dropify -->
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>

    <!-- Script -->
    {{-- <script src="{{ asset('js/coordinator-table.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $("[data-mask]").inputmask();

            var photo = $("#photo").dropify({
                messages: {
                    default: "Klik atau seret gambar ke sini",
                    replace: "Klik atau seret untuk mengubah gambar",
                    remove: "Hapus",
                    error: "Oops, Terjadi Kesalahan",
                },
            });

            photo.on("dropify.afterClear", function(event, element) {
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

            ktp.on("dropify.afterClear", function(event, element) {
                $("#hiddenKTP").val("");
            });

            $("#select2insidemodal").select2({
                dropdownParent: $("#coordinatorModal"),
            });

            var columns = [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
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
                },
                {
                    data: "voting_place",
                    name: "voting_place",
                },
                {
                    data: "address",
                    name: "address",
                },
                {
                    data: "phone_number",
                    name: "phone_number",
                },
                @if (Auth::guard('owner')->check())
                    {
                        data: "member_total",
                        name: "member_total",
                    },
                @endif
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

            $("#createButton").click(function() {
                $("#formModal").modal("show");
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

                $("#name").removeClass("is-invalid").val("");
                $("#idNumber").removeClass("is-invalid").val("");
                $("#familyCardNumber").removeClass("is-invalid").val("");
                $("#phoneNumber").removeClass("is-invalid").val("");
                $("#address").removeClass("is-invalid").val("");
                $("#rt").removeClass("is-invalid").val("");
                $("#rw").removeClass("is-invalid").val("");
                $("#districtId").removeClass("is-invalid").val("");
                $("#villageId").removeClass("is-invalid").val("");
                $("#birthplace").val("");
                $("#birthday").val("");
                $('input[name="gender"]').val([]);
                $('input[name="marital_status"]').val([]);
                $('input[name="disability_information"]').val([]);
                $('input[name="e_ktp_record_state"]').val([]);

                $("#villageId").html(
                    '<option value="" selected hidden disabled>*PILIH KECAMATAN DAHULU</option>'
                );
                $("#votingPlaceId").html(
                    '<option value="" selected hidden disabled>*PILIH KELURAHAN/DESA DAHULU</option>'
                );
                $("#coordinatorId").html(
                    '<option value="" selected hidden disabled>*PILIH KELURAHAN/DESA DAHULU</option>'
                );
            });

            $("#select2insidemodal").on("change", function() {
                $("#coordinatorButton").prop("disabled", false);
            });

            $("#districtId").change(function() {
                $.ajax({
                    type: "POST",
                    url: "/villages/json",
                    data: {
                        district_id: $(this).val(),
                    },
                    success: function(response) {
                        var options = "";
                        $.each(response, function(key, value) {
                            options +=
                                '<option value="' +
                                value["id"] +
                                '">' +
                                value["name"] +
                                "</option>";
                        });

                        $("#villageId").html(
                            "<option selected hidden disabled>*PILIH KELURAHAN/DESA</option>" +
                            options
                        );
                    },
                });
            });

            $("#villageId").change(function() {
                $("#votingPlaceOption").html("*PILIH TPS");
                $("#coordinatorOption").html("*PILIH KOORDINATOR");

                $.ajax({
                    type: "POST",
                    url: "/voting-places/json",
                    data: {
                        village_id: $(this).val(),
                    },
                    success: function(response) {
                        var options = "";
                        if (response.length != 0) {
                            $.each(response, function(key, value) {
                                options +=
                                    '<option value="' +
                                    value["id"] +
                                    '">' +
                                    value["name"] +
                                    "</option>";
                            });

                            $("#votingPlaceId").html(
                                '<option value="" selected>--- PILIH TPS ---</option>' +
                                options
                            );
                        } else {
                            $("#votingPlaceId").html(
                                "<option selected hidden disabled>--- TIDAK ADA TPS ---</option>"
                            );
                        }
                    },
                });
            });

            $("body").on("click", ".edit", function() {
                $.ajax({
                    type: "POST",
                    url: "/voters/check",
                    data: {
                        id: $(this).data("id")
                    },
                    success: function(data) {
                        $("#name").removeClass("is-invalid");
                        $("#idNumber").removeClass("is-invalid");
                        $("#familyCardNumber").removeClass("is-invalid");
                        $("#phoneNumber").removeClass("is-invalid");
                        $("#address").removeClass("is-invalid");
                        $("#rt").removeClass("is-invalid");
                        $("#rw").removeClass("is-invalid");
                        $("#districtId").removeClass("is-invalid");
                        $("#villageId").removeClass("is-invalid");

                        var photo = $("#photo").dropify({
                            defaultFile: data.photo,
                        });

                        photo = photo.data("dropify");
                        photo.resetPreview();
                        photo.clearElement();
                        photo.settings.defaultFile = data.photo;
                        photo.destroy();
                        photo.init();

                        var ktp = $("#ktp").dropify({
                            defaultFile: data.ktp_image,
                        });

                        ktp = ktp.data("dropify");
                        ktp.resetPreview();
                        ktp.clearElement();
                        ktp.settings.defaultFile = data.ktp_image;
                        ktp.destroy();
                        ktp.init();

                        $("#hiddenPhoto").val(data.photo);
                        $("#hiddenKTP").val(data.ktp_image);
                        $("#id").val(data.id);
                        $("#name").val(data.name);
                        $("#idNumber").val(data.id_number).prop("readonly", true);
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
                                data: {
                                    district_id: data.district_id
                                },
                                success: function(response) {
                                    var options = "";
                                    $.each(response, function(key, value) {
                                        options +=
                                            '<option value="' +
                                            value["id"] +
                                            '">' +
                                            value["name"] +
                                            "</option>";
                                    });

                                    $("#villageId").html(
                                        "<option selected hidden disabled>*PILIH KELURAHAN/DESA</option>" +
                                        options
                                    );
                                    $("#villageId").val(data.village_id);

                                    $.ajax({
                                        type: "POST",
                                        url: "/voting-places/json",
                                        data: {
                                            village_id: data.village_id
                                        },
                                        success: function(response) {
                                            var options = "";
                                            $.each(response, function(
                                                key, value) {
                                                options +=
                                                    '<option value="' +
                                                    value[
                                                        "id"] +
                                                    '">' +
                                                    value[
                                                        "name"
                                                    ] +
                                                    "</option>";
                                            });

                                            $("#votingPlaceId").html(
                                                '<option value="" selected>*PILIH TPS</option>' +
                                                options
                                            );

                                            if (data.voting_place_id) {
                                                $("#votingPlaceId").val(
                                                    data
                                                    .voting_place_id
                                                );
                                            }
                                        },
                                    });
                                },
                            });
                        }

                        $("#formModal").modal("show");
                        $("#modalTitle").html("Sunting Data Pemilih");
                        $("#button")
                            .html("Simpan Perubahan")
                            .removeClass("btn-dark")
                            .addClass("btn-warning");
                    },
                    error: function(error) {
                        console.error(error);

                        Swal.fire({
                            type: "error",
                            title: error.status,
                            text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
                        });
                    },
                });
            });

            $("body").on("click", ".coordinator", function() {
                const id = $(this).data("id");
                $.ajax({
                    type: "POST",
                    url: "/check-coordinator",
                    data: {
                        id: $(this).data("id"),
                    },
                    success: function(response) {
                        $("#idCoordinator").val(id);

                        var options = "";
                        $.each(response.list, function(key, value) {
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

                        $("#select2insidemodal").html(
                            '<option value="">*PILIH KOORDINATOR*</option>' + options
                        );

                        $("#select2insidemodal").val(response.data.coordinator_id);

                        $("#coordinatorModal").modal("show");
                    },
                    error: function(error) {
                        Swal.fire({
                            type: "error",
                            title: error.status,
                            text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi",
                        });
                    },
                });
            });

            $("body").on("click", ".be-coordinator", function() {
                $.ajax({
                    type: "POST",
                    url: "/voters/check",
                    data: {
                        id: $(this).data("id"),
                    },
                    success: function(data) {
                        $("#beCoordinatorModal").modal("show");
                        $("#idBeCoordinator").val(data.id);
                        $(".name-coordinator").html(data.name);
                    },
                    error: function(error) {
                        Swal.fire({
                            type: "error",
                            title: error.status,
                            text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
                        });
                    },
                });
            });

            $("body").on("click", ".cancel-coordinator", function() {
                $.ajax({
                    type: "POST",
                    url: "/voters/check",
                    data: {
                        id: $(this).data("id"),
                    },
                    success: function(data) {
                        $("#cancelCoordinatorModal").modal("show");
                        $("#idCancelCoordinator").val(data.id);
                        $(".name-coordinator").html(data.name);
                    },
                    error: function(error) {
                        Swal.fire({
                            type: "error",
                            title: error.status,
                            text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
                        });
                    },
                });
            });

            $("body").on("click", ".delete", function() {
                if (
                    confirm(
                        "Menghapus data dapat menimbulkan kesalahan. Yakin ingin menghapus data ini?"
                    ) === true
                ) {
                    $.ajax({
                        type: "DELETE",
                        url: "/voters/destroy",
                        data: {
                            id: $(this).data("id")
                        },
                        success: function(response) {
                            Swal.fire({
                                type: "success",
                                title: "Berhasil",
                                text: response.message,
                                showConfirmButton: !1,
                                timer: 1500,
                            });

                            table.ajax.reload(null, false);
                        },
                        error: function(error) {
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

            $("#form").on("submit", function(event) {
                event.preventDefault();

                $.ajax({
                    url: $(this).attr("action"),
                    method: $(this).attr("method"),
                    data: new FormData(this),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    beforeSend: function() {
                        $("#name").removeClass("is-invalid");
                        $("#idNumber").removeClass("is-invalid");
                        $("#familyCardNumber").removeClass("is-invalid");
                        $("#phoneNumber").removeClass("is-invalid");
                        $("#address").removeClass("is-invalid");
                        $("#rt").removeClass("is-invalid");
                        $("#rw").removeClass("is-invalid");
                        $("#districtId").removeClass("is-invalid");
                        $("#villageId").removeClass("is-invalid");
                        $("#button").html(
                            '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Menyimpan'
                        );
                    },
                    success: function(response) {
                        Swal.fire({
                            type: "success",
                            title: "Berhasil",
                            text: response.message,
                            showConfirmButton: !1,
                            timer: 1500,
                        });
                        $("#formModal").modal("hide");
                        table.ajax.reload(null, false);
                    },
                    error: function(error) {
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

            $("#coordinatorForm").on("submit", function(event) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/list-coordinator",
                    data: {
                        id: $("#idCoordinator").val(),
                        coordinator_id: $("#select2insidemodal").val(),
                    },
                    success: function(response) {
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
                    error: function(error) {
                        Swal.fire({
                            type: "error",
                            title: error.status,
                            text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
                        });
                    },
                });
            });

            $("#beCoordinatorForm").on("submit", function(event) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/be-coordinator",
                    data: {
                        id: $("#idBeCoordinator").val(),
                    },
                    success: function(response) {
                        Swal.fire({
                            type: "success",
                            title: "Berhasil",
                            text: response,
                            showConfirmButton: !1,
                            timer: 1500,
                        });

                        $("#beCoordinatorModal").modal("hide");
                        table.ajax.reload(null, false);
                    },
                    error: function(error) {
                        Swal.fire({
                            type: "error",
                            title: error.status,
                            text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
                        });
                    },
                });
            });

            $("#cancelCoordinatorForm").on("submit", function(event) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/cancel-coordinator",
                    data: {
                        id: $("#idCancelCoordinator").val(),
                    },
                    success: function(response) {
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
                    error: function(error) {
                        Swal.fire({
                            type: "error",
                            title: error.status,
                            text: "Terjadi Kesalahan, mohon ulangi beberapa saat lagi :)",
                        });
                    },
                });
            });
        });
    </script>
@endpush
