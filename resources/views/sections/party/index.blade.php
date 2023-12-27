@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title my-4 font-size-18 lh-1">Data Partai</h4>

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
                            <li class="breadcrumb-item active">Data Partai</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            @foreach ($parties as $party)
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <strong class="fs-2 float-end">
                                {{ $party->number }}.
                            </strong>

                            <img src="{{ asset($party->logo) }}" height="50" alt="Logo {{ $party->name }}">
                        </div>
                        <div class="card-body">
                            <div class="lh-1">
                                <h5 class="mb-4">
                                    <strong>{{ $party->name }}</strong>
                                </h5>
                                <p>Jumlah Calon Legislatif: <strong>{{ $party->candidates->count() }} Orang</strong></p>
                                @if (env('QUICK_COUNT') == true)
                                    <p>Jumlah Suara:
                                        @php
                                            $totalVotingResult = 0;
                                            foreach ($party->votingResult as $votingResult) {
                                                $totalVotingResult += $votingResult->number;
                                            }
                                        @endphp
                                        <strong>{{ $totalVotingResult }} Suara</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('parties/detail', Crypt::encrypt($party->id)) }}"
                                class="float-end text-dark font-size-12">Lebih Lengkap <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- end row -->
    </div>
@endsection
