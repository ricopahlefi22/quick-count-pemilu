@extends('owner.template.base')

@push('style')
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Dropify -->
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Impor Data Pemilih</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Data Pemilih</a></li>
                            <li class="breadcrumb-item active">Impor CSV</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <p class="card-title-desc">Guna mempercepat proses impor data, pastikan data dikelompokkan
                            berdasarkan tps pada file yang terpisah.</p>

                        <form id="form" action="{{ url('voters/import') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input id="file" type="file" name="file" data-show-remove="false"
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">

                            <div class="text-center mt-4">
                                <button id="submit" type="submit" class="btn btn-primary waves-effect waves-light"
                                    disabled>
                                    Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection

@push('script')
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Dropify -->
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <!-- Script -->
    <script type="text/javascript" src="{{ asset('js/import.js') }}"></script>
@endpush
