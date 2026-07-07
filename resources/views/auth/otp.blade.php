@extends('layouts.app')
@section('title', 'OTP Authentication')

@section('content')
<section class="section-padding bg-light">
    <div class="container" style="max-width: 500px;">
        <div class="form-card">
            @if(!session('otp_phone'))
                <h2 class="text-center" style="margin-bottom:10px;">OTP Login</h2>
                <p class="text-center" style="color:var(--text-muted); font-size:14px; margin-bottom:30px;">Enter your registered phone number to receive a 6-digit OTP code via SMS.</p>
                
                <form action="{{ route('otp.send') }}" method="POST">
                    @csrf
                    <div class="form-grid" style="grid-template-columns: 1fr; gap:15px; margin-bottom:20px;">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. +91 98765 43210" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary" style="width:100%; border:none;">Send OTP <i class="fas fa-paper-plane"></i></button>
                </form>
            @else
                <h2 class="text-center" style="margin-bottom:10px;">Verify OTP</h2>
                <p class="text-center" style="color:var(--text-muted); font-size:14px; margin-bottom:30px;">We sent a verification code to <strong>{{ session('otp_phone') }}</strong></p>
                
                <form action="{{ route('otp.verify') }}" method="POST">
                    @csrf
                    <div class="form-grid" style="grid-template-columns: 1fr; gap:15px; margin-bottom:20px;">
                        <div class="form-group">
                            <label for="otp">Enter 6-Digit OTP Code</label>
                            <input type="text" name="otp" id="otp" class="form-control" placeholder="e.g. 123456" maxlength="6" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary" style="width:100%; border:none;">Verify & Log In <i class="fas fa-check-circle"></i></button>
                </form>
            @endif

            <p class="text-center mt-3" style="font-size:14px; color:var(--text-muted);">
                Back to <a href="{{ route('login') }}" style="color:var(--primary-color); font-weight:600;">Password Login</a>
            </p>
        </div>
    </div>
</section>
@endsection
