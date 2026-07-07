@extends('layouts.app')
@section('title', 'Login to Your Portal')

@section('content')
<section class="section-padding bg-light">
    <div class="container" style="max-width: 500px;">
        <div class="form-card">
            <h2 class="text-center" style="margin-bottom:10px;">Client Portal Login</h2>
            <p class="text-center" style="color:var(--text-muted); font-size:14px; margin-bottom:30px;">Access your applications, document checklists, and schedule appointments.</p>
            
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-grid" style="grid-template-columns: 1fr; gap:15px; margin-bottom:20px;">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="name@domain.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; font-size:13px;">
                        <label style="display:flex; align-items:center; gap:5px; cursor:pointer;">
                            <input type="checkbox" name="remember" value="1"> Remember Me
                        </label>
                        <a href="{{ route('password.request') }}" style="color:var(--secondary-color);">Forgot Password?</a>
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width:100%; border:none; margin-bottom:15px;">Login <i class="fas fa-sign-in-alt"></i></button>
            </form>

            <div style="text-align:center; margin-bottom:15px; font-size:13px; color:var(--text-muted);">OR</div>

            <div style="display:flex; flex-direction:column; gap:10px; margin-bottom:25px;">
                <a href="{{ route('auth.google') }}" class="btn-outline" style="display:flex; align-items:center; justify-content:center; gap:10px; border-color:#dadce0; color:#3c4043; background:#fff; padding:10px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/24px-Google_%22G%22_Logo.svg.png" alt="Google" style="width:18px;">
                    Continue with Google
                </a>
                <a href="{{ route('otp.form') }}" class="btn-outline" style="display:flex; align-items:center; justify-content:center; gap:10px; border-color:var(--primary-color); color:var(--primary-color); padding:10px;">
                    <i class="fas fa-mobile-alt"></i>
                    Login via OTP (SMS)
                </a>
            </div>

            <p class="text-center" style="font-size:14px; color:var(--text-muted);">
                Don't have an account? <a href="{{ route('register') }}" style="color:var(--primary-color); font-weight:600;">Register here</a>
            </p>
        </div>
    </div>
</section>
@endsection
