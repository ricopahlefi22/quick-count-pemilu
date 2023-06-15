<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <a class="image-popup-no-margins" href="{{ asset(Auth::user()->photo) }}">
                    <img src="{{ asset(Auth::user()->photo) }}" class="avatar-md mx-auto img-thumbnail rounded-circle">
                </a>
            </div>

            <div class="mt-2">
                <a href="javacript:void(0)" class="text-reset fw-medium font-size-16">{{ Auth::user()->name }}</a>
                <p class="text-muted mb-0 font-size-13">Administrator</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ url('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Beranda</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="search" class=" waves-effect">
                        <i class="bx bx-search-alt"></i>
                        <span>Cari Data Pemilih</span>
                    </a>
                </li> --}}

                @if (App\Models\WebConfig::first()->strict == false)
                    {{-- <li class="menu-title">Pemetaan Suara</li>

                    <li>
                        <a href="districts" class=" waves-effect">
                            <i class="mdi mdi-chart-bar-stacked"></i>
                            <span>Data Kecamatan</span>
                        </a>
                    </li>

                    <li>
                        <a href="villages" class=" waves-effect">
                            <i class="bx bx-bar-chart-alt-2"></i>
                            <span>Data Desa/Kelurahan</span>
                        </a>
                    </li>

                    <li>
                        <a href="voting-places" class=" waves-effect">
                            <i class="fas fa-chart-bar"></i>
                            <span>Data TPS</span>
                        </a>
                    </li> --}}
                @endif

                <li class="menu-title">Data Pemilih</li>

                @foreach (App\Models\District::all() as $district)
                    <li>
                        <a href="javascript:void(0)" class="has-arrow waves-effect">
                            <i class="fas fa-users"></i>
                            <span>{{ $district->name }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @foreach (App\Models\Village::where('district_id', $district->id)->get() as $village)
                                <li><a href="{{ url('voters') }}?vllg={{ $village->id }}">{{ $village->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
