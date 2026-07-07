@extends('layouts.app')
@section('title', 'My Consultation Appointments')

@section('content')
<section class="page-header" style="padding: 40px 0;">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; text-align:left;">
        <div>
            <h1 style="font-size:28px; margin:0;">Consultation Appointments</h1>
            <p style="color:rgba(255,255,255,0.7); margin:0;">Book or track appointments with our certified experts.</p>
        </div>
        <div>
            <a href="{{ route('appointment.index') }}" class="btn-topbar" style="background:var(--secondary-color);"><i class="fas fa-plus"></i> Book New Session</a>
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
                        <a href="{{ route('client.dashboard') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-chart-line"></i> Dashboard Overview
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.applications') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-folder-open"></i> My Applications
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.appointments') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; background:rgba(11, 61, 145, 0.05); color:var(--primary-color); border-radius:8px; font-weight:600;">
                            <i class="fas fa-calendar-alt"></i> My Appointments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.documents') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-file-signature"></i> Uploaded Documents
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.invoices') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-file-invoice-dollar"></i> Receipts & Invoices
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.profile') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-user-cog"></i> Account Settings
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content Area -->
            <div class="form-card">
                <h3>Scheduled Appointments</h3>
                <p style="color:var(--text-muted); font-size:14px; margin-bottom:25px;">Please check meeting details for online zoom room links or office coordinates.</p>

                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; text-align:left;">
                        <thead>
                            <tr style="border-bottom:2px solid var(--border-color);">
                                <th style="padding:12px;">Reference</th>
                                <th style="padding:12px;">Date & Time</th>
                                <th style="padding:12px;">Channel</th>
                                <th style="padding:12px;">Consultant</th>
                                <th style="padding:12px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $apt)
                            <tr style="border-bottom:1px solid var(--border-color);">
                                <td style="padding:12px;"><strong>{{ $apt->booking_ref }}</strong></td>
                                <td style="padding:12px;">
                                    {{ $apt->appointment_date->format('d M Y') }} at {{ date('h:i A', strtotime($apt->appointment_time)) }}
                                </td>
                                <td style="padding:12px; text-transform:uppercase;">
                                    {{ str_replace('_', ' ', $apt->meeting_type) }}
                                </td>
                                <td style="padding:12px;">{{ optional($apt->consultant)->name ?? 'Auto Assigned' }}</td>
                                <td style="padding:12px;">
                                    <span class="btn-topbar" style="background:@if($apt->status == 'approved') #1e7e34 @else #d4af37 @endif; border-radius:4px; font-size:12px; padding:2px 8px;">
                                        {{ strtoupper($apt->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding:20px; text-align:center; color:var(--text-muted);">
                                    You have no appointments booked yet.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
