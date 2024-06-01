<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index($roomId)
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        $room = Room::find($roomId);
        $message = Message::find();

        // Retrieve notifications for the user
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();

        $notificationCount = Notification::where('user_id', $user->id)->whereNull('read_at')->count();

        // Return the notifications as JSON response
        return response()->json(['notifications' => $notifications, 'notificationCount' => $notificationCount], 200);
    }
}
