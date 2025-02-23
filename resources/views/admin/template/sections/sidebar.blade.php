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
                <p class="text-muted mb-0 font-size-13">
                    {{ Auth::user()->level == true ? 'Super Admin' : 'Administrator' }}
                </p>
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

                @if (Auth::user()->level == true)
                    <li>
                        <a href="{{ url('coordinators') }}" class="waves-effect">
                            <i class="fa fa-user-tie"></i>
                            <span>Data Koordinator</span>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('voters') }}" class="waves-effect">
                        <i class="fa fa-users"></i>
                        <span>Data Seluruh Pemilih</span>
                    </a>
                </li>

                @if (env('QUICK_COUNT') == true)
                    <li class="menu-title">Perhitungan Cepat</li>

                    <li>
                        <a href="{{ url('input-voting-results') }}" class="waves-effect">
                            <i class="fa fa-calculator"></i>
                            <span>Input Perolehan Suara</span>
                        </a>
                    </li>
                @endif

                <li class="menu-title">Data Pemilih Per Kecamatan</li>

                @foreach (App\Models\District::all() as $district)
                    <li>
                        <a href="{{ url('voters/district', Crypt::encrypt($district->id)) }}" class="waves-effect">
                            <i class="fa fa-circle-notch"></i>
                            <span>{{ $district->name }}</span>
                        </a>
                    </li>
                @endforeach

                <li class="menu-title">Data Pemilih Per Desa</li>

                @foreach (App\Models\District::all() as $district)
                    <li>
                        <a href="javascript:void(0)" class="has-arrow waves-effect">
                            <i class="fa fa-circle"></i>
                            <span>{{ $district->name }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            @foreach (App\Models\Village::where('district_id', $district->id)->get() as $village)
                                <li><a
                                        href="{{ url('voters/village', Crypt::encrypt($village->id)) }}">{{ $village->name }}</a>
                                </li>
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
