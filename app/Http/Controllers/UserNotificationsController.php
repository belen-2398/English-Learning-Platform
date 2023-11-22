<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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

    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
    }
}
