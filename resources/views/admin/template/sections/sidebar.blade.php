<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <a class="image-popup-no-margins"
                    href="{{ asset(empty(Auth::user()->photo) ? 'images/default-photos.jpg' : Auth::user()->photo) }}">
                    <img src="{{ asset(empty(Auth::user()->photo) ? 'images/default-photos.jpg' : Auth::user()->photo) }}"
                        class="avatar-md mx-auto img-thumbnail rounded-circle">
                </a>
            </div>

            <div class="mt-2">
                <a href="javacript:void(0)" class="text-reset fw-medium font-size-16">{{ Auth::user()->name }}</a>
                <p class="text-muted mb-0 font-size-13">{{Auth::user()->level == true ? 'Super Admin' : 'Administrator'}}</p>

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

                <li>
                    <a href="{{ url('search') }}" class="waves-effect">
                        <i class="bx bx-search-alt"></i>
                        <span>Pencarian</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('coordinators') }}" class="waves-effect">
                        <i class="fa fa-user-tie"></i>
                        <span>Data Koordinator</span>
                    </a>
                </li>

                <li class="menu-title">Data Pemilih</li>

                @foreach (App\Models\District::all() as $district)
                    <li>
                        <a href="javascript:void(0)" class="has-arrow waves-effect">
                            <i class="fas fa-users"></i>
                            <span>{{ $district->name }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            @foreach (App\Models\Village::where('district_id', $district->id)->get() as $village)
                                <li><a href="{{ url('voters/village', $village->id) }}">{{ $village->name }}</a></li>
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
