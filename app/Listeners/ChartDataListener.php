<?php

namespace App\Listeners;

use App\Events\ChartDataEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChartDataListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChartDataEvent $event): void
    {
        broadcast(new ChartDataEvent($event->chartData))->toOthers();
    }
}
