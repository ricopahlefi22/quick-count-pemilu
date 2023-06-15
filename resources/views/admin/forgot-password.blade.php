@extends('auth.auth-base')

@section('content')
<div class="card overflow-hidden">
    <div class="bg-login text-center">
        <div class="bg-login-overlay"></div>
        <div class="position-relative">
            <h5 class="text-white font-size-20">Atur Ulang Kata Sandi</h5>
            <p class="text-white-50 mb-0">Kami akan kirim OTP ke nomor Whatsappmu</p>

            <a href="index.html" class="logo logo-admin mt-4">
                <img src="assets/images/logo-sm-dark.png" alt="" height="30">
            </a>
        </div>
    </div>
    <div class="card-body pt-5">

        <div class="p-2">

            <form class="form-horizontal" action="forgot-password" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="phoneNumber">No. Handphone (Whatsapp)</label>
                    <input type="tel" name="phone_number" class="form-control" id="phoneNumber"
                        placeholder="Masukkan nomor">
                </div>

                <div class="row mb-0">
                    <div class="col-12 text-end">
                        <button class="btn btn-primary w-md waves-effect waves-light"
                            type="submit">Kirim</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
