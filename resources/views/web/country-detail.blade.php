@extends('layouts.app')
@section('title', $country->name . ' Immigration')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>{{ $country->name }} Visa Pathways</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <a href="{{ route('countries.index') }}">Countries</a> / <span>{{ $country->name }}</span>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="detail-layout-grid">
            
            <!-- Left Info Panel -->
            <div class="form-card">
                <div style="display:flex; align-items:center; gap:20px; margin-bottom:25px;">
                    <div style="width:70px; height:70px; border-radius:50%; overflow:hidden; border:2px solid var(--border-color);">
                        <img src="https://flagcdn.com/w80/{{ strtolower($country->code ?? 'ca') }}.png" alt="{{ $country->name }}" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div>
                        <h2 style="margin:0;">{{ $country->name }}</h2>
                        <span style="color:var(--secondary-color); font-weight:600;">Authorized Legal Pathways</span>
                    </div>
                </div>

                <div style="line-height:1.8; color:var(--text-color); font-size:16px;">
                    <p style="margin-bottom:20px;">{{ $country->overview }}</p>
                    <p style="margin-bottom:20px;">{{ $country->description ?? 'Our firm provides custom profiles, points evaluation, and dossier compilation to guarantee the highest visa success rates. We deal directly with authorized immigration practitioners representing Express Entry, Provincial Nominees, and local business sponsorship programs.' }}</p>
                </div>

                <div style="background:var(--bg-light); border-radius:var(--border-radius); padding:25px; margin-top:30px;">
                    <h4 style="margin-bottom:15px; color:var(--primary-dark);"><i class="fas fa-info-circle"></i> Key Highlights & Requirements:</h4>
                    <ul style="list-style:none; padding:0; display:flex; flex-direction:column; gap:12px;">
                        <li><i class="fas fa-check" style="color:var(--secondary-color); margin-right:8px;"></i> Permanent Residence (Skilled Work pathways)</li>
                        <li><i class="fas fa-check" style="color:var(--secondary-color); margin-right:8px;"></i> Student Visa & Post-Graduation Work Permits</li>
                        <li><i class="fas fa-check" style="color:var(--secondary-color); margin-right:8px;"></i> Family & Spouse Sponsorship streams</li>
                    </ul>
                </div>
            </div>

            <!-- Right Sidebar CTA -->
            <div>
                <div class="form-card" style="border-top: 5px solid var(--primary-color); margin-bottom:30px; padding:30px 20px; text-align:center;">
                    <h3 style="margin-bottom:15px;">Check Your Eligibility</h3>
                    <p style="color:var(--text-muted); font-size:14px; margin-bottom:20px;">Use our free AI assessment tool to calculate your immigration score instantly.</p>
                    <a href="{{ route('assessment.index') }}" class="btn-primary" style="display:block;">Start Free Check</a>
                </div>

                <div class="form-card" style="padding:30px 20px;">
                    <h3 style="margin-bottom:15px;"><i class="far fa-calendar-check"></i> Book Consultation</h3>
                    <p style="color:var(--text-muted); font-size:14px; margin-bottom:20px;">Schedule a 30-minute Zoom call with our ICCRC / MARA registered counselors.</p>
                    <a href="{{ route('appointment.index') }}" class="btn-outline" style="display:block;">Schedule Meeting</a>
                </div>
            </div>

        </div>
    </div>
</section>

@if(isset($gallery) && $gallery->count() > 0)
<section class="section-padding" style="background: #fff; border-top: 1px solid var(--border-color);">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Proven Success</span>
            <h2 class="section-title">{{ $country->name }} Visa Approval Gallery</h2>
            <p class="section-subtitle">Real visa approvals obtained for our clients travelling to {{ $country->name }}.</p>
        </div>

        <div class="why-us-grid" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 40px;">
            @foreach($gallery as $item)
                <div class="form-card" style="padding: 10px; overflow: hidden;">
                    @if($item->image)
                        <img src="{{ storageFile($item->image) }}" alt="{{ $item->title }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: 10px;">
                    @else
                        <div style="width: 100%; height: 200px; background: #cbd5e1; border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                            <i class="fas fa-image" style="font-size: 40px; color: #94a3b8;"></i>
                        </div>
                    @endif
                    <h4 style="margin: 0 0 8px 0; color: var(--text-dark); font-size: 16px;">{{ $item->title }}</h4>
                    <span style="font-size: 11px; font-weight: 600; background: rgba(11, 61, 145, 0.1); color: var(--primary-color); padding: 2px 8px; border-radius: 4px; display: inline-block; margin-bottom: 10px;">{{ $item->category }}</span>
                    @if($item->description)
                        <p style="color: var(--text-muted); font-size: 13px; line-height: 1.5; margin: 0;">
                            {{ $item->description }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
