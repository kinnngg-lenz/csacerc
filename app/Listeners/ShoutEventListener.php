<?php

namespace App\Listeners;

use App\Events\ShoutWasFired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShoutEventListener
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
     * @param  ShoutWasFired  $event
     * @return void
     */
    public function handle(ShoutWasFired $event)
    {
        //
    }
}
