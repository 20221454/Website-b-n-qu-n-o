<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Notification::create([
    'title' => $request->input('title'),
    'content' => $request->input('content'),
    'user_id' => null
]);

        return back()->with('success', 'Đăng thông báo thành công');
    }
}