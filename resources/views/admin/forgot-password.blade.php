@extends('auth.auth-base')

@section('content')
    <div class="card overflow-hidden">
        <div class="bg-login text-center">
            <div class="bg-login-overlay"></div>
            <div class="position-relative">
                <h5 class="text-white font-size-20">Kirim One Time Password</h5>
                <p class="text-white-50 mb-0">Kami akan kirim OTP ke nomor Whatsappmu</p>

                <a href="{{ url('/') }}" class="logo logo-admin mt-4">
                    <img src="assets/images/logo-sm-dark.png" alt="" height="30">
                </a>
            </div>
        </div>
        <div class="card-body pt-5">

            <div class="p-2">

                <form id="form" class="form-horizontal" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="phoneNumber">No. Handphone (Whatsapp)</label>
                        <input type="tel" name="phone_number" class="form-control" id="phoneNumber"
                            placeholder="Masukkan nomor">
                        <span id="phoneNumberError" class="invalid-feedback"></span>
                    </div>

                    <div class="row mb-0">
                        <div class="col-12 text-end">
                            <button id="button" class="btn btn-primary w-md waves-effect waves-light"
                                type="submit">Kirim</button>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ url('login') }}" class="text-muted">
                            <i class="mdi mdi-lock me-1"></i> Sudah Ingat Kata Sandimu?
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @include('modals.otp')
@endsection

@push('script')
    <!-- form mask -->
    <script src="{{ asset('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("[data-mask]").inputmask();

            $("#form").on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'forgot-password',
                    method: $(this).attr("method"),
                    data: new FormData(this),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    beforeSend: function() {
                        $("#phoneNumber").removeClass('is-invalid');

                        $("#button").html(
                            '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i>'
                        ).prop('disabled', true);
                    },
                    success: function(response) {
                        if (response.code == 200) {
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
                                    $("#otpModal").modal('show');
                                    $("#token").val(response.token);
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

                        $("#button").html('Kirim').prop('disabled', false);
                    },
                    error: function(error) {
                        if (error.status == 422) {
                            var errors = error["responseJSON"]["errors"];
                            $("#phoneNumberError").html(errors["phone_number"]);

                            if (errors["phone_number"]) {
                                $("#phoneNumber").addClass('is-invalid').focus();
                            }
                        }

                        $("#button").html('Kirim').prop('disabled', false);
                    },
                });
            });

            $("#otpForm").on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'otp',
                    method: $(this).attr("method"),
                    data: new FormData(this),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    beforeSend: function() {
                        $("#otp").removeClass('is-invalid');

                        $("#otpButton").prop('disabled', true);
                    },
                    success: function(response) {
                        if (response.code == 200) {
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
                                    location.href = response.route;
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

                        $("#otpButton").prop('disabled', false);
                    },
                    error: function(error) {
                        console.log(error);
                        if (error.status == 422) {
                            var errors = error["responseJSON"]["errors"];
                            $("#otpError").html(errors["otp"]);

                            if (errors["otp"]) {
                                $("#otp").addClass('is-invalid').focus();
                            }
                        }

                        $("#otpButton").prop('disabled', false);
                    },
                });
            });
        });
    </script>
@endpush
