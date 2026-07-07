@extends('layouts.app')
@section('title', 'My Visa Applications')

@section('content')
<section class="page-header" style="padding: 40px 0;">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; text-align:left;">
        <div>
            <h1 style="font-size:28px; margin:0;">Visa Applications</h1>
            <p style="color:rgba(255,255,255,0.7); margin:0;">Track live case progress and documentation requirements.</p>
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
                        <a href="{{ route('client.dashboard') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-chart-line"></i> Dashboard Overview
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.applications') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; background:rgba(11, 61, 145, 0.05); color:var(--primary-color); border-radius:8px; font-weight:600;">
                            <i class="fas fa-folder-open"></i> My Applications
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.appointments') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
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
            <div>
                @forelse($applications as $app)
                <div class="form-card" style="margin-bottom:30px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--border-color); padding-bottom:15px; margin-bottom:20px; flex-wrap:wrap; gap:10px;">
                        <div>
                            <h3 style="color:var(--primary-color);">Application ID: {{ $app->application_id }}</h3>
                            <p style="color:var(--text-muted); font-size:14px;">Category: <strong>{{ optional($app->visaCategory)->name ?? 'Permanent Residency' }}</strong> to <strong>{{ optional($app->country)->name ?? 'Canada' }}</strong></p>
                        </div>
                        <div>
                            <span class="btn-topbar" style="background:var(--primary-color); border-radius:50px; font-weight:600;">
                                STATUS: {{ strtoupper($app->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <h4 style="margin-bottom:15px;"><i class="fas fa-history"></i> Case Timeline</h4>
                    <div style="display:flex; flex-direction:column; gap:15px; border-left: 2px dashed var(--secondary-color); padding-left:20px; margin-left:10px;">
                        @forelse($app->timelines as $t)
                        <div style="position:relative;">
                            <span style="position:absolute; left:-27px; top:3px; width:12px; height:12px; border-radius:50%; background:var(--secondary-color); border:2px solid var(--bg-white);"></span>
                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <strong>{{ $t->stage }}</strong>
                                <small style="color:var(--text-muted);">{{ $t->completed_at ? $t->completed_at->format('d M Y') : '' }}</small>
                            </div>
                            <p style="font-size:13px; color:var(--text-muted); margin-top:3px;">{{ $t->description }}</p>
                        </div>
                        @empty
                        <div style="position:relative;">
                            <span style="position:absolute; left:-27px; top:3px; width:12px; height:12px; border-radius:50%; background:var(--secondary-color); border:2px solid var(--bg-white);"></span>
                            <strong>Application Logged</strong>
                            <p style="font-size:13px; color:var(--text-muted); margin-top:3px;">Your visa consultation dossier has been filed successfully.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                @empty
                <div class="form-card text-center" style="padding:40px;">
                    <i class="fas fa-folder-open" style="font-size:50px; color:var(--primary-color); opacity:0.2; margin-bottom:15px;"></i>
                    <h3>No Applications Filed</h3>
                    <p style="color:var(--text-muted); margin-bottom:20px;">You haven't initialized any visa processing case files yet.</p>
                    <a href="{{ route('appointment.index') }}" class="btn-primary">Book Consultation to Get Started</a>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</section>
@endsection
