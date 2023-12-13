@push('style')
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Lightbox css -->
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
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
        <div class="row">
            <div id="map-canvas" class="card" style="height: 350px;"></div>
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title my-4 font-size-18 lh-1">Data Tempat Pemungutan Suara (TPS)</h4>

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
                            <li class="breadcrumb-item active">Data Tempat Pemungutan Suara (TPS)</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Tabel Tempat Pemungutan Suara (TPS)
                            {{-- <button id="createButton" class="btn btn-sm btn-dark float-end">
                                <i class="fa fa-plus"></i> Tambah
                            </button> --}}
                        </h4>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>TPS</th>
                                    <th>Kecamatan</th>
                                    <th>Alamat</th>
                                    <th>Koordinat</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>TPS</th>
                                    <th>Kecamatan</th>
                                    <th>Alamat</th>
                                    <th>Koordinat</th>
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

    @include('modals.voting-place')
@endsection

@push('script')
    <!-- Gmaps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k" async defer></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Magnific Popup-->
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- Tour init js-->
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
    <!-- Datatable -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Dropify -->
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <!-- Jquery Input Mask -->
    <script src="{{ asset('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Script -->
    <script src="{{ asset('js/voting-place.js') }}"></script>
    <!-- Maps Script -->
    <script>
        $(document).ready(function() {
            initMap();
        });

        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, fail);
            } else {
                alert("Browser anda tidak mendukung untuk menampilkan peta kami.");
            }
        }

        function success(position) {
            var latitude = -1.5841595;
            var longitude = 110.060837;
            myLatLng = new google.maps.LatLng(latitude, longitude);
            createMap(myLatLng);
        }

        function fail() {
            alert("Gagal menampilkan peta, cobalah periksa koneksi internetmu");
        }

        function createMap(myLatLng) {
            map = new google.maps.Map(document.getElementById("map-canvas"), {
                center: myLatLng,
                zoom: 9.5,
            });

            @foreach ($votingPlaces as $votingPlace)
                @if ($votingPlace->latitude && $votingPlace->longitude)
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng({{ $votingPlace->latitude }},
                            {{ $votingPlace->longitude }}),
                        map: map,
                        title: '{{$votingPlace->village->name}} ({{$votingPlace->name}})',
                    });
                @endif
            @endforeach
        }
    </script>
@endpush
