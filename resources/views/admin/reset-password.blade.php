@extends('auth.auth-base')

@section('content')
    <div class="card overflow-hidden">
        <div class="bg-login text-center">
            <div class="bg-login-overlay"></div>
            <div class="position-relative">
                <h5 class="text-white font-size-20">Atur Ulang Kata Sandi</h5>
                <p class="text-white-50 mb-0">Masukkan kata sandi barumu untuk masuk ke dalam sistem</p>

                <a href="{{ url('/') }}" class="logo logo-admin mt-4">
                    <img src="{{ asset('assets/images/logo-sm-dark.png') }}" alt="" height="30">
                </a>
            </div>
        </div>
        <div class="card-body pt-5">

            <div class="p-2">
                <form id="form" class="form-horizontal" method="POST">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label class="form-label" for="password">Kata Sandi baru</label>
                        <input type="password" name="password" class="form-control" id="password">
                        <span id="passwordError" class="invalid-feedback"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="confirmPassword">Konfirmasi Kata Sandi</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirmPassword">
                        <span id="confirmPasswordError" class="invalid-feedback"></span>
                    </div>
                    <div class="row mb-0">
                        <div class="col-12 text-end">
                            <button id="button" class="btn btn-primary w-md waves-effect waves-light"
                                type="submit">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $("#password").focus();

            $("#form").on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'reset-password',
                    method: $(this).attr("method"),
                    data: new FormData(this),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    beforeSend: function() {
                        $("#password").removeClass('is-invalid');
                        $("#confirmPassword").removeClass('is-invalid');

                        $("#button").html(
                            '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i>'
                        ).prop('disabled', true);
                    },
                    success: function(response) {
                        console.log(response);
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
                                    window.location.href = '/login';
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
                        console.log(error);
                        if (error.status == 422) {
                            var errors = error["responseJSON"]["errors"];
                            $("#passwordError").html(errors["password"]);
                            $("#confirmPasswordError").html(errors["confirm_password"]);

                            if (errors["confirm_password"]) {
                                $("#confirmPassword").addClass('is-invalid').focus();
                            }

                            if (errors["password"]) {
                                $("#password").addClass('is-invalid').focus();
                            }
                        }

                        $("#button").html('Kirim').prop('disabled', false);
                    },
                });
            });
        });
    </script>
@endpush
