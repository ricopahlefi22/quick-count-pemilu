@push('style')
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Dropify -->
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <a id="createButton" class="my-4 btn btn-sm btn-dark float-end">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">
                                    @if (Auth::guard('owner')->check())
                                        Perhitungan Cepat
                                    @else
                                        Menu
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item">Data Perolehan Suara (C1)</li>
                            <li class="breadcrumb-item active">Input C1</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <form id="form" action="{{ url('input-voting-results/store') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="voting_place_id" value="{{ $votingPlace->id }}">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <h5 class="my-0 lh-base">
                                        TPS :
                                        <strong>{{ $votingPlace->name }}</strong>
                                    </h5>
                                    <h5 class="my-0 lh-base">
                                        Desa/Kelurahan :
                                        <strong>{{ $votingPlace->village->name }}</strong>
                                    </h5>
                                    <h5 class="my-0 lh-base">
                                        Kecamatan :
                                        <strong>{{ $votingPlace->district->name }}</strong>
                                    </h5>
                                    <h5 class="my-0 lh-base">
                                        Alamat :
                                        <strong>{{ empty($votingPlace->address) ? '-' : $votingPlace->address }}</strong>
                                    </h5>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input id="hiddenFile" type="hidden" name="hidden_file"
                                        value="{{ empty($votingPlace->voting_result_file) ? null : $votingPlace->voting_result_file }}">
                                    <input id="file" type="file" name="file" accept=".pdf"
                                        data-default-file="{{ empty($votingPlace->voting_result_file) ? null : $votingPlace->voting_result_file }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                @foreach ($parties as $party)
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div
                                class="card-header {{ App\Models\WebConfig::first()->party_id == $party->id ? 'bg-primary-subtle' : null }} d-flex justify-content-between">
                                <strong class="fs-2 float-end">
                                    {{ $party->number }}.
                                </strong>

                                <img src="{{ asset($party->logo) }}" height="50" alt="Logo {{ $party->name }}">
                            </div>
                            <div
                                class="card-body {{ App\Models\WebConfig::first()->party_id == $party->id ? 'bg-primary-subtle' : null }}">
                                <div class="lh-1">
                                    <h4 class="mb-4 text-center">
                                        <strong>{{ $party->name }}</strong>
                                    </h4>
                                    @foreach ($party->candidates as $candidate)
                                        <div class="row d-flex align-items-center my-2">
                                            <div class="col-6">
                                                <h6
                                                    class="{{ App\Models\WebConfig::first()->candidate_id == $candidate->id ? 'fw-bold' : null }}">
                                                    <strong>{{ $candidate->number }}.</strong> {{ $candidate->name }}
                                                </h6>
                                            </div>
                                            <div class="col-6">
                                                <input type="number" name="number_voters_candidate_{{ $candidate->id }}"
                                                    class="form-control" placeholder="Masukkan Jumlah Suara"
                                                    value="{{ empty($candidate->votingResult->where('voting_place_id', $votingPlace->id)->first()->number) ? null : $candidate->votingResult->where('voting_place_id', $votingPlace->id)->first()->number }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <button id="submit" type="submit" class="my-4 float-end btn btn-primary">
                    Simpan C1 <i class="mdi mdi-send"></i>
                </button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Dropify -->
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <!-- Script -->
    <script src="{{ asset('js/input-c1.js') }}"></script>
@endpush
