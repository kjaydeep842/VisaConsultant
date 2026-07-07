@extends('layouts.app')
@section('title', 'Account Settings')

@section('content')
<section class="page-header" style="padding: 40px 0;">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; text-align:left;">
        <div>
            <h1 style="font-size:28px; margin:0;">Account Settings</h1>
            <p style="color:rgba(255,255,255,0.7); margin:0;">Update your contact information and password credentials.</p>
        </div>
        <div>
            <a href="{{ route('client.dashboard') }}" class="btn-topbar"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div style="display:grid; grid-template-columns: 280px 1fr; gap:30px; align-items:flex-start;">
            
            <!-- Dashboard Sidebar -->
            <div class="form-card" style="padding: 20px;">
                <h4 style="margin-bottom:15px; font-size:14px; text-transform:uppercase; color:var(--text-muted);">Client Menu</h4>
                <ul style="list-style:none; padding:0; display:flex; flex-direction:column; gap:10px;">
                    <li>
                        <a href="{{ route('client.dashboard') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px; transition:var(--transition);">
                            <i class="fas fa-chart-line"></i> Dashboard Overview
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.applications') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px; transition:var(--transition);">
                            <i class="fas fa-folder-open"></i> My Applications
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.appointments') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px; transition:var(--transition);">
                            <i class="fas fa-calendar-alt"></i> My Appointments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.documents') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px; transition:var(--transition);">
                            <i class="fas fa-file-signature"></i> Uploaded Documents
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.invoices') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px; transition:var(--transition);">
                            <i class="fas fa-file-invoice-dollar"></i> Receipts & Invoices
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.profile') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; background:rgba(11, 61, 145, 0.05); color:var(--primary-color); border-radius:8px; font-weight:600;">
                            <i class="fas fa-user-cog"></i> Account Settings
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content Area -->
            <div class="form-card">
                <h3>Update Credentials</h3>
                <p style="color:var(--text-muted); font-size:14px; margin-bottom:25px;">Ensure your mobile number is up-to-date to receive SMS/OTP reminders.</p>
                
                <form action="{{ route('client.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" class="form-control" value="{{ auth()->user()->email }}" disabled style="background:#e9ecef; cursor:not-allowed;">
                            <small style="color:var(--text-muted);">Email cannot be changed online.</small>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ auth()->user()->phone }}" required>
                        </div>
                        <div class="form-group">
                            <!-- spacer -->
                        </div>
                        <div class="form-group">
                            <label for="password">New Password (Leave blank to keep current)</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary" style="border:none;">Save Profile Changes</button>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
