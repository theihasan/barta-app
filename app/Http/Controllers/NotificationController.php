<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function changeStatus($notificationId, $postId){
        $notification = auth()->user()->unreadNotifications()->find($notificationId);
        if($notification){
            $notification->update(['read_at' => now()]);
            return redirect()->route('post.single', ['postuuid' => $postId]);
        }
    }
}
