<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Notifications\Notifiable;

class UserNotificationsController extends Controller
{
    public function show()
    {
        $readNotifications = auth()->user()->readNotifications;
        $unreadNotifications = auth()->user()->unreadNotifications;

        $unreadNotifications->markAsRead();

        return Inertia::render('Notifications/Show', [
            'readNotifications' => $readNotifications,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

    public function markAsRead($notificationId)
    {
        $unreadNotification = auth()->user()->unreadNotifications->find($notificationId);
        return $unreadNotification->markAsRead();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }
}
