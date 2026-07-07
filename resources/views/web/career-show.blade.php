@extends('layouts.app')
@section('title', $career->title)

@section('content')
<section class="page-header">
    <div class="container">
        <h1>{{ $career->title }}</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <a href="{{ route('careers') }}">Careers</a> / <span>Job Details</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="why-us-grid" style="align-items: flex-start; grid-template-columns: 2fr 1fr; gap: 40px;">
            <!-- Job Details -->
            <div>
                <span class="section-badge">{{ str_replace('_', ' ', $career->type) }}</span>
                <h2 class="section-title" style="margin-top: 10px; margin-bottom: 20px;">Job Description & Scope</h2>
                
                <div style="background: #fff; border-radius: var(--border-radius); padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 30px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px;">
                        <div>
                            <small style="display:block; color:var(--text-muted); font-size:12px;">DEPARTMENT</small>
                            <strong>{{ $career->department }}</strong>
                        </div>
                        <div>
                            <small style="display:block; color:var(--text-muted); font-size:12px;">LOCATION</small>
                            <strong>{{ $career->location }}</strong>
                        </div>
                        @if($career->salary_min || $career->salary_max)
                        <div>
                            <small style="display:block; color:var(--text-muted); font-size:12px;">SALARY RANGE</small>
                            <strong>
                                @if($career->salary_min) ₹{{ number_format($career->salary_min, 0) }} @endif
                                @if($career->salary_max) - ₹{{ number_format($career->salary_max, 0) }} @endif
                            </strong>
                        </div>
                        @endif
                        @if($career->deadline)
                        <div>
                            <small style="display:block; color:var(--text-muted); font-size:12px;">DEADLINE</small>
                            <strong>{{ $career->deadline->format('M d, Y') }}</strong>
                        </div>
                        @endif
                    </div>

                    <h3 style="margin-top:0; font-size:20px; color:var(--text-dark); margin-bottom:15px;">Role Overview</h3>
                    <p style="color:var(--text-muted); line-height:1.8; font-size:15px; margin-bottom:30px; white-space: pre-line;">
                        {{ $career->description }}
                    </p>

                    @if($career->requirements)
                    <h3 style="font-size:20px; color:var(--text-dark); margin-bottom:15px;">Requirements & Qualifications</h3>
                    <p style="color:var(--text-muted); line-height:1.8; font-size:15px; white-space: pre-line;">
                        {{ $career->requirements }}
                    </p>
                    @endif
                </div>
            </div>

            <!-- Apply Form -->
            <div class="form-card" style="position: sticky; top: 100px;">
                <h3>Apply for this Position</h3>
                <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 25px;">Please fill out your credentials and attach your CV to apply.</p>
                <form action="{{ route('career.apply', $career->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" name="name" id="name" class="form-control" required placeholder="e.g. John Doe">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" name="email" id="email" class="form-control" required placeholder="e.g. name@domain.com">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="text" name="phone" id="phone" class="form-control" required placeholder="e.g. +91 9876543210">
                    </div>
                    <div class="form-group">
                        <label for="resume">Upload Resume (PDF, DOC, DOCX) *</label>
                        <input type="file" name="resume" id="resume" class="form-control" required style="padding: 8px 12px;">
                    </div>
                    <div class="form-group">
                        <label for="cover_letter">Cover Letter / Introduction</label>
                        <textarea name="cover_letter" id="cover_letter" rows="4" class="form-control" placeholder="Write a short message to the hiring manager..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; border:none; margin-top: 10px;">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
