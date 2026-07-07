@extends('layouts.app')
@section('title', 'Client Dashboard')

@section('content')
<section class="page-header" style="padding: 40px 0;">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; text-align:left;">
        <div>
            <h1 style="font-size:28px; margin:0;">Welcome back, {{ auth()->user()->name }}!</h1>
            <p style="color:rgba(255,255,255,0.7); margin:0;">Client Portal ID: #NV-C{{ str_pad(auth()->id(), 4, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-topbar" style="background:#dc3545; border:none; cursor:pointer;">Log Out <i class="fas fa-sign-out-alt"></i></button>
            </form>
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
                        <a href="{{ route('client.dashboard') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; background:rgba(11, 61, 145, 0.05); color:var(--primary-color); border-radius:8px; font-weight:600;">
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
                        <a href="{{ route('client.profile') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px; transition:var(--transition);">
                            <i class="fas fa-user-cog"></i> Account Settings
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Dashboard Content -->
            <div>
                <!-- Status Cards -->
                <div class="services-grid" style="grid-template-columns: repeat(3, 1fr); gap:20px; margin-bottom:30px;">
                    <div class="service-card" style="padding:20px;">
                        <span style="font-size:12px; font-weight:600; color:var(--text-muted); text-transform:uppercase;">Applications</span>
                        <h2 style="font-size:32px; color:var(--primary-color); margin:10px 0;">{{ $applications->count() }}</h2>
                        <a href="{{ route('client.applications') }}" style="font-size:13px; color:var(--secondary-color); font-weight:600;">View details →</a>
                    </div>
                    <div class="service-card" style="padding:20px;">
                        <span style="font-size:12px; font-weight:600; color:var(--text-muted); text-transform:uppercase;">Scheduled Meetings</span>
                        <h2 style="font-size:32px; color:var(--primary-color); margin:10px 0;">{{ $appointments->count() }}</h2>
                        <a href="{{ route('client.appointments') }}" style="font-size:13px; color:var(--secondary-color); font-weight:600;">Schedule new →</a>
                    </div>
                    <div class="service-card" style="padding:20px;">
                        <span style="font-size:12px; font-weight:600; color:var(--text-muted); text-transform:uppercase;">Pending Documents</span>
                        <h2 style="font-size:32px; color:var(--primary-color); margin:10px 0;">{{ $documents->count() }}</h2>
                        <a href="{{ route('client.documents') }}" style="font-size:13px; color:var(--secondary-color); font-weight:600;">Upload file →</a>
                    </div>
                </div>

                <!-- Applications Overview -->
                <div class="form-card" style="margin-bottom:30px;">
                    <h3 style="margin-bottom:20px;"><i class="fas fa-folder-open"></i> Live Visa Applications</h3>
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse; text-align:left;">
                            <thead>
                                <tr style="border-bottom:2px solid var(--border-color);">
                                    <th style="padding:12px;">Application ID</th>
                                    <th style="padding:12px;">Country</th>
                                    <th style="padding:12px;">Visa Category</th>
                                    <th style="padding:12px;">Status</th>
                                    <th style="padding:12px;">Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $app)
                                <tr style="border-bottom:1px solid var(--border-color);">
                                    <td style="padding:12px;"><strong>{{ $app->application_id }}</strong></td>
                                    <td style="padding:12px;">{{ optional($app->country)->name ?? 'Canada' }}</td>
                                    <td style="padding:12px;">{{ optional($app->visaCategory)->name ?? 'Work Permit' }}</td>
                                    <td style="padding:12px;">
                                        <span class="btn-topbar" style="background:var(--primary-color); border-radius:50px; font-size:12px; padding:4px 12px;">
                                            {{ strtoupper($app->status) }}
                                        </span>
                                    </td>
                                    <td style="padding:12px;">{{ $app->updated_at->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="padding:20px; text-align:center; color:var(--text-muted);">
                                        No active visa applications found. Schedule a consultation to initialize your case.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Appointments and Documents Row -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                    <!-- Appointments -->
                    <div class="form-card" style="padding:25px;">
                        <h4 style="margin-bottom:15px;"><i class="far fa-calendar-alt"></i> Recent Appointments</h4>
                        <ul style="list-style:none; padding:0; display:flex; flex-direction:column; gap:12px;">
                            @forelse($appointments as $apt)
                            <li style="display:flex; justify-content:space-between; border-bottom:1px solid var(--border-color); padding-bottom:8px;">
                                <div>
                                    <strong style="font-size:14px;">{{ $apt->booking_ref }}</strong>
                                    <div style="font-size:12px; color:var(--text-muted);">Date: {{ $apt->appointment_date->format('d M Y') }}</div>
                                </div>
                                <span style="font-size:12px; font-weight:600; text-transform:uppercase;">{{ $apt->status }}</span>
                            </li>
                            @empty
                            <li style="text-align:center; color:var(--text-muted); font-size:14px; padding:10px;">No upcoming meetings booked.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Invoices -->
                    <div class="form-card" style="padding:25px;">
                        <h4 style="margin-bottom:15px;"><i class="fas fa-file-invoice-dollar"></i> Recent Invoices</h4>
                        <ul style="list-style:none; padding:0; display:flex; flex-direction:column; gap:12px;">
                            @forelse($invoices as $inv)
                            <li style="display:flex; justify-content:space-between; border-bottom:1px solid var(--border-color); padding-bottom:8px;">
                                <div>
                                    <strong style="font-size:14px;">{{ $inv->invoice_number }}</strong>
                                    <div style="font-size:12px; color:var(--text-muted);">Due: {{ $inv->due_date ? $inv->due_date->format('d M Y') : 'N/A' }}</div>
                                </div>
                                <strong>${{ number_format($inv->total, 2) }}</strong>
                            </li>
                            @empty
                            <li style="text-align:center; color:var(--text-muted); font-size:14px; padding:10px;">No pending invoices found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
