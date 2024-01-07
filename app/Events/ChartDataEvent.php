<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChartDataEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chartData;
    public function __construct($chartData)
    {
        $this->chartData = $chartData;
    }

    
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chart-data'),
        ];
    }
}
