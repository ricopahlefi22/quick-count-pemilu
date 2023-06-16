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

        @if (App\Models\WebConfig::first()->strict == true)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">
                                <i class="fas fa-info-circle h6 text-primary"></i> Panduan
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
                                                    <p class="mb-2">Kayong Developer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div>
                                            <p>For science, music, sport, etc, Europe uses the same vocabulary
                                                languages only differ in their grammar</p>
                                            <div class="d-flex align-items-start mt-4">
                                                <div class="avatar-sm me-3">
                                                    <img src="assets/images/users/avatar-4.jpg" alt=""
                                                        class="img-fluid rounded-circle">
                                                </div>
                                                <div class="flex-1">
                                                    <h5 class="font-size-16 mb-1">Kelly Rivera</h5>
                                                    <p class="mb-2">Web Developer</p>
                                                </div>
                                            </div>
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
        @else
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="avatar-sm font-size-20 me-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                        <i class="fa fa-users"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h5 class="">Jumlah Pemetaan Suara</h5>
                                </div>
                            </div>
                            <h2 class="mt-3 text-end"><strong>{{ $voters }}</strong></h2>
                            <div class="row">
                                <div class="col-12 align-self-center">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 62%"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="avatar-sm font-size-20 me-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                        <i class="fa fa-user-tie"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h5 class="">Jumlah Koordinator</h5>
                                </div>
                            </div>
                            <h2 class="mt-3 text-end"><strong>{{ $coordinators }}</strong></h2>
                            <div class="row">
                                <div class="col-12 align-self-center">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 62%"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Sales Report</h4>

                            <div id="line-chart" class="apex-charts"></div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach (App\Models\District::all() as $district)
                <h4>Kecamatan {{ $district->name }}</h4>
                <div class="row">
                    @foreach ($district->village as $village)
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between">
                                    <span>{{ $village->name }}</span>
                                    <span>{{$village->voters->whereNotNull('coordinator_id')->count()}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
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
