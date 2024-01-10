<div class="row" wire:poll="liveVotingPlace">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h3 class="m-0 p-0 fs-5">Koordinator</h3>
                <p class="m-0 p-0 fs-5 fw-bold"> {{ $coordinators_count }} Orang</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-primary-subtle">
            <div class="card-body">
                <h3 class="m-0 p-0 fs-5">Terdaftar</h3>
                <p class="m-0 p-0 fs-5 fw-bold"> {{ $registered_voters_count }} Orang</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary-subtle">
            <div class="card-body">
                <h3 class="m-0 p-0 fs-5">Tidak Terdaftar</h3>
                <p class="m-0 p-0 fs-5 fw-bold"> {{ $not_registered_voters_count }} Orang</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h3 class="m-0 p-0 fs-5">Total Pemilih</h3>
                <p class="m-0 p-0 fs-5 fw-bold"> {{ $voters_count }} Orang</p>
            </div>
        </div>
    </div>
</div>
