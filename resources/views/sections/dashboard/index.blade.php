@php
    $web = App\Models\WebConfig::first();
@endphp

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

<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="align-items-center">
                    <p class="mb-2">Jumlah Kecamatan</p>
                    <div class="row">
                        <div class="col-6">
                            <h4 class="mb-0">{{ $districts->count() }}</h4>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-sm btn-outline-dark float-end" data-bs-toggle="modal"
                                data-bs-target="#districtDashboardModal">
                                <i class="fa fa-eye"></i> <span class="d-md-none">Lihat</span>
                            </button>

                            <div class="modal fade" id="districtDashboardModal" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Data Kecamatan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table id="table" class="table table-bordered dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Kecamatan</th>
                                                        <th>Jumlah Desa</th>
                                                        <th>Jumlah TPS</th>
                                                        <th>Jumlah Pemilih</th>
                                                        <th>Pemetaan Suara</th>
                                                        <th>Perolehan Suara</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($districts as $district)
                                                        <tr>
                                                            <td class="fw-bold">
                                                                {{ $district->name }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $district->village->count() }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $district->votingPlace->count() }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $district->voters->count() }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $district->voters->whereNotNull('coordinator_id')->count() }}
                                                            </td>
                                                            <td class="text-center">
                                                                @php
                                                                    $districtVotingResult = 0;
                                                                    foreach ($district->votingResult->where('party_id', $web->party_id)->where('candidate_id', $web->candidate_id) as $key => $value) {
                                                                        $districtVotingResult += $value->number;
                                                                    }
                                                                @endphp

                                                                {{ $districtVotingResult }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="align-items-center">
                    <p class="mb-2">Jumlah Desa</p>
                    <div class="row">
                        <div class="col-6">
                            <h4 class="mb-0">{{ $villages->count() }}</h4>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-sm btn-outline-dark float-end" data-bs-toggle="modal"
                                data-bs-target="#villageDashboardModal">
                                <i class="fa fa-eye"></i> <span class="d-md-none">Lihat</span>
                            </button>

                            <div class="modal fade" id="villageDashboardModal" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Data Kelurahan / Desa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table datatable table-bordered dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Kecamatan</th>
                                                        <th>Kelurahan/Desa</th>
                                                        <th>Jumlah TPS</th>
                                                        <th>Jumlah Pemilih</th>
                                                        <th>Pemetaan Suara</th>
                                                        <th>Perolehan Suara</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($villages as $village)
                                                        <tr>
                                                            <td>
                                                                {{ $village->district->name }}
                                                            </td>
                                                            <td>
                                                                {{ $village->name }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $village->votingPlace->count() }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $village->voters->count() }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $village->voters->whereNotNull('coordinator_id')->count() }}
                                                            </td>
                                                            <td class="text-center">
                                                                @php
                                                                    $villageVotingResult = 0;
                                                                    foreach ($village->votingResult->where('party_id', $web->party_id)->where('candidate_id', $web->candidate_id) as $key => $value) {
                                                                        $villageVotingResult += $value->number;
                                                                    }
                                                                @endphp

                                                                {{ $villageVotingResult }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <p class="mb-2">Jumlah TPS</p>
                        <h4 class="mb-0">{{ $voting_places->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <p class="mb-2">Jumlah Pemilih</p>
                        <h4 class="mb-0">{{ $voters_count }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
