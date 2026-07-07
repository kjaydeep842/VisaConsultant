@extends('layouts.app')
@section('title', $service->name . ' Visa Service')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>{{ $service->name }}</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <a href="{{ route('services.index') }}">Services</a> / <span>{{ $service->name }}</span>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="detail-layout-grid">
            
            <!-- Left Info Panel -->
            <div class="form-card">
                <div style="display:flex; align-items:center; gap:20px; margin-bottom:25px;">
                    <div class="service-icon" style="margin:0;"><i class="fas {{ $service->icon ?? 'fa-passport' }}"></i></div>
                    <div>
                        <h2 style="margin:0;">{{ $service->name }}</h2>
                        <span style="color:var(--secondary-color); font-weight:600;">Custom Process Management</span>
                    </div>
                </div>

                <div style="line-height:1.8; color:var(--text-color); font-size:16px;">
                    <p style="margin-bottom:20px;">{{ $service->description }}</p>
                    <p style="margin-bottom:20px;">Our legal case handlers will review your IELTS scores, ECA report, age points, and job experience to assemble your immigration file. We coordinate with visa officers and immigration authorities to avoid processing delays.</p>
                </div>

                <div style="background:var(--bg-light); border-radius:var(--border-radius); padding:25px; margin-top:30px;">
                    <h4 style="margin-bottom:15px; color:var(--primary-dark);"><i class="fas fa-file-invoice"></i> Processing Steps:</h4>
                    <ol style="padding-left: 20px; display:flex; flex-direction:column; gap:12px; color:var(--text-color);">
                        <li><strong>Dossier Assembly:</strong> Collation of passport scans, education ECA credentials, and experience reference letters.</li>
                        <li><strong>E-filing Portal Submission:</strong> Uploading documents onto federal/provincial immigration portals.</li>
                        <li><strong>Interview Prep (If applicable):</strong> Preparing mock interview questions for embassy calls.</li>
                    </ol>
                </div>
            </div>

            <!-- Right Sidebar CTA -->
            <div>
                <div class="form-card" style="border-top: 5px solid var(--primary-color); margin-bottom:30px; padding:30px 20px; text-align:center;">
                    <h3 style="margin-bottom:15px;">Assess Eligibility</h3>
                    <p style="color:var(--text-muted); font-size:14px; margin-bottom:20px;">Calculate your immigration score instantly using our assessment tool.</p>
                    <a href="{{ route('assessment.index') }}" class="btn-primary" style="display:block;">Start Free Check</a>
                </div>

                <div class="form-card" style="padding:30px 20px;">
                    <h3 style="margin-bottom:15px;"><i class="far fa-calendar-check"></i> Book Consultation</h3>
                    <p style="color:var(--text-muted); font-size:14px; margin-bottom:20px;">Schedule a 30-minute conference call with our ICCRC / MARA registered counselors.</p>
                    <a href="{{ route('appointment.index') }}" class="btn-outline" style="display:block;">Schedule Meeting</a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
