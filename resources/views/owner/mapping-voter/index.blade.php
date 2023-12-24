@extends('owner.template.base')

@php
    $web = App\Models\WebConfig::first();
@endphp

{{-- @push('style')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush --}}

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Hasil Pemetaan Suara</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pemetaan Suara</a></li>
                            <li class="breadcrumb-item active">Hasil</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-2">Perbandingan Pendukung <b>{{ $web->name }}</b> per Kecamatan Dalam Persentase</p>

                        <div id="pieChart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-2">Perbandingan Pendukung <b>{{ $web->name }}</b> per Desa Dalam Persentase</p>

                        <div id="donutChart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Grafik Pemetaan Pendukung <b>{{ $web->name }}</b> per Desa</h4>

                        <div id="barChart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
        </div>
        <!-- end row -->

    </div>
@endsection

@push('script')
    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script type="text/javascript">
        (chart = new ApexCharts(
            document.querySelector("#pieChart"), {
                chart: {
                    height: 400,
                    type: "pie"
                },
                series: [
                    @foreach ($districts as $district)
                        {{ $district->voters->whereNotNull('coordinator_id')->count() }},
                    @endforeach
                ],
                labels: [
                    @foreach ($districts as $district)
                        "{{ $district->name }}",
                    @endforeach
                ],
                legend: {
                    show: true,
                    position: "bottom",
                    horizontalAlign: "center",
                    verticalAlign: "middle",
                    floating: false,
                    fontSize: "14px",
                    offsetX: 0,
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            height: 250
                        },
                        legend: {
                            show: false
                        }
                    },
                }, ],
            }
        )).render();

        (chart = new ApexCharts(
            document.querySelector("#donutChart"), {
                chart: {
                    height: 365,
                    type: "donut"
                },
                series: [
                    @foreach ($villages as $village)
                        {{ $village->voters->whereNotNull('coordinator_id')->count() }},
                    @endforeach
                ],
                labels: [
                    @foreach ($villages as $village)
                        "{{ $village->name }}",
                    @endforeach
                ],
                colors: [
                    "#067913",
                    "#1ebf65",
                    "#b12f73",
                    "#0be3e8",
                    "#a70a10",
                    "#53f2af",
                    "#2c3219",
                    "#d8c53f",
                    "#bf5a45",
                    "#91e6f5",
                    "#f405ba",
                    "#abc21d",
                    "#df4230",
                    "#0acddc",
                    "#2e74e3",
                    "#a09c17",
                    "#0b5919",
                    "#8fa08c",
                    "#53a497",
                    "#a199a6",
                    "#f5be84",
                    "#64d045",
                ],
                legend: {
                    show: true,
                    horizontalAlign: "center",
                    verticalAlign: "middle",
                    floating: !1,
                    fontSize: "0px",
                    offsetX: 0,
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            height: 250
                        },
                        legend: {
                            show: false,

                        }
                    },
                }, ],
            }
        )).render();

        (chart = new ApexCharts(
            document.querySelector("#barChart"), {
                chart: {
                    height: 350,
                    type: "bar",
                    toolbar: {
                        show: !1
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false
                    }
                },
                series: [{
                    name: "Jumlah Pendukung",
                    data: [
                        @foreach ($villages as $village)
                            {
                                x: "{{ $village->name }}",
                                y: {{ $village->voters->whereNotNull('coordinator_id')->count() }},
                            },
                        @endforeach
                    ],
                }],
                colors: ["#000000"],
                // grid: {
                //     borderColor: "#f1f1f1"
                // },
                legend: {
                    show: true,
                    floating: false,
                    fontSize: "10px",
                    offsetX: 0,
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        plotOptions: {
                            bar: {
                                horizontal: true
                            }
                        },
                        legend: {
                            // position: "bottom"
                        }
                    }
                }],
                xaxis: {
                    categories: [
                        @foreach ($villages as $village)
                            "{{ $village->name }}",
                        @endforeach
                    ],
                },
            }
        )).render();
    </script>
@endpush
