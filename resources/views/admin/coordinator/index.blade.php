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
            <div class="col-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Jumlah</span>
                        <span>{{ $coordinator_count }} Koordinator</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <button class="btn btn-dark">Test</button>
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
