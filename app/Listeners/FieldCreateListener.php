<?php

namespace App\Listeners;

use App\Events\FieldEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class FieldCreateListener
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
     * @param  FieldEvent  $event
     * @return void
     */
    public function handle(FieldEvent $event)
    {
        $column_name=$event->column_name;
        $column_type=$event->column_type;
        $type = $event->type;
        if ($type == 6) {
            if ($column_type==2) {
                DB::statement('alter table gbooks add '.$column_name.' mediumtext ');
            } else {
                DB::statement('alter table gbooks add '.$column_name.' varchar(255) ');
            }
        } else {
            if ($column_type==2) {
                DB::statement('alter table content add '.$column_name.' mediumtext ');
                DB::statement('alter table recycles add '.$column_name.' mediumtext ');
            } else {
                DB::statement('alter table content add '.$column_name.' varchar(255) ');
                DB::statement('alter table recycles add '.$column_name.' varchar(255) ');
            }
        }
    }
}
