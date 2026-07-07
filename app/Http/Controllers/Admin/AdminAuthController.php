<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Only admin / superadmin allowed
            if (!in_array($user->role, ['admin', 'superadmin'])) {
                Auth::logout();
                return back()->with('error', 'Access denied. Admin accounts only.');
            }

            if ($user->status !== 'active') {
                Auth::logout();
                return back()->with('error', 'Your account is inactive. Contact support.');
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Invalid email or password.']);
    }
}
