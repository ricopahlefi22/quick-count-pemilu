@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Data Partai</h4>

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
                            <li class="breadcrumb-item active">Data Partai</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            @foreach ($parties as $party)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card">
                        <div class="card-header text-bg-dark">
                            <h3>
                                <div class="btn-group dropdown float-start">
                                    <button id="btnGroupDropdown" type="button"
                                        class="btn btn-block btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                                        <a href="{{ url('parties/detail', Crypt::encrypt($party->id)) }}" class="dropdown-item">
                                            <i class="fa fa-file-csv"></i> Detail
                                        </a>
                                        <a href="{{ url('voters/import') }}" class="dropdown-item text-success">
                                            <i class="fa fa-file-pdf"></i> Edit
                                        </a>
                                        <a href="{{ url('voters/import') }}" class="dropdown-item text-success">
                                            <i class="fa fa-file-pdf"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                                <strong class="float-end">
                                    {{ $party->number }}
                                </strong>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h5 class="text-center mb-4">
                                    <strong>{{ $party->name }}</strong>
                                </h5>
                                <div class="col-4">
                                    <img src="{{ asset($party->logo) }}" class="img-fluid" alt="Logo {{ $party->name }}">
                                </div>
                                <div class="col-8">
                                    <p>Laki: {{ $party->candidates->where('gender', 'Laki-Laki')->count() }}</p>
                                    <p>Perempuan: {{ $party->candidates->where('gender', 'Perempuan')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- end row -->
    </div>
@endsection
