<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function unreadCount(Request $request)
    {
        $count = Notification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->count();

        return response()->json(['unread' => $count]);
    }

    public function markAsRead(Request $request, Notification $notification)
    {
        abort_if($notification->user_id !== Auth::id(), 403);

        $notification->update(['read_at' => now()]);

        return back()->with('status', 'notification-read');
    }

    public function markAllAsRead(Request $request)
    {
        Notification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return back()->with('status', 'all-notifications-read');
    }
}
