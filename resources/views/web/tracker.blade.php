@extends('layouts.app')
@section('title', 'Track Your Immigration Application')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Track Your Application Status</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Application Tracker</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 600px;">
        <div class="form-card">
            <h2 class="text-center" style="margin-bottom: 10px;">Check Application Status</h2>
            <p class="text-center" style="color: var(--text-muted); margin-bottom: 30px;">Enter your unique Application Reference Number (e.g., NV20261234) and your Passport Number to track real-time immigration progress.</p>
            
            <form action="{{ route('tracker.track') }}" method="POST">
                @csrf
                <div class="form-grid" style="grid-template-columns: 1fr; gap:20px; margin-bottom:20px;">
                    <div class="form-group">
                        <label for="application_id">Application ID / Reference Number *</label>
                        <input type="text" name="application_id" id="application_id" class="form-control" placeholder="e.g. NV20260001" required>
                    </div>
                    <div class="form-group">
                        <label for="passport_number">Passport Number *</label>
                        <input type="text" name="passport_number" id="passport_number" class="form-control" placeholder="e.g. Z1234567" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-primary" style="width:100%; border:none;">Track Status <i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</section>
@endsection
