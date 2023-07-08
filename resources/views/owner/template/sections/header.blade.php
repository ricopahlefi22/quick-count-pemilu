<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm-dark.png') }}" alt="" height="20">
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
                                <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0)"
                                    id="topnav-ui-element" role="button">
                                    Perhitungan Cepat <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                                    aria-labelledby="topnav-ui-element">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div>
                                                <a href="ui-alerts.html" class="dropdown-item">Alerts</a>
                                                <a href="ui-buttons.html" class="dropdown-item">Buttons</a>
                                                <a href="ui-cards.html" class="dropdown-item">Cards</a>
                                                <a href="ui-carousel.html" class="dropdown-item">Carousel</a>
                                                <a href="ui-dropdowns.html" class="dropdown-item">Dropdowns</a>
                                                <a href="ui-grid.html" class="dropdown-item">Grid</a>
                                                <a href="ui-images.html" class="dropdown-item">Images</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <a href="ui-lightbox.html" class="dropdown-item">Lightbox</a>
                                                <a href="ui-modals.html" class="dropdown-item">Modals</a>
                                                <a href="ui-rangeslider.html" class="dropdown-item">Range Slider</a>
                                                <a href="ui-session-timeout.html" class="dropdown-item">Session
                                                    Timeout</a>
                                                <a href="ui-progressbars.html" class="dropdown-item">Progress Bars</a>
                                                <a href="ui-sweet-alert.html" class="dropdown-item">Sweet-Alert</a>
                                                <a href="ui-tabs-accordions.html" class="dropdown-item">Tabs &
                                                    Accordions</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <a href="ui-typography.html" class="dropdown-item">Typography</a>
                                                <a href="ui-video.html" class="dropdown-item">Video</a>
                                                <a href="ui-general.html" class="dropdown-item">General</a>
                                                <a href="ui-colors.html" class="dropdown-item">Colors</a>
                                                <a href="ui-rating.html" class="dropdown-item">Rating</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0)"
                                    id="topnav-app-pages" role="button">
                                    Pemetaan Suara <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-app-pages">

                                    <a href="calendar.html" class="dropdown-item">Calendar</a>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="javascript:void(0)"
                                            id="topnav-email" role="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Email <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="email-inbox.html" class="dropdown-item">Inbox</a>
                                            <a href="email-read.html" class="dropdown-item">Read Email</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="javascript:void(0)"
                                            id="topnav-task" role="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Tasks <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-task">
                                            <a href="tasks-list.html" class="dropdown-item">Task List</a>
                                            <a href="tasks-kanban.html" class="dropdown-item">Kanban Board</a>
                                            <a href="tasks-create.html" class="dropdown-item">Create Task</a>
                                        </div>
                                    </div>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0)"
                                    id="voters-data-nav" role="button">
                                    Data Pemilih<div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="voters-data-nav">
                                    @foreach (App\Models\District::all() as $district)
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none"
                                                href="javascript:void(0)" id="topnav-form" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ $district->name }} <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-form">
                                                @foreach (App\Models\Village::where('district_id', $district->id)->get() as $village)
                                                    <a href="{{ url('voters/village', $village->id) }}"
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
                                <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0)"
                                    id="topnav-pages" role="button">
                                    Lainnya <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu"
                                    aria-labelledby="topnav-pages">
                                    <a href="{{ url('administrators') }}" class="dropdown-item">
                                        Data Administrator
                                    </a>
                                    <a href="{{ url('coordinators') }}" class="dropdown-item">
                                        Data Koordinator
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
    </div>
</header>
