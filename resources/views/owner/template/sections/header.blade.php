<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm-dark.png') }}" height="20">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" height="17">
                    </span>
                </a>

                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" height="20">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-light.png') }}" height="19">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ url('dashboard') }}">
                                    Beranda
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="quick-count-topnav"
                                    role="button">
                                    Perhitungan Cepat <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="quick-count-topnav">

                                    <a href="{{ url('voting-results') }}" class="dropdown-item">
                                        Hasil Perhitungan Cepat
                                    </a>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-result-district" role="button">
                                            Hasil Per Kecamatan <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-result-district">
                                            @foreach (App\Models\District::all() as $district)
                                                <a href="{{ url('voting-results/district', $district->id) }}"
                                                    class="dropdown-item">{{ $district->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a href="{{ url('input-voting-results') }}" class="dropdown-item">
                                        Data Perolehan Suara (C1)
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-mapping"
                                    role="button">
                                    Pemetaan Suara <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-mapping">
                                    <a href="{{ url('mapping-result') }}" class="dropdown-item">Hasil Keseluruhan</a>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-mapping-district" role="button">
                                            Hasil Per Kecamatan <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-mapping-district">
                                            @foreach (App\Models\District::all() as $district)
                                                <a href="{{ url('mapping-result/district', Crypt::encrypt($district->id)) }}"
                                                    class="dropdown-item">{{ $district->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="voters-data-topnav"
                                    role="button">
                                    Data Pemilih<div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="voters-data-topnav">
                                    @foreach (App\Models\District::all() as $district)
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                                id="topnav-voters-district-{{ $district->id }}" role="button">
                                                {{ $district->name }} <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu"
                                                aria-labelledby="topnav-voters-district-{{ $district->id }}">
                                                @foreach (App\Models\Village::where('district_id', $district->id)->get() as $village)
                                                    <a href="{{ url('voters/village', Crypt::encrypt($village->id)) }}"
                                                        class="dropdown-item">
                                                        {{ $village->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="other-topnav"
                                    role="button">
                                    Lainnya <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="other-topnav">
                                    <a href="{{ url('administrators') }}" class="dropdown-item">
                                        Data Administrator
                                    </a>
                                    <a href="{{ url('coordinators') }}" class="dropdown-item">
                                        Data Koordinator
                                    </a>
                                    <a href="{{ url('witnesses') }}" class="dropdown-item">
                                        Data Saksi
                                    </a>
                                    <a href="{{ url('monitors') }}" class="dropdown-item">
                                        Data Pemantau
                                    </a>
                                    <a href="{{ url('parties') }}" class="dropdown-item">
                                        Data Partai
                                    </a>
                                    <a href="{{ url('candidates') }}" class="dropdown-item">
                                        Data Calon Legislatif
                                    </a>
                                    <a href="{{ url('voting-places') }}" class="dropdown-item">
                                        Peta TPS
                                    </a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="d-flex">
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset(empty(Auth::user()->photo) ? 'images/default-photos.jpg' : Auth::user()->photo) }}">
                    <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ url('profile') }}">
                        <i class="bx bx-user font-size-16 align-middle me-1"></i>
                        Profil Saya
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ url('logout') }}">
                        <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                        Keluar
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>
