@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Detail Data {{ $coordinator->name }}</h4>

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
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-widgets py-3">

                            <div class="text-center">
                                <div class="">
                                    <img src="{{ asset(empty($coordinator->photo) ? 'images/default-photos.jpg' : $coordinator->photo) }}"
                                        alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                    <div class="online-circle"><i class="fas fa-circle text-success"></i>
                                    </div>
                                </div>

                                <div class="mt-3 ">
                                    <a href="javascript:void(0)" class="text-reset fw-medium font-size-16">
                                        {{ $coordinator->name }}
                                    </a>
                                    <p class="text-body mt-1 mb-1">{{ $coordinator->id_number }}</p>

                                    <span class="badge bg-primary">Koordinator</span>
                                </div>

                                <div class="row mt-4 border border-start-0 border-end-0 p-3">
                                    <div class="col-md-6">
                                        <h6 class="text-muted">
                                            Followers
                                        </h6>
                                        <h5 class="mb-0">9,025</h5>
                                    </div>

                                    <div class="col-md-6">
                                        <h6 class="text-muted">
                                            Following
                                        </h6>
                                        <h5 class="mb-0">11,025</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Data Pribadi</h5>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">Email Address</p>
                            <h6 class="">StaceyTLopez@armyspy.com</h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">Phone number</p>
                            <h6 class="">001 951-402-8341</h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">Office Address</p>
                            <h6 class="">2240 Denver Avenue
                                Los Angeles, CA 90017</h6>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Anggota</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Billing Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col" colspan="2">Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                        <tr>
                                            <td>Qovex admin UI</td>
                                            <td>
                                                21/01/2020
                                            </td>
                                            <td>Werner Berlin</td>
                                            <td>$ 125</td>
                                            <td><span class="badge badge-soft-success font-size-12">Paid</span>
                                            </td>
                                            <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                        <div class="mt-3">
                            <ul class="pagination pagination-rounded justify-content-center mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- end row -->

    </div>
@endsection
