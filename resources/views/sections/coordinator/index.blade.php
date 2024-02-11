@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Data Koordinator</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">
                                    @if (Auth::guard('owner')->check())
                                        Lainnya
                                    @else
                                        Menu
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Data Koordinator</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-7">
                <div class="btn-group">
                    <div class="btn-group dropdown float-end">
                        <button id="btnGroupDropdown" type="button" class="btn btn-block btn-dark dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi Lainnya <i class="mdi mdi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                            <a href="{{ url('voters/export/coordinator') }}" class="dropdown-item text-success">
                                <i class="fa fa-file-csv"></i> Ekspor CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card bg-soft-primary">
                    <div class="card-header d-flex justify-content-between">
                        <span>Jumlah:</span>
                        <span><strong>{{ $coordinator_count }} Koordinator</strong></span>
                    </div>
                </div>
            </div>

            @foreach ($districts as $district)
                <div class="d-flex justify-content-between">
                    <h5 class="text-black mb-3">Koordinator Kecamatan {{ $district->name }}</h5>
                    <span><strong>{{ $district->voters->where('level', 1)->count() }}</strong> Koordinator</span>
                </div>
                @foreach ($district->village as $village)
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="{{ url('coordinators/village', Crypt::encrypt($village->id)) }}">
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
