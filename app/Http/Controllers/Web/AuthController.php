<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->with('error', 'Your account is not active. Please contact support.');
            }

            if (in_array($user->role, ['admin', 'superadmin'])) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('client.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        Auth::login($user);

        return redirect()->route('client.dashboard')->with('success', 'Welcome to NV Visa Consultancy!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        // TODO: send password reset email
        return back()->with('success', 'Password reset link sent to your email.');
    }

    public function resetPasswordForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        // TODO: implement password reset
        return redirect()->route('login')->with('success', 'Password reset successfully!');
    }

    // Google OAuth
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google login failed. Please try again.');
        }

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'email_verified_at' => now(),
                'role' => 'client',
                'status' => 'active',
            ]
        );

        Auth::login($user);

        if (in_array($user->role, ['admin', 'superadmin'])) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('client.dashboard');
    }

    // OTP Login
    public function otpForm()
    {
        return view('auth.otp');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['phone' => 'required|string']);

        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return back()->with('error', 'Phone number not found.');
        }

        $otp = rand(100000, 999999);
        $user->update(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(10)]);

        // TODO: Send OTP via SMS

        session(['otp_phone' => $request->phone]);
        return redirect()->route('otp.verify')->with('success', 'OTP sent to your phone.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric|digits:6']);

        $phone = session('otp_phone');
        $user = User::where('phone', $phone)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>', now())
            ->first();

        if (!$user) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        $user->update(['otp' => null, 'otp_expires_at' => null]);
        Auth::login($user);

        return redirect()->intended(route('client.dashboard'));
    }
}
