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
                    <h4 class="page-title mb-0 font-size-18">Hasil Pemetaan Suara Kecamatan {{ $village->name }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pemetaan Suara</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hasil Kecamatan</a></li>
                            <li class="breadcrumb-item active">Kecamatan {{ $village->name }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- Title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            Grafik Pemetaan Pendukung
                            <b>{{ App\Models\Candidate::where('id', $web->candidate_id)->first()->name }}</b> di
                            {{ $village->name }}
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
            document.querySelector("#barChart"), {
                chart: {
                    height: 1000,
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
                    name: "Jumlah Pendukung",
                    data: [
                        @foreach ($village->votingPlace as $votingPlace)
                            {
                                x: "{{ $votingPlace->village->name }} TPS {{ $votingPlace->name }}",
                                y: {{ $votingPlace->voters->whereNotNull('coordinator_id')->count() }},
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
                        @foreach ($village->votingPlace as $votingPlace)
                            "TPS {{ $votingPlace->name }}",
                        @endforeach
                    ],
                },
            }
        )).render();
    </script>
@endpush
