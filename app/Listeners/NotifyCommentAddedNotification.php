<?php

namespace App\Listeners;

use App\Events\CommentAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\CommentAddedNoification;

class NotifyCommentAddedNotification
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
    public function handle(CommentAddedEvent $event): void
    {
        $postAuthor = $event->comment->post->user;
        $postAuthor->notify(new CommentAddedNoification($event->comment));
    }
}
