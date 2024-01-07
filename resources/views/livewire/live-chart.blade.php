<div class="container mx-auto">

    <div class="row">
        <div class="col-md-12">
            <div class="card card-chart" wire:poll="liveFoo">
                @if($datas)
                    <ol class="ol">
                        @foreach($datas as $data)
                            <li class="indicator">
                                <span class="name">{{ $loop->iteration }}.{{ $data['label'] }}</span>
                                <span class="bars" style="width: {{ min($data['data'] / 100, 100) }}%">
                                    @if ($data['data'] > 1000)
                                        {{ $data['data'] }} Suara
                                    @endif
                                </span>
                                @if ($data['data'] < 1000)
                                    <span class="count">{{ $data['data'] }} Suara</span>
                                @endif
                               
                            </li>

                        @endforeach
                    </ol>
                @else
                    <p>No data available.</p>
                @endif
            </div>
        </div>
    </div>
    
</div>
