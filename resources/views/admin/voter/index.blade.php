@extends('admin.template.base')

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h5 class="page-title mb-5 mb-md-0">Daftar Pemilih Tetap di
                       <strong>{{ $village->name }}</strong>
                    </h5>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-7">
                <div class="btn-group">
                    <a href="#" class="btn btn-success disabled">Hasil Perhitungan Cepat</a>
                    <a href="#" class="btn btn-primary disabled">Hasil Pemetaan Suara</a>
                    <div class="btn-group dropdown float-end">
                        <button id="btnGroupDropdown" type="button" class="btn btn-block btn-dark dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi Lainnya <i class="mdi mdi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                            <button class="dropdown-item" disabled><i class="fa fa-file-csv"></i> Ekspor CSV</button>
                            <button class="dropdown-item" disabled><i class="fa fa-file-pdf"></i> Cetak PDF</button>
                            <a href="{{ url('voters/import') }}" class="dropdown-item text-success"><i
                                    class="fa fa-file-pdf"></i> Impor</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card bg-soft-primary">
                    <div class="card-header d-flex justify-content-between">
                        <span>Jumlah</span>
                        <span title="Sumber: DPT Pemilu 2024"><strong>{{ $voter_count }} Pemilih</strong></span>
                    </div>
                </div>
            </div>

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
