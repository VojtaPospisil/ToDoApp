<?php

namespace App\Mail;

use App\Notifications\TaskCreatedNotification;
use App\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * * Build the message.
     *
     * @return TaskCreatedNotification
     */
    public function build()
    {
        return new TaskCreatedNotification($this->task);
    }
}
