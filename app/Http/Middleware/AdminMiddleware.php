<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Please sign in to access the admin panel.');
        }

        if (!in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Access denied. Admin accounts only.');
        }

        return $next($request);
    }
}
