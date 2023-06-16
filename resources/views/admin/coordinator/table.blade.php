@extends('admin.template.base')

@push('style')
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
        <!-- start page title -->
        <div class="row mt-4 mt-sm-2 mt-md-1">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-2 mb-md-0 font-size-18" style="line-height: 1.5em;">
                        Koordinator di {{ $village->name }}
                    </h4>

                    <div class="page-title-right d-none d-xl-block">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Data Pemilih</a>
                            </li>
                            <li class="breadcrumb-item active">Kecamatan {{ $village->district->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header d-flex justify-content-between flex-column flex-sm-row">
                        <div class="d-flex align-items-center">
                            <span style="height: 10px;width:10px;margin-right:5px;" class="bg-primary"></span> = Koordinator
                        </div>
                        <div class="d-flex align-items-center">
                            <span style="height: 10px;width:10px;margin-right:5px;" class="bg-primary-subtle"></span> =
                            Terdaftar
                        </div>
                        <div class="d-flex align-items-center">
                            <span style="height: 10px;width:10px;margin-right:5px;" class="bg-secondary-subtle"></span> =
                            Tidak Terdaftar
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->level == true)
                            <div class="btn-group dropup float-end">
                                <button id="btnGroupDropdown" type="button" class="btn btn-sm btn-dark dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi Lainnya <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                                    <button id="createButton" class="dropdown-item"><i class="fa fa-plus-circle"></i> Tambah
                                        Data</button>
                                    <button class="dropdown-item" disabled><i class="fa fa-file-csv"></i> Ekspor
                                        CSV</button>
                                    <button class="dropdown-item" disabled><i class="fa fa-file-pdf"></i> Cetak PDF</button>
                                </div>
                            </div>
                        @endif

                        <table id="table" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th title="Nomor Induk Kependudukan">NIK</th>
                                    <th>Alamat</th>
                                    <th>Nomor Ponsel</th>
                                    <th>Koordinator</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th title="Nomor Induk Kependudukan">NIK</th>
                                    <th>Alamat</th>
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

    {{-- @include('modals.form-modal')
    @include('modals.coordinator')
    @include('modals.be-coordinator')
    @include('modals.cancel-coordinator') --}}
@endsection

@push('script')
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <!-- form mask -->
    <script src="{{ asset('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

    <!-- Dropify -->
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>

    <!-- Script -->
    <script src="{{ asset('js/coordinator-table.js') }}"></script>
@endpush
