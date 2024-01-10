<div class="container mx-auto" class="pool" wire:poll="foo">


    @foreach ($listData['candidate'] as $candidate)
    @endforeach
    @foreach ($listData['countCandidate'] as $countCandidate)
    @endforeach
    @foreach ($listData['party'] as $party)
    @endforeach
    @foreach ($listData['countParty'] as $countParty)
    @endforeach

    <div class="row">
        <div class="col-md-6">
            <div class="card-counter mb-3">
                <div class="counter-image">
                    <img src="{{ asset($candidate->photo) }}" class="rounded">
                    <span class="name">{{ $candidate->name }}</span>
                </div>
                <div class="box-count">
                    <p class="title">TOTAL SUARA</p>
                    <p class="count">{{ $countCandidate->CountCandidate ?? '0' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-counter mb-3">
                <div class="counter-image">
                    <img src="{{ asset($party->logo) }}" class="rounded">
                    <span class="name">{{ $party->name }}</span>
                </div>
                <div class="box-count">
                    <p class="title">TOTAL SUARA</p>
                    <p class="count">{{ $countParty->CountParty ?? '0' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
