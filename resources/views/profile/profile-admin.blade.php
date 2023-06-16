@extends('admin.template.base')


@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Profil Saya</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Akun</a></li>
                            <li class="breadcrumb-item active">Profil</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- start row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title-desc">
                            Berikut adalah data pribadimu, harap jaga kerahasiaan akunmu untuk keamanan data.
                        </p>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">Nama Lengkap</p>
                            <h6 class="">{{ Auth::user()->name }}</h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">Alamat Email</p>
                            <h6 class="">{{ Auth::user()->email }}</h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">Nomor Handphone (Whatsapp)</p>
                            <h6 class="">{{ Auth::user()->phone_number }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end row -->

    </div>
@endsection
