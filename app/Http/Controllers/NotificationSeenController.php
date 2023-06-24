<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        $this->authorize('update', $notification);

        //cette méthode vas authomatiquement update le champ "read_at"
        $notification->markAsRead();

        return redirect()->back();
    }
}
