@extends('layouts.app')
@section('title', 'Create Client Account')

@section('content')
<section class="section-padding bg-light">
    <div class="container" style="max-width: 500px;">
        <div class="form-card">
            <h2 class="text-center" style="margin-bottom:10px;">Register Account</h2>
            <p class="text-center" style="color:var(--text-muted); font-size:14px; margin-bottom:30px;">Create a secure client portal to upload files and monitor application progress.</p>
            
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-grid" style="grid-template-columns: 1fr; gap:15px; margin-bottom:20px;">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="e.g. John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="name@domain.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. +91 9876543210" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width:100%; border:none; margin-bottom:20px;">Register Account <i class="fas fa-user-plus"></i></button>
            </form>

            <p class="text-center" style="font-size:14px; color:var(--text-muted);">
                Already have an account? <a href="{{ route('login') }}" style="color:var(--primary-color); font-weight:600;">Login here</a>
            </p>
        </div>
    </div>
</section>
@endsection
