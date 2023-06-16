@extends('auth.auth-base')

@section('content')
    <div class="card overflow-hidden">
        <div class="bg-login text-center">
            <div class="bg-login-overlay"></div>
            <div class="position-relative">
                <h5 class="text-white font-size-20">Selamat Datang!</h5>
                <p class="text-white-50 mb-0">Berikan kata sandi yang tepat untuk masuk ke sistem!</p>
                <a href="http://{{ env('DOMAIN') }}:8000" class="logo logo-admin mt-4">
                    <img src="{{ asset('assets/images/logo-sm-dark.png') }}" alt="" height="30">
                </a>
            </div>
        </div>
        <div class="card-body pt-5">

            <div class="p-2">
                <form id="form" class="form-horizontal">

                    <div class="user-thumb text-center mb-4">
                        <img src="{{ asset($config->photo) }}" class="rounded-circle img-thumbnail avatar-md">
                        <h5 class="font-size-15 mt-3"><strong>{{ $config->name }}</strong></h5>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Kata Sandi</label>
                        <input id="password" type="password" name="password" class="form-control"
                            placeholder="Masukkan kata sandi">
                        <div id="passwordError" class="invalid-feedback"></div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-5">
                            <a href="{{ url('forgot-password') }}" class="text-primary">
                                Lupa kata sandi?
                            </a>
                        </div>
                        <div class="col-7 text-end">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

