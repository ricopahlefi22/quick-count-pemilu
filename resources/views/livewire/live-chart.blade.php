<div class="container mx-auto">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-chart" wire:poll="liveFoo">
                @if ($candidates)
                    <ol class="ol">
                        @foreach ($candidates as $candidate)
                            <li class="indicator">
                                <span class="name">
                                    {{ $loop->iteration }}. {{ $candidate['name'] }}
                                    <img src="{{ asset($candidate['party_logo']) }}" height="20" alt="">
                                </span>
                                <span class="bars" style="width: {{ min($candidate['total_votes'] / 100, 100) }}%"
                                    title="{{ $candidate['total_votes'] }} Suara">
                                    @if ($candidate['total_votes'] >= 1000)
                                        {{ $candidate['total_votes'] }} Suara
                                    @endif
                                </span>
                                @if ($candidate['total_votes'] < 1000)
                                    <span class="count">{{ $candidate['total_votes'] }} Suara</span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p>Data Tidak Tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</div>
