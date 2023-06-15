@extends('admin.template.base')

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h6 class="page-title mb-5 mb-md-0">Data TPS di {{ $village->name }}</h6>

                    <div class="page-title-right d-none">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Data Pemilih</a>
                            </li>
                            <li class="breadcrumb-item active">Kecamatan {{ $village->district->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            @foreach ($votingPlaces as $votingPlace)
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="voters?tps={{ $votingPlace->id }}">
                        <div class="card border-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        class="col-4 bg-primary text-white rounded d-flex align-items-center justify-content-center text-center">
                                        TPS {{ $votingPlace->name }}
                                    </div>
                                    <div class="col-8 text-dark text-center">
                                        Jumlah Pemilih <br>
                                        <strong style="font-size: 20px;">{{ $votingPlace->voters->count() }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection
