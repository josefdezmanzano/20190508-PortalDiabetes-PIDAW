<?php

namespace App\Listeners;

use App\Events\DevDojo\Chatter\Events\ChatterBeforeNewDiscussion;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleNewDiscussion
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
     * @param  ChatterBeforeNewDiscussion  $event
     * @return void
     */
    public function handle(ChatterBeforeNewDiscussion $event)
    {
        //
        return $event;
    }
}
