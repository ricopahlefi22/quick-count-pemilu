@extends('admin.template.base')

@push('style')
    <!-- jquery.vectormap css -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Beranda</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Selamat Datang di Quixx</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">
                            <p class="mb-2">Jumlah Kecamatan</p>
                            <div class="row">
                                <div class="col-9">
                                    <h4 class="mb-0">{{ $districts->count() }}</h4>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-sm btn-outline-dark"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">
                            <p class="mb-2">Jumlah Desa</p>
                            <div class="row">
                                <div class="col-9">
                                    <h4 class="mb-0">{{ $villages->count() }}</h4>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-sm btn-outline-dark"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <p class="mb-2">Jumlah TPS</p>
                                <h4 class="mb-0">{{ $voting_places->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <p class="mb-2">Jumlah Pemilih</p>
                                <h4 class="mb-0">{{ $voters->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            <i class="fas fa-info-circle h6 text-primary"></i> Informasi
                        </h4>
                        <div id="reviewExampleControls" class="carousel slide review-carousel" data-ride="carousel">

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div>
                                        <p>Sistem ini dikembangkan oleh Kayong Developer Community. apabila terjadi
                                            kendala
                                            yang mengganggu berjalannya sistem atau memerlukan bantuan dalam penggunaan
                                            sistem, harap hubungi kontak berikut melalui telepon ataupun whatsapp.</p>
                                        <div class="d-flex align-items-start mt-4">
                                            <div class="avatar-sm me-3">
                                                <a href="https://wa.me/6285171121070" target="_blank"
                                                    class="avatar-title bg-success text-white rounded-circle">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </div>
                                            <div class="flex-1">
                                                <h5 class="font-size-16 mb-1">Kayong Developer</h5>
                                                <p class="mb-2">0851-7112-1070</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div>
                                        <p>The new common language will be more simple and regular than the
                                            existing European languages. The new common language will be more simple and
                                            regular than the
                                            existing European languages.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div>
                                        <p>The new common language will be more simple and regular than the
                                            existing European languages.</p>
                                        <div class="d-flex align-items-start mt-4">
                                            <div class="avatar-sm me-3">
                                                <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                    S
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h5 class="font-size-16 mb-1">Simon Hawkins</h5>
                                                <p class="mb-2">CEO of XYZ Company</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a class="carousel-control-prev" href="#reviewExampleControls" role="button"
                                data-bs-slide="prev">
                                <i class="mdi mdi-chevron-left carousel-control-icon"></i>
                            </a>
                            <a class="carousel-control-next" href="#reviewExampleControls" role="button"
                                data-bs-slide="next">
                                <i class="mdi mdi-chevron-right carousel-control-icon"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>

    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
@endpush
