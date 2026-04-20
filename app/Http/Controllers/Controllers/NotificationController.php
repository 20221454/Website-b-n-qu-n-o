<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::whereNull('user_id')
            ->orWhere('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        return view('user.notifications', compact('notifications'));
    }

    public function read($id)
    {
        $noti = Notification::findOrFail($id);
        $noti->is_read = true;
        $noti->save();

        return back();
    }
}