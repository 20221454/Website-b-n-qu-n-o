<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // ❌ chưa login
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        // ❌ không phải admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập');
        }

        return $next($request);
    }
}