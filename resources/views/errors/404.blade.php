@extends('layouts.app')
@section('title', 'Page Not Found - 404')

@section('content')
<section class="section-padding bg-light text-center" style="min-height:70vh; display:flex; align-items:center;">
    <div class="container" style="max-width: 600px;">
        <div class="form-card">
            <h1 style="font-size:120px; font-weight:900; line-height:1; color:var(--primary-color); margin-bottom:10px;">404</h1>
            <h2 style="margin-bottom:15px; color:var(--primary-dark);">Oops! Page Not Found</h2>
            <p style="color:var(--text-muted); margin-bottom:30px;">The link you followed may be broken, or the page may have been removed. If you believe this is an error, please reach out to support.</p>
            
            <div style="display:flex; justify-content:center; gap:15px;">
                <a href="{{ route('home') }}" class="btn-primary">Go to Homepage</a>
                <a href="{{ route('contact') }}" class="btn-outline">Contact Support</a>
            </div>
        </div>
    </div>
</section>
@endsection
