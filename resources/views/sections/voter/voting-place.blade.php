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
        <div class="row mt-4 mt-sm-2 mt-md-1">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title my-4 lh-1">
                        DPT {{ $votingPlace->name }}
                    </h4>

                    <div class="page-title-right d-none d-xl-block">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Data Pemilih</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $votingPlace->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <input id="districtIdValue" type="hidden" value="{{ $votingPlace->id }}">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between flex-column flex-sm-row">
                        <div class="d-flex align-items-center">
                            <span style="height: 10px;width:10px;margin-right:5px;" class="bg-primary"></span> =
                            Koordinator ({{ $coordinators_count }} Orang)
                        </div>
                        <div class="d-flex align-items-center">
                            <span style="height: 10px;width:10px;margin-right:5px;" class="bg-primary-subtle"></span> =
                            Terdaftar ({{ $registered_voters_count }} Orang)
                        </div>
                        <div class="d-flex align-items-center">
                            <span style="height: 10px;width:10px;margin-right:5px;" class="bg-secondary-subtle"></span> =
                            Tidak Terdaftar ({{ $not_registered_voters_count }} Orang)
                        </div>
                        <div class="d-flex align-items-center">
                            {{-- <span style="height: 10px;width:10px;margin-right:5px;" class="bg-dark"></span> = --}}
                            Total Pemilih ({{ $voters_count }} Orang)
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="btn-group dropdown float-end">
                            <button id="btnGroupDropdown" type="button" class="btn btn-sm btn-dark dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi Lainnya <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="btnGroupDropdown">
                                {{-- <button id="createButton" class="dropdown-item">
                                    <i class="fa fa-plus-circle"></i> Tambah Data
                                </button> --}}
                                <a href="{{ url('mapping-result/votingPlace', Crypt::encrypt($votingPlace->id)) }}" class="dropdown-item">
                                    <i class="fa fa-chart-area"></i> Grafik Pemetaan Suara
                                </a>
                                <a href="{{ url('mapping-voters/votingPlace', Crypt::encrypt($votingPlace->id)) }}" class="dropdown-item">
                                    <i class="fa fa-users"></i> Peta Pendukung Per TPS
                                </a>
                                <a href="{{ url('voters/export/votingPlace', Crypt::encrypt($votingPlace->id)) }}" class="dropdown-item text-success">
                                    <i class="fa fa-file-csv"></i> Ekspor CSV
                                </a>
                                {{-- <a href="{{ url('voters/import') }}" class="dropdown-item text-success">
                                    <i class="fa fa-file-pdf"></i> Impor
                                </a> --}}
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
    <script src="{{ asset('js/voting-place-voter-table.js') }}"></script>
@endpush
