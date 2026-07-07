@extends('layouts.app')
@section('title', 'Forgot Password')

@section('content')
<section class="section-padding bg-light">
    <div class="container" style="max-width: 500px;">
        <div class="form-card">
            <h2 class="text-center" style="margin-bottom:10px;">Reset Password</h2>
            <p class="text-center" style="color:var(--text-muted); font-size:14px; margin-bottom:30px;">Enter your email address and we'll send you a password reset link.</p>
            
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-grid" style="grid-template-columns: 1fr; gap:15px; margin-bottom:20px;">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="name@domain.com" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width:100%; border:none; margin-bottom:20px;">Send Link <i class="fas fa-paper-plane"></i></button>
            </form>

            <p class="text-center" style="font-size:14px; color:var(--text-muted);">
                Back to <a href="{{ route('login') }}" style="color:var(--primary-color); font-weight:600;">Login</a>
            </p>
        </div>
    </div>
</section>
@endsection
