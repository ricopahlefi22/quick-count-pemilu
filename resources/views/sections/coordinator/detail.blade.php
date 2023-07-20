@push('style')
    <!-- Lightbox css -->
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Detail Data Koordinator {{ $coordinator->name }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Data Koordinator</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-widgets py-2">

                            <div class="text-center">
                                <a class="image-popup-no-margins"
                                    href="{{ asset(empty($coordinator->photo) ? 'images/default-photos.jpg' : $coordinator->photo) }}">
                                    <img src="{{ asset(empty($coordinator->photo) ? 'images/default-photos.jpg' : $coordinator->photo) }}"
                                        class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                    <div class="online-circle font-size-22">
                                        @if ($coordinator->gender == 'P')
                                            <i class="fa fa-venus text-danger" title="Perempuan"></i>
                                        @else
                                            <i class="fa fa-mars text-primary" title="Laki-Laki"></i>
                                        @endif
                                    </div>
                                </a>

                                <div class="mt-3">
                                    <a href="javascript:void(0)" class="text-reset font-size-16">
                                        <strong>{{ $coordinator->name }}</strong>
                                    </a>
                                    <p class="text-body mt-1 mb-1">{{ $coordinator->id_number }}</p>

                                    <span class="badge bg-primary">Koordinator</span>
                                    @if ($coordinator->marital_status == 'B')
                                        <span class="badge bg-success">Belum Menikah</span>
                                    @elseif ($coordinator->marital_status == 'S')
                                        <span class="badge bg-danger">Sudah Menikah</span>
                                    @else
                                        <span class="badge bg-warning">Pernah Menikah</span>
                                    @endif
                                </div>

                                <div class="row mt-3 border border-start-0 border-end-0 p-2">
                                    <div class="col-md-6">
                                        <h6 class="text-muted">
                                            TPS
                                        </h6>
                                        <h5 class="mb-0">
                                            {{ $coordinator->votingPlace->name }} <br>
                                            <strong class="font-size-11">{{ $coordinator->village->name }}</strong>
                                        </h5>
                                    </div>

                                    <div class="col-md-6">
                                        <h6 class="text-muted">
                                            Jumlah Anggota
                                        </h6>
                                        <h5 class="mb-0">{{ $coordinator->member->except($coordinator->id)->count() }}
                                        </h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-3 font-size-11 text-muted">Data Pribadi</p>

                        <div class="mt-2">
                            <p class="font-size-12 text-muted mb-1">No. KK</p>
                            <h6 class="">
                                {{ empty($coordinator->family_card_number) ? '-' : $coordinator->family_card_number }}
                            </h6>
                        </div>

                        <div class="mt-2">
                            <p class="font-size-12 text-muted mb-1">No. Handphone</p>
                            <h6 class="">
                                {{ empty($coordinator->phone_number) ? '-' : $coordinator->phone_number }}
                            </h6>
                        </div>

                        <div class="mt-2">
                            <p class="font-size-12 text-muted mb-1">Alamat</p>
                            <h6 class="">
                                {{ $coordinator->address }}, RT {{ $coordinator->rt }}/RW
                                {{ $coordinator->rw }}
                            </h6>
                        </div>

                        <div class="mt-2">
                            @if ($coordinator->birthplace && $coordinator->birthday)
                                <p class="font-size-12 text-muted mb-1">Tempat, Tanggal Lahir</p>
                                <h6 class="">
                                    {{ $coordinator->birthplace }},
                                    {{ Carbon\Carbon::parse($coordinator->birthday)->locale('id')->isoFormat('D MMMM Y') }}
                                </h6>
                            @elseif ($coordinator->birthplace)
                                <p class="font-size-12 text-muted mb-1">Tempat Lahir</p>
                                <h6 class="">
                                    {{ $coordinator->birthplace }}
                                </h6>
                            @elseif ($coordinator->birthday)
                                <p class="font-size-12 text-muted mb-1">Tanggal Lahir</p>
                                <h6 class="">
                                    {{ Carbon\Carbon::parse($coordinator->birthday)->locale('id')->isoFormat('D MMMM Y') }}
                                </h6>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Anggota</h4>

                        <div class="table-responsive">
                            <table id="table" class="table table-centered mb-0">
                                <thead>
                                    <tr>
                                        {{-- <th>Aksi</th> --}}
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>TPS</th>
                                        <th>Kelurahan/Desa</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- end row -->

    </div>
@endsection

@push('script')
    <!-- Datatable -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Magnific Popup-->
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- Tour init js-->
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>

    <script src="{{ asset('js/member-table.js') }}"></script>
@endpush
