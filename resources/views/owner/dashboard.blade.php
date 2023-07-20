@extends('owner.template.base')

@push('style')
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
        @include('sections.dashboard.index')

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h5 class="page-title mb-0 font-size-18">Pemetaan Suara</h5>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="">Lebih Lengkap <i class="fa fa-arrow-right"></i></a>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <p class="mb-2">Jumlah Pendukung</p>
                                <h4 class="mb-0">{{ $self_voters_count }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <p class="mb-2">Jumlah Koordinator</p>
                                <h4 class="mb-0">{{ $coordinators_count }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <!-- Datatable -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".datatable").DataTable({
                autoWidth: false,
                responsive: true,
                oLanguage: {
                    sSearch: "Pencarian",
                    sInfoEmpty: "Data Belum Tersedia",
                    sInfo: "Menampilkan _PAGE_ dari _PAGES_ halaman",
                    sEmptyTable: "Data Belum Tersedia",
                    sLengthMenu: "Tampilkan _MENU_ Baris",
                    sZeroRecords: "Data Tidak Ditemukan",
                    sProcessing: "Sedang Memproses...",
                    oPaginate: {
                        sFirst: "Pertama",
                        sPrevious: "Sebelumnya",
                        sNext: "Selanjutnya",
                        sLast: "Terakhir",
                    },
                }
            });
        });
    </script>
@endpush
