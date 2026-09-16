<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationApiController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            Notification::where('user_id', Auth::id())
                ->orderByDesc('created_at')
                ->paginate(20)
        );
    }

    public function markAsRead(Request $request, Notification $notification)
    {
        abort_if($notification->user_id !== Auth::id(), 403);

        $notification->update(['read_at' => now()]);

        return response()->json(null, 204);
    }
}
