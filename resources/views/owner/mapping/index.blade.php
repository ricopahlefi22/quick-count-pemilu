@extends('owner.template.base')

@php
    $web = App\Models\WebConfig::first();
@endphp

@push('style')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <div class="page-content">

        <!-- start page title -->
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Column Charts</h4>

                        <div id="columnChart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-2">Grafik Pendukung <b>{{ $web->name }}</b> per Kecamatan</p>

                        <div id="pieChart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Bar Chart</h4>

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

    <!-- apexcharts init -->
    {{-- <script src="{{ asset('assets/js/pages/apexcharts.init.js') }}"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            columnChart = {
                chart: {
                    height: 350,
                    type: "bar",
                    toolbar: {
                        show: !1
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "45%",
                        endingShape: "rounded"
                    },
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    show: !0,
                    width: 2,
                    colors: ["transparent"]
                },
                series: [{
                        name: "Net Profit",
                        data: [46, 57, 59, 54, 62, 58, 64, 60, 66]
                    },
                    {
                        name: "Revenue",
                        data: [74, 83, 102, 97, 86, 106, 93, 114, 94]
                    },
                    {
                        name: "Free Cash Flow",
                        data: [37, 42, 38, 26, 47, 50, 54, 55, 43]
                    },
                ],
                colors: ["#45cb85", "#3b5de7", "#eeb902"],
                xaxis: {
                    categories: [
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                    ],
                },
                yaxis: {
                    title: {
                        text: "$ (thousands)"
                    }
                },
                grid: {
                    borderColor: "#f1f1f1"
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(e) {
                            return "$ " + e + " thousands";
                        },
                    },
                },
            };
            (chart = new ApexCharts(
                document.querySelector("#columnChart"),
                columnChart
            )).render();

            pieChart = {
                chart: {
                    height: 380,
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
            };
            (chart = new ApexCharts(
                document.querySelector("#pieChart"),
                pieChart
            )).render();
        });

        barChart = {
            chart: {
                height: 350,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    horizontal: !0
                }
            },
            dataLabels: {
                enabled: !1
            },
            series: [{
                data: [380, 430, 450, 475, 550, 584, 780, 1100, 1220, 1365]
            }],
            colors: ["#45cb85"],
            grid: {
                borderColor: "#f1f1f1"
            },
            xaxis: {
                categories: [
                    "South Korea",
                    "Canada",
                    "United Kingdom",
                    "Netherlands",
                    "Italy",
                    "France",
                    "Japan",
                    "United States",
                    "China",
                    "Germany",
                ],
            },
        };
        (chart = new ApexCharts(
            document.querySelector("#barChart"),
            barChart
        )).render();
    </script>
@endpush
