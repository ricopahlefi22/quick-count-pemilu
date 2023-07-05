@extends('admin.template.base')

@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Pencarian Cepat</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Beranda</a></li>
                            <li class="breadcrumb-item active">Pencarian Cepat</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form id="form" action="search" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <label for="idNumber">Nomor Induk Kependudukan</label>
                                <div class="col-12 col-md-10 mb-2">
                                    <input id="idNumber" type="text" name="id_number"
                                        class="form-control form-control-lg input-mask"
                                        data-inputmask="'mask': '9999-9999-9999-9999'">
                                    <span id="idNumberError" class="invalid-feedback"></span>
                                </div>
                                <div class="col-12 col-md-2">
                                    <button id="submit" type="submit" class="btn btn-lg w-100 btn-success"><i
                                            class="mdi mdi-account-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr class="divider">

        <div id="loader" class="row d-none">
            <div class="col-md-12 text-center">
                <i class="bx bx-loader bx-spin"></i> Mencari
            </div>
        </div>

        <div id="resultCard" class="row d-none">
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-widgets py-3">

                            <div class="text-center">
                                <a class="image-popup-no-margins" href="{{ asset('assets/images/users/avatar-2.jpg') }}">
                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}"
                                        class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                </a>

                                <div class="mt-2">
                                    <a class="name text-reset fw-bold font-size-18"></a>
                                    <br>
                                    <span id="badge" class="badge"></span>

                                </div>

                                <a href="" class="btn btn-sm btn-dark mt-2 d-none">
                                    <i class="mdi mdi-account-card-details"></i> Lihat KTP
                                </a>

                                <div id="memberTotal" class="row mt-4 border border-start-0 border-end-0 p-3 d-none">
                                    <div class="col-md-12">
                                        <h6 class="text-muted">
                                            Anggota
                                        </h6>
                                        <h5 class="mb-0">9,025</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-9">
                {{-- <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary">Jadikan Koordinator</button>
                        <button class="btn btn-danger">Keluarkan Dari Koordinator</button>
                        <button class="btn btn-primary">Jadikan Koordinator</button>
                    </div>
                </div> --}}

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Nomor Induk Kependudukan (NIK)</p>
                                    <h6 class="id-number"></h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Nomor Kartu Keluarga (NKK)</p>
                                    <h6 class="family-card-number"></h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Tempat, Tanggal Lahir</p>
                                    <h6 class="birthday"></h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Alamat</p>
                                    <h6 class="address-rt-rw"></h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Phone number</p>
                                    <h6 class="phone-number"></h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Tempat Pemungutan Suara (TPS)</p>
                                    <h6 class="voting-place"></h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Status</p>
                                    <h6 class="marital-status"></h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Rekam E-KTP</p>
                                    <h6 class="e-ktp"></h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Disabilitas</p>
                                    <h6 class="disability"></h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-0">
                                    <p class="font-size-12 text-muted mb-1">Keterangan Lainnya</p>
                                    <h6 class="description"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="memberList" class="card d-none">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Anggota</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Projects</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Billing Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col" colspan="2">Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Qovex admin UI</td>
                                        <td>
                                            21/01/2020
                                        </td>
                                        <td>Werner Berlin</td>
                                        <td>$ 125</td>
                                        <td><span class="badge badge-soft-success font-size-12">Paid</span>
                                        </td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Qovex admin Logo
                                        </td>
                                        <td>16/01/2020</td>

                                        <td>Robert Jordan</td>
                                        <td>$ 118</td>
                                        <td><span class="badge badge-soft-danger font-size-12">Chargeback</span>
                                        </td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Redesign - Landing page
                                        </td>
                                        <td>17/01/2020</td>

                                        <td>Daniel Finch</td>
                                        <td>$ 115</td>
                                        <td><span class="badge badge-soft-success font-size-12">Paid</span>
                                        </td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Blog Template
                                        </td>
                                        <td>18/01/2020</td>

                                        <td>James Hawkins</td>
                                        <td>$ 121</td>
                                        <td><span class="badge badge-soft-warning font-size-12">Refund</span>
                                        </td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <ul class="pagination pagination-rounded justify-content-center mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div id="emptyCard" class="d-none text-center">
            Tidak Ditemukan
        </div>
    </div>
