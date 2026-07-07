@extends('layouts.app')
@section('title', 'Application Status Result')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Application Tracker Status</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <a href="{{ route('tracker.index') }}">Tracker</a> / <span>Status Details</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 800px;">
        <div class="form-card">
            
            <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--border-color); padding-bottom:20px; margin-bottom:30px; flex-wrap:wrap; gap:15px;">
                <div>
                    <h2 style="font-size:24px; color:var(--primary-color);">Ref: {{ $application->application_id }}</h2>
                    <p style="color:var(--text-muted); font-size:14px;">Applicant Name: <strong>{{ $application->applicant_name }}</strong></p>
                </div>
                <div>
                    <span class="btn-topbar" style="background:@if($application->status == 'approved') #1e7e34 @elseif($application->status == 'rejected') #dc3545 @else var(--primary-color) @endif; border-radius:50px; font-weight:600; padding:8px 20px;">
                        {{ strtoupper($application->status) }}
                    </span>
                </div>
            </div>

            <!-- Basic Info Grid -->
            <div class="form-grid" style="margin-bottom:35px; background:var(--bg-light); padding:20px; border-radius:var(--border-radius);">
                <div class="form-group">
                    <span style="font-size:12px; color:var(--text-muted); font-weight:600;">COUNTRY</span>
                    <strong style="font-size:16px;">{{ optional($application->country)->name ?? 'Canada' }}</strong>
                </div>
                <div class="form-group">
                    <span style="font-size:12px; color:var(--text-muted); font-weight:600;">VISA CATEGORY</span>
                    <strong style="font-size:16px;">{{ optional($application->visaCategory)->name ?? 'Permanent Residency' }}</strong>
                </div>
                <div class="form-group">
                    <span style="font-size:12px; color:var(--text-muted); font-weight:600;">SUBMISSION DATE</span>
                    <strong style="font-size:16px;">{{ $application->submission_date ? $application->submission_date->format('d M Y') : 'N/A' }}</strong>
                </div>
                <div class="form-group">
                    <span style="font-size:12px; color:var(--text-muted); font-weight:600;">ESTIMATED COMPLETION</span>
                    <strong style="font-size:16px;">{{ $application->expected_completion ? $application->expected_completion->format('d M Y') : 'N/A' }}</strong>
                </div>
            </div>

            <!-- Timeline -->
            <h3 style="margin-bottom:20px;"><i class="fas fa-stream"></i> Application Processing Timeline</h3>
            <div style="display:flex; flex-direction:column; gap:20px; border-left: 2px dashed var(--primary-color); padding-left:25px; margin-left:15px; margin-bottom:40px;">
                @forelse($application->timelines as $timeline)
                    <div style="position:relative;">
                        <span style="position:absolute; left:-33px; top:0; width:15px; height:15px; border-radius:50%; background:var(--secondary-color); border:3px solid var(--bg-white);"></span>
                        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
                            <strong style="font-size:15px; color:var(--primary-dark);">{{ $timeline->stage }}</strong>
                            <small style="color:var(--text-muted);">{{ $timeline->completed_at ? $timeline->completed_at->format('d M Y, h:i A') : '' }}</small>
                        </div>
                        <p style="color:var(--text-muted); font-size:13px; margin-top:5px;">{{ $timeline->description }}</p>
                    </div>
                @empty
                    <div style="position:relative;">
                        <span style="position:absolute; left:-33px; top:0; width:15px; height:15px; border-radius:50%; background:var(--primary-color); border:3px solid var(--bg-white);"></span>
                        <strong>Application Logged</strong>
                        <p style="color:var(--text-muted); font-size:13px; margin-top:5px;">Your application has been registered into our secure tracking system.</p>
                    </div>
                @endforelse
            </div>

            <!-- Required Documents Status -->
            <h3 style="margin-bottom:20px;"><i class="fas fa-file-invoice"></i> Verification Documents</h3>
            <div style="display:flex; flex-direction:column; gap:10px;">
                @forelse($application->documents as $doc)
                    <div style="display:flex; justify-content:space-between; align-items:center; border:1px solid var(--border-color); padding:15px 20px; border-radius:8px;">
                        <div>
                            <strong>{{ $doc->name }}</strong>
                            <div style="font-size:12px; color:var(--text-muted);">Uploaded: {{ $doc->created_at->format('d M Y') }}</div>
                        </div>
                        <div>
                            <span class="btn-topbar" style="background:@if($doc->status == 'approved') #1e7e34 @elseif($doc->status == 'rejected') #dc3545 @else #d4af37 @endif; font-size:12px; border-radius:4px; padding:4px 10px;">
                                {{ strtoupper($doc->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p style="color:var(--text-muted); font-size:14px;">No specific documents uploaded to tracker yet. Check the client dashboard for file management.</p>
                @endforelse
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('tracker.index') }}" class="btn-outline">Track Another Application</a>
            </div>

        </div>
    </div>
</section>
@endsection
