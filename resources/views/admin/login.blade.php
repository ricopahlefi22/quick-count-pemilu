@extends('auth.auth-base')

@section('content')
    <div class="card overflow-hidden">
        <div class="bg-login text-center">
            <div class="bg-login-overlay"></div>
            <div class="position-relative">
                <h5 class="text-white font-size-20">Hi Admin!</h5>
                <p class="text-white-50 mb-0">Login dahulu untuk melanjutkan.</p>
                <a href="http://app.{{ env('DOMAIN') }}:8000" class="logo logo-admin mt-4">
                    <img src="{{ asset('assets/images/logo-sm-dark.png') }}" alt="" height="30">
                </a>
            </div>
        </div>
        <div class="card-body pt-5">
            <div class="p-2">
                <form id="form" class="form-horizontal">

                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" type="text" name="email" class="form-control"
                            placeholder="Masukkan email">
                        <div id="emailError" class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Kata Sandi</label>
                        <input id="password" type="password" name="password" class="form-control"
                            placeholder="Masukkan kata sandi">
                        <div id="passwordError" class="invalid-feedback"></div>
                    </div>

                    <div class="mt-3">
                        <button id="submit" class="btn btn-primary w-100 waves-effect waves-light"
                            type="submit">Masuk</button>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ url('forgot-password') }}" class="text-muted">
                            <i class="mdi mdi-lock me-1"></i> Lupa kata sandimu?
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
