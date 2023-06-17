@extends('admin.template.base')

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h6 class="page-title mb-5 mb-md-0">Data Koordinator</h6>
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
                        <span title="Sumber: DPT Pemilu 2024"><strong>{{ $coordinator_count }} Koordinator</strong></span>
                    </div>
                </div>
            </div>

            @foreach ($districts as $district)
                <div class="d-flex justify-content-between">
                    <h5 class="text-black mb-3">Koordinator Kecamatan {{ $district->name }}</h5>
                    <span>{{ $district->voters->where('level', 1)->count() }} Koordinator</span>
                </div>
                @foreach ($district->village as $village)
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="{{ url('coordinators') }}?vllg={{ $village->id }}">
                            <div class="card border-dark">
                                <div class="card-header text-black text-center bg-primary-subtle">
                                    {{ $village->name }}
                                </div>
                                <div class="card-body text-black text-center">
                                    <span class="font-size-22">{{ $village->voters->where('level', 1)->count() }}</span><br>
                                    <span>Orang</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection
