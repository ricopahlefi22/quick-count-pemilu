@push('style')
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Dropify -->
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@php
    $web = App\Models\WebConfig::first();
@endphp

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title my-4 lh-1">
                        DPT {{ $village->name }}
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">
                                    Data Pemilih
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ $village->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        @if (Auth::user()->level == true || Auth::guard('owner')->check())
            <div class="row">
                @if (Auth::guard('owner')->check())
                    <input id="districtIdValue" type="hidden" value="{{ $village->district->id }}">
                    <input id="villageIdValue" type="hidden" value="{{ $village->id }}">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card bg-soft-primary">
                            <div class="card-header text-end">
                                <span>
                                    <strong>
                                        {{ $coordinators_count }}
                                    </strong>
                                </span>
                                <span>Koordinator</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card bg-soft-primary">
                            <div class="card-header text-end">
                                <span>
                                    <strong>
                                        {{ $self_voters_count }}
                                    </strong>
                                </span>
                                <span>Pendukung</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card bg-soft-primary" title="Sumber: DPT Pemilu 2024">
                            <div class="card-header text-end">
                                <span>
                                    <strong>
                                        {{ $voting_places_count }}
                                    </strong>
                                </span>
                                <span>TPS</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card bg-soft-primary" title="Sumber: DPT Pemilu 2024">
                            <div class="card-header text-end">
                                <span>
                                    <strong>
                                        {{ $voters_count }}
                                    </strong>
                                </span>
                                <span>Pemilih</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card bg-soft-primary" title="Sumber: DPT Pemilu 2024">
                            <div class="card-header text-end">
                                <span>
                                    <strong>
                                        {{ $voting_places_count }}
                                    </strong>
                                </span>
                                <span>TPS</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card bg-soft-primary" title="Sumber: DPT Pemilu 2024">
                            <div class="card-header text-end">
                                <span>
                                    <strong>
                                        {{ $voters_count }}
                                    </strong>
                                </span>
                                <span>Pemilih</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card bg-soft-primary" title="Sumber: DPT Pemilu 2024">
                        <div class="card-header text-end">
                            <span>
                                <strong>
                                    {{ $voting_places_count }}
                                </strong>
                            </span>
                            <span>TPS</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card bg-soft-primary" title="Sumber: DPT Pemilu 2024">
                        <div class="card-header text-end">
                            <span>
                                <strong>
                                    {{ $voters_count }}
                                </strong>
                            </span>
                            <span>Pemilih</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-6">
                <h4 class="page-title mb-0 font-size-16">
                    <strong>DPT Per TPS</strong>
                </h4>
            </div>
            <div class="col-6">
                <div class="btn-group-sm dropleft float-end">
                    <button id="btnGroupDropdown" type="button" class="btn btn-block btn-dark dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aksi Lainnya <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="btnGroupDropdown">
                        <button id="createButton" class="dropdown-item">
                            <i class="fa fa-plus-circle"></i> Tambah Data
                        </button>
                        <a href="{{ url('voters/export') }}?vllg={{ $village->id }}" class="dropdown-item">
                            <i class="fa fa-file-csv"></i> Ekspor CSV
                        </a>
                        <a href="{{ url('voters/import') }}" class="dropdown-item text-success">
                            <i class="fa fa-file-pdf"></i> Impor
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($votingPlaces as $votingPlace)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-dark">
                        <a href="?tps={{ $votingPlace->id }}">
                            <div class="card-header bg-primary text-white d-flex justify-content-between">
                                <span class="lh-1">TPS {{ $votingPlace->name }}</span>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <div class="card-body">
                            <p class="my-0 lh-1">
                                Saksi :
                                {{ empty($votingPlace->witness) ? '-' : $votingPlace->witness->voter->name }}
                            </p>
                            <p class="mt-2 mb-4 lh-base">
                                Pemantau :
                                @if ($votingPlace->monitor->count() == 0)
                                    -
                                @else
                                    @foreach ($votingPlace->monitor as $monitor)
                                        <br>
                                        {{ $loop->iteration }}. {{ $monitor->voter->name }}
                                    @endforeach
                                @endif
                            </p>
                            <div class="row">
                                <div class="col-6 text-dark text-center">
                                    Jumlah Suara <strong>({{ $web->candidate->name }})</strong><br>
                                    @php
                                        $totalVotingResult = 0;
                                        foreach ($votingPlace->votingResult->where('candidate_id', $web->candidate_id) as $votingResult) {
                                            $totalVotingResult += $votingResult->number;
                                        }
                                    @endphp
                                    <strong style="font-size: 20px;">{{ $totalVotingResult }}</strong>
                                </div>
                                <div class="col-6 text-dark text-center">
                                    Jumlah Pendukung<br>
                                    <strong
                                        style="font-size: 20px;">{{ $votingPlace->voters->whereNotNull('coordinator_id')->count() }}</strong>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6 text-dark text-center">
                                    Jumlah Pemilih<br>
                                    <strong style="font-size: 20px;">{{ $votingPlace->voters->count() }}</strong>
                                </div>
                                <div class="col-6 text-dark text-center">
                                    Jumlah Koordinator<br>
                                    <strong
                                        style="font-size: 20px;">{{ $votingPlace->voters->where('level', true)->count() }}</strong>
                                </div>
                            </div>
                        </div>
                        @if ($votingPlace->address)
                            <div class="card-footer bg-secondary-subtle d-flex justify-content-between">
                                <span>{{ $votingPlace->address }}</span>
                                @if ($votingPlace->latitude)
                                    <a href="https://maps.google.com/?q={{ $votingPlace->latitude }},{{ $votingPlace->longitude }}"
                                        target="_blank"><i class="fa fa-map-marked-alt"></i></a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('modals.voter')
@endsection

@push('script')
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <!-- form mask -->
    <script src="{{ asset('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

    <!-- Dropify -->
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>

    <!-- Script -->
    <script src="{{ asset('js/voter-index.js') }}"></script>
@endpush
