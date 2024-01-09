<?php

namespace App\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $notifications;
    public function render()
    {
        $unreadNotification = auth()->user()->unreadNotifications()
            ->latest()
            ->limit(5)
            ->get();
        $countUnreadNotification = $unreadNotification->count();
        return view('livewire.notifications')->with([
            'unreadNotification' => $unreadNotification,
            'countUnreadNotification' => $countUnreadNotification
        ]);
    }
    
}
