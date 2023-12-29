@extends('owner.template.base')

@php
    $web = App\Models\WebConfig::first();
@endphp

@section('content')
    <div class="page-content">
        <!-- Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Hasil Pemetaan Suara Kecamatan {{ $district->name }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pemetaan Suara</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hasil Kecamatan</a></li>
                            <li class="breadcrumb-item active">Kecamatan {{ $district->name }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- Title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-2">Perbandingan Pendukung
                            <b>{{ App\Models\Candidate::where('id', $web->candidate_id)->first()->name }}</b> per Desa Dalam
                            Persentase di Kecamatan {{ $district->name }}</p>

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
                        <h4 class="card-title mb-4">
                            Grafik Pemetaan Pendukung
                            <b>{{ App\Models\Candidate::where('id', $web->candidate_id)->first()->name }}</b> per Desa di
                            Kecamatan {{ $district->name }}
                        </h4>

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
            document.querySelector("#donutChart"), {
                chart: {
                    height: 365,
                    type: "pie"
                },
                series: [
                    @foreach ($district->village as $village)
                        {{ $village->voters->whereNotNull('coordinator_id')->count() }},
                    @endforeach
                ],
                labels: [
                    @foreach ($district->village as $village)
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
                        @foreach ($district->village as $village)
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
                        @foreach ($district->village as $village)
                            "{{ $village->name }}",
                        @endforeach
                    ],
                },
            }
        )).render();
    </script>
@endpush
