<?php

namespace App\Listeners;

use App\Events\MoveRecycle;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Recycle;

class MoveRecycleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MoveRecycle  $event
     * @return void
     */
    public function handle(MoveRecycle $event)
    {
        $Recycle= new Recycle();
        $arr=$event->param;
        $Recycle->insert($arr);
    }
}
