{{-- wire:poll="foo" --}}
<div class="row" wire:poll="liveplace">
    <div class="col-md-3">
        <div class="card bg-primary">
            <div class="card-body">
                <h3 style="font-size: 16px;color:white;display:block;padding:0;margin:0">Koordinator</h3>
                <p style="font-size: 16px;color:white;display:block;padding:0;margin:0"> {{ $livecore }} Orang</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success">
            <div class="card-body">
                <h3 style="font-size: 16px;color:white;display:block;padding:0;margin:0">Terdaftar</h3>
                <p style="font-size: 16px;color:white;display:block;padding:0;margin:0"> {{ $liveregis }} Orang</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger">
            <div class="card-body">
                <h3 style="font-size: 16px;color:white;display:block;padding:0;margin:0">Tidak Terdaftar</h3>
                <p style="font-size: 16px;color:white;display:block;padding:0;margin:0"> {{ $notregis }} Orang</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info">
            <div class="card-body">
                <h3 style="font-size: 16px;color:white;display:block;padding:0;margin:0">Total Pemilih</h3>
                <p style="font-size: 16px;color:white;display:block;padding:0;margin:0"> {{ $livevot }} Orang</p>
            </div>
        </div>
    </div>
    
  
</div>


