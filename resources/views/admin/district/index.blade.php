@extends('admin.template.base')

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Data Kecamatan</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Charts</a></li>
                            <li class="breadcrumb-item active">Chartjs</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            @foreach ($districts as $district)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">{{ $district->name }}</h4>

                            <div class="row text-center">
                                <div class="col-4">
                                    <h5 class="mb-0">0</h5>
                                    <p class="text-muted text-truncate">Terdaftar</p>
                                </div>
                                <div class="col-4">
                                    <h5 class="mb-0">0</h5>
                                    <p class="text-muted text-truncate">Belum Terdaftar</p>
                                </div>
                                <div class="col-4">
                                    <h5 class="mb-0">{{ $district->voters->count() }}</h5>
                                    <p class="text-muted text-truncate">Total</p>
                                </div>
                            </div>

                            <canvas id="pie" height="260"></canvas>

                        </div>
                    </div>
                </div>
            @endforeach
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection

@push('script')
    <!-- Chart JS -->
    <script src="assets/libs/chart.js/Chart.bundle.min.js"></script>
    <script src="assets/js/pages/chartjs.init.js"></script>
@endpush
