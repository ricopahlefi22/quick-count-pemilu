@push('style')
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Dropify -->
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="page-content">
        <!-- Title -->
        <div class="row mt-4 mt-sm-2 mt-md-1">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title my-4 lh-1">
                        DPT {{ $village->name }}
                    </h4>

                    <div class="page-title-right d-none d-xl-block">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Data Pemilih</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a
                                    href="{{ url('voters/district', Crypt::encrypt($village->district->id)) }}">{{ $village->district->name }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $village->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Title -->

        <!-- ID Position -->
        <input id="districtIdValue" type="hidden" value="{{ $village->district->id }}">
        <input id="villageIdValue" type="hidden" value="{{ $village->id }}">
        <!-- ID Position -->

        <!-- Counter -->
        @if (Auth::guard('owner')->check())
            @livewire('live-village')
        @endif
        <!-- Counter -->

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-group dropdown float-end">
                            <button id="btnGroupDropdown" type="button" class="btn btn-sm btn-dark dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi Lainnya <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="btnGroupDropdown">
                                <button id="createButton" class="dropdown-item">
                                    <i class="fa fa-plus-circle"></i> Tambah Data
                                </button>
                                @if (Auth::guard('owner')->check())
                                    <a href="{{ url('mapping-result/village', Crypt::encrypt($village->id)) }}"
                                        class="dropdown-item">
                                        <i class="fa fa-chart-area"></i> Grafik Pemetaan Suara
                                    </a>
                                    <a href="{{ url('mapping-voters/village', Crypt::encrypt($village->id)) }}"
                                        class="dropdown-item">
                                        <i class="fa fa-users"></i> Peta Pemilih Per TPS
                                    </a>
                                    <a href="{{ url('voters/export/village', Crypt::encrypt($village->id)) }}"
                                        class="dropdown-item text-success">
                                        <i class="fa fa-file-csv"></i> Ekspor CSV
                                    </a>
                                @endif
                            </div>
                        </div>

                        <table id="table" class="table table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th>Usia</th>
                                    <th>Alamat</th>
                                    <th>TPS</th>
                                    <th>Nomor Ponsel</th>
                                    <th>Koordinator</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th>Usia</th>
                                    <th>Alamat</th>
                                    <th>TPS</th>
                                    <th>Nomor Ponsel</th>
                                    <th>Koordinator</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    @include('modals.voter')
    @include('modals.coordinator')
    @include('modals.be-coordinator')
    @include('modals.cancel-coordinator')
    @include('modals.delete-member')
@endsection

@push('script')
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Datatable -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <!-- Jquery Input Mask -->
    <script src="{{ asset('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Dropify -->
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <!-- Script -->
    @include('sections.voter.script')
@endpush
