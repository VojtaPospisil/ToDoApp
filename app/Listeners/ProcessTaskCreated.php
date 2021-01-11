<?php

namespace App\Listeners;

use App\Event\TaskCreated;
use App\Jobs\NewTaskNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessTaskCreated
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
         * @param  TaskCreated  $event
         * @return void
         */
    public function handle(TaskCreated $event)
    {
        NewTaskNotification::dispatch($event->task);
    }
}
