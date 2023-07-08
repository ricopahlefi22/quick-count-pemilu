@extends('owner.template.base')

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
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="avatar-sm font-size-20 me-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                    <i class="mdi mdi-tag-plus-outline"></i>
                                </span>
                            </div>
                            <div class="flex-1">
                                <div class="font-size-16 mt-2">New Orders</div>
                            </div>
                        </div>
                        <h4 class="mt-4">1,368</h4>
                        <div class="row">
                            <div class="col-7">
                                <p class="mb-0"><span class="text-success me-2"> 0.28% <i class="mdi mdi-arrow-up"></i>
                                    </span></p>
                            </div>
                            <div class="col-5 align-self-center">
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
                                    <i class="mdi mdi-account-multiple-outline"></i>
                                </span>
                            </div>
                            <div class="flex-1">
                                <div class="font-size-16 mt-2">New Users</div>

                            </div>
                        </div>
                        <h4 class="mt-4">2,456</h4>
                        <div class="row">
                            <div class="col-7">
                                <p class="mb-0"><span class="text-success me-2"> 0.16% <i class="mdi mdi-arrow-up"></i>
                                    </span></p>
                            </div>
                            <div class="col-5 align-self-center">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                        aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sales Report</h4>

                        <div id="line-chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->
    </div>
@endsection
