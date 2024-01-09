<?php

namespace App\Listeners;

use App\Models\Post;
use App\Events\PostLiked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\PostLikedNotification;

class SendPostLikedNotification
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
    public function handle(PostLiked $event): void
    {
        $post = Post::find($event->postId);
        $author = $post->user;
        $author->notify(new PostLikedNotification($event->liker, $post));
    }
}
