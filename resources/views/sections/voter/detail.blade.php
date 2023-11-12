@push('style')
    <!-- Lightbox css -->
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
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
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Detail Data {{ $voter->name }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                {{ Route::current()->uri == 'voters/detail/{id}' ? 'Data Pemilih' : 'Data Koordinator' }}
                            </li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- start row -->
        <div class="row">
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-widgets py-2">
                            <div class="text-center">
                                <a class="image-popup-no-margins"
                                    href="{{ asset(empty($voter->photo) ? 'images/default-photos.jpg' : $voter->photo) }}">
                                    <img src="{{ asset(empty($voter->photo) ? 'images/default-photos.jpg' : $voter->photo) }}"
                                        class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                    <div class="online-circle font-size-22">
                                        @if ($voter->gender == 'P')
                                            <i class="fa fa-venus text-danger" title="Perempuan"></i>
                                        @elseif ($voter->gender == 'L')
                                            <i class="fa fa-mars text-primary" title="Laki-Laki"></i>
                                        @else
                                        @endif
                                    </div>
                                </a>

                                <div class="mt-3">
                                    <a href="javascript:void(0)" class="text-reset font-size-16">
                                        <strong>{{ $voter->name }}</strong>
                                    </a>
                                    <p class="text-body mt-1 mb-1">{{ $voter->id_number }}</p>

                                    @if ($voter->level == 1)
                                        <span class="badge bg-primary">Koordinator</span>
                                    @elseif($voter->coordinator_id != null)
                                        <span class="badge bg-success">Terdaftar</span>
                                    @else
                                        <span class="badge bg-danger">Belum Terdaftar</span>
                                    @endif
                                    @if ($voter->marital_status == 'B')
                                        <span class="badge bg-success">Belum Menikah</span>
                                    @elseif ($voter->marital_status == 'S')
                                        <span class="badge bg-danger">Sudah Menikah</span>
                                    @elseif ($voter->marital_status == 'P')
                                        <span class="badge bg-warning">Pernah Menikah</span>
                                    @else
                                    @endif
                                </div>

                                <div class="row mt-3 border border-start-0 border-end-0 p-2">
                                    <div class="col">
                                        <h6 class="text-muted">
                                            TPS
                                        </h6>
                                        <h5 class="mb-0">
                                            {{ $voter->votingPlace->name }} <br>
                                            <strong class="font-size-12">
                                                {{ $voter->village->name }}
                                            </strong>
                                        </h5>
                                    </div>
                                    @if ($voter->level == 1)
                                        <div class="col">
                                            <h6 class="text-muted">
                                                Jumlah Anggota
                                            </h6>
                                            <h5 class="mb-0">
                                                {{ $voter->member->except($voter->id)->count() }}
                                            </h5>
                                            <strong class="font-size-12">Orang</strong>
                                        </div>
                                    @else
                                        @if ($voter->coordinator_id != null)
                                            <div class="col">
                                                <h6 class="text-muted">
                                                    Anggota Dari
                                                </h6>
                                                <h5 class="mb-0">
                                                    {{ $voter->coordinator->name }}
                                                </h5>
                                                <strong class="font-size-12">
                                                    {{ $voter->coordinator->village->name }}
                                                </strong>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">Nama</p>
                                    <h6>
                                        {{ $voter->name }}
                                    </h6>
                                </div>

                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">Nomor Induk Kependudukan (NIK)</p>
                                    <h6>
                                        {{ empty($voter->id_number) ? '-' : $voter->id_number }}
                                    </h6>
                                </div>

                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">Nomor Kartu Keluarga</p>
                                    <h6>
                                        {{ empty($voter->family_card_number) ? '-' : $voter->family_card_number }}
                                    </h6>
                                </div>

                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">Alamat</p>
                                    <h6>
                                        @if ($voter->address && $voter->rt && $voter->rw)
                                            {{ $voter->address . ', RT ' . $voter->rt . '/RW ' . $voter->rw }}
                                        @elseif($voter->address && $voter->rt)
                                            {{ $voter->address . ', RT ' . $voter->rt }}
                                        @elseif($voter->rt && $voter->rw)
                                            {{ 'RT ' . $voter->rt . '/RW ' . $voter->rw }}
                                        @else
                                            {{ $voter->address }}
                                        @endif
                                    </h6>
                                </div>

                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">No. Handphone</p>
                                    <h6>
                                        {{ empty($voter->phone_number) ? '-' : $voter->phone_number }}
                                    </h6>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">Usia</p>
                                    <h6>
                                        {{ empty($voter->age) ? '-' : $voter->age }}
                                    </h6>
                                </div>

                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">Tempat Lahir</p>
                                    <h6>
                                        {{ empty($voter->birthplace) ? '-' : $voter->birthplace }}
                                    </h6>
                                </div>

                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">Tanggal Lahir</p>
                                    <h6>
                                        {{ empty($voter->birthday)? '-': Carbon\Carbon::parse($voter->birthday)->locale('id')->isoFormat('D MMMM Y') }}
                                    </h6>
                                </div>

                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">Jenis Kelamin</p>
                                    <h6>
                                        @if ($voter->gender == 'P')
                                            <i class="fa fa-venus text-danger" title="Perempuan"></i> Perempuan
                                        @elseif ($voter->gender == 'L')
                                            <i class="fa fa-mars text-primary" title="Laki-Laki"></i> Laki-Laki
                                        @else
                                            -
                                        @endif
                                    </h6>
                                </div>

                                <div class="mt-2">
                                    <p class="font-size-12 text-muted mb-1">Status Perkawinan</p>
                                    <h6>
                                        @if ($voter->marital_status == 'B')
                                            Belum Menikah
                                        @elseif ($voter->marital_status == 'S')
                                            Sudah Menikah
                                        @elseif ($voter->marital_status == 'P')
                                            Pernah Menikah
                                        @else
                                            -
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($voter->level == 1)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Anggota</h4>

                            <table id="table" class="table table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>Nama</th>
                                        <th>Usia</th>
                                        <th>Alamat, RT/RW</th>
                                        <th>Nomor Ponsel</th>
                                        <th>TPS</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>Nama</th>
                                        <th>Usia</th>
                                        <th>Alamat, RT/RW</th>
                                        <th>Nomor Ponsel</th>
                                        <th>TPS</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- end row -->
    </div>

    @include('modals.voter')
    @include('modals.coordinator')
    @include('modals.be-coordinator')
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
    <!-- Magnific Popup-->
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- Tour init js-->
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
    <!-- Script -->
    <script src="{{ asset('js/member.js') }}"></script>
@endpush
