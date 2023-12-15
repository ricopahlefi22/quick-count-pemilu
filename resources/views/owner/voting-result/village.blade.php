@extends('owner.template.base')

@php
$web = App\Models\WebConfig::first();
@endphp

@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Hasil Perhitungan Cepat</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Perhitungan Cepat</a></li>
                        <li class="breadcrumb-item active">Hasil</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Perhitungan Cepat</h4>

                <div id="chartPartai" class="apex-charts" dir="ltr"></div>
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
                <h4 class="card-title mb-4">Grafik Pemetaan Pendukung <b>{{ $web->name }}</b> per Desa</h4>

                <div id="chartKandidat" class="apex-charts" dir="ltr"></div>
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
        document.querySelector("#chartPartai"), {
            chart: {
                height: 350,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true
                }
            },
            series: [{
                // data yang dihitung
                name: "Jumlah Pendukung",
                data: [
                    @foreach ($parties->sortByDesc('total_suara') as $village)
                    {
                        x: "{{ $village->name }}",
                        y: "{{ $village->total_suara}}",
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

            // nama partai
            xaxis: {
                categories: [
                    @foreach ($parties->sortByDesc('total_suara') as $village)
                    "{{ $village->name }}",
                    @endforeach
                    ],
            },
        }
        )).render();



    (chart = new ApexCharts(
        document.querySelector("#chartKandidat"), {
            chart: {
                height: 350,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                }
            },
            series: [{
                // data yang dihitung
                name: "Jumlah Pendukung",
                data: [
                    @foreach ($kandidat->sortByDesc('total_suara_kandidat')->take(15) as $item)
                    {
                        x: "{{ $item->name }}",
                        y: "{{ $item->total_suara_kandidat}}",
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

            // nama partai
            xaxis: {
                categories: [
                    @foreach ($kandidat->sortByDesc('total_suara_kandidat')->take(15) as $village)
                    "{{ $village->name }}",
                    @endforeach
                    ],
            },
        }
        )).render();
    </script>


    @endpush
