@extends('admin.template.base')

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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            <i class="fas fa-info-circle h6 text-primary"></i> Informasi
                        </h4>
                        <div id="reviewExampleControls" class="carousel slide review-carousel" data-ride="carousel">

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div>
                                        <p>Sistem ini dikembangkan oleh Kayong Developer Community. apabila terjadi
                                            kendala
                                            yang mengganggu berjalannya sistem atau memerlukan bantuan dalam penggunaan
                                            sistem, harap hubungi kontak berikut melalui telepon ataupun whatsapp.</p>
                                        <div class="d-flex align-items-start mt-4">
                                            <div class="avatar-sm me-3">
                                                <a href="https://wa.me/6285171121070" target="_blank"
                                                    class="avatar-title bg-success text-white rounded-circle">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </div>
                                            <div class="flex-1">
                                                <h5 class="font-size-16 mb-1">Kayong Developer</h5>
                                                <p class="mb-2">0851-7112-1070</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="carousel-item">
                                    <div>
                                        <p>The new common language will be more simple and regular than the
                                            existing European languages. The new common language will be more simple and
                                            regular than the
                                            existing European languages.</p>
                                    </div>
                                </div> --}}
                            </div>

                            <a class="carousel-control-prev" href="#reviewExampleControls" role="button"
                                data-bs-slide="prev">
                                <i class="mdi mdi-chevron-left carousel-control-icon"></i>
                            </a>
                            <a class="carousel-control-next" href="#reviewExampleControls" role="button"
                                data-bs-slide="next">
                                <i class="mdi mdi-chevron-right carousel-control-icon"></i>
                            </a>
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
