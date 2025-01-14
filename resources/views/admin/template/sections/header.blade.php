<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-end">
                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset(empty(Auth::user()->photo) ? 'images/default-photos.jpg' : Auth::user()->photo) }}"
                            alt="Foto {{ Auth::user()->name }}">
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

            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{ url('/') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
                        </span>
                    </a>

                    <a href="{{ url('/') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="19">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                    id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

        </div>
    </div>
</header> <!-- ========== Left Sidebar Start ========== -->