@endsection

@push('script')
    <!-- form mask -->
    <script src="{{ asset('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".input-mask").inputmask();
            $("#idNumber").focus();
            $("#idNumber").val(6104180107510035);

            $("#form").on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    beforeSend: function() {
                        $("#submit").prop('disabled', true);

                        $("#idNumber").removeClass('is-invalid');
                        $("#loader").removeClass('d-none');
                        $("#resultCard").addClass('d-none');
                        $("#emptyCard").addClass('d-none');
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            $("#resultCard").removeClass('d-none');

                            $(".name").html(response.data.name);
                            $(".id-number").html(response.data.id_number);
                            $(".family-card-number").html(response.data.family_card_number);

                            if (response.data.phone_number == "" || response.data
                                .phone_number == null) {
                                $(".phone-number").html('-');
                            } else {
                                $(".phone-number").html(response.data.phone_number);
                            }

                            $(".birthday").html(
                                response.data.birthplace +
                                ", " + response.data.birthday
                            );
                            $(".voting-place").html(
                                "<b>TPS : " + response.data.voting_place.name +
                                "</b>, " + response.data.village.name +
                                ", " + response.data.district.name
                            );
                            $(".address-rt-rw").html(
                                response.data.address +
                                ", RT " + response.data.rt +
                                "/RW " + response.data.rt
                            );

                            if (response.data.marital_status == "B") {
                                $(".marital-status").html("Belum Menikah");
                            } else if (response.data.marital_status == "S") {
                                $(".marital-status").html("Sudah Menikah");
                            } else if (response.data.marital_status == "P") {
                                $(".marital-status").html("Pernah Menikah");
                            } else {
                                $(".marital-status").html("-");
                            }

                            if (response.data.e_ktp_record_state == "B") {
                                $(".e-ktp").html("Belum Rekam");
                            } else if (response.data.e_ktp_record_state == "S") {
                                $(".e-ktp").html("Sudah Rekam");
                            } else if (response.data.e_ktp_record_state == "K") {
                                $(".e-ktp").html("Sudah Rekam (E-KTP)");
                            } else {
                                $(".e-ktp").html("-");
                            }

                            if (response.data.disability_information == "0") {
                                $(".disability").html("-");
                            } else if (response.data.disability_information == "1") {
                                $(".disability").html("Disabilitas Fisik");
                            } else if (response.data.disability_information == "2") {
                                $(".disability").html("Disabilitas Intelektual");
                            } else if (response.data.disability_information == "3") {
                                $(".disability").html("Disabilitas Mental");
                            } else if (response.data.disability_information == "4") {
                                $(".disability").html("Disabilitas Sensorik");
                            } else {
                                $(".disability").html("-");
                            }

                            if (response.data.level == 1) {
                                console.log('Koordinator');
                                $("#badge").removeClass('bg-danger').removeClass('bg-success')
                                    .addClass('bg-primary').html('Koordinator');
                            } else {
                                if (response.data.coordinator_id == null) {
                                    $("#badge").removeClass('bg-primary').removeClass(
                                        'bg-success').addClass('bg-danger').html(
                                        'Belum Terdaftar');
                                } else {
                                    $("#badge").removeClass('bg-danger').removeClass(
                                        'bg-primary').addClass('bg-success').html(
                                        'Terdaftar');
                                }
                            }


                        } else {
                            $("#emptyCard").removeClass('d-none');
                        }

                        $("#loader").addClass('d-none');
                        $("#submit").prop('disabled', false);
                    },
                    error: function(error) {
                        console.error(error);

                        if (error.status == 422) {
                            $("#idNumberError").html(error["responseJSON"]["errors"][
                                "id_number"
                            ]);
                            $("#idNumber").addClass('is-invalid');
                        }

                        $("#loader").addClass('d-none');
                        $("#submit").prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
