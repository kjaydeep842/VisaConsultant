@extends('layouts.app')
@section('title', 'Appointment Booked Successfully')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Booking Confirmed</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <a href="{{ route('appointment.index') }}">Appointment</a> / <span>Success</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 600px;">
        <div class="form-card text-center" style="border-top: 5px solid #1e7e34;">
            
            <div style="font-size: 60px; color: #1e7e34; margin-bottom: 20px;">
                <i class="far fa-check-circle"></i>
            </div>
            
            <h2 style="margin-bottom: 10px;">Appointment Logged!</h2>
            <p style="color:var(--text-muted); margin-bottom: 30px;">Your appointment has been registered with booking reference: <strong style="color:var(--primary-color);">{{ $appointment->booking_ref }}</strong></p>
            
            <div style="text-align: left; background: var(--bg-light); border-radius: var(--border-radius); padding: 25px; margin-bottom: 30px;">
                <div style="margin-bottom: 12px; display:flex; justify-content:space-between;">
                    <span style="color:var(--text-muted);">Client Name:</span>
                    <strong>{{ $appointment->client_name }}</strong>
                </div>
                <div style="margin-bottom: 12px; display:flex; justify-content:space-between;">
                    <span style="color:var(--text-muted);">Date & Time:</span>
                    <strong>{{ $appointment->appointment_date->format('d M Y') }} at {{ date('h:i A', strtotime($appointment->appointment_time)) }}</strong>
                </div>
                <div style="margin-bottom: 12px; display:flex; justify-content:space-between;">
                    <span style="color:var(--text-muted);">Meeting Type:</span>
                    <strong style="text-transform: uppercase;">{{ str_replace('_', ' ', $appointment->meeting_type) }}</strong>
                </div>
                <div style="display:flex; justify-content:space-between;">
                    <span style="color:var(--text-muted);">Branch Office:</span>
                    <strong>{{ $appointment->branch ?? 'Corporate Office' }}</strong>
                </div>
            </div>

            <p style="color: var(--text-muted); font-size:14px; margin-bottom:30px;">
                We have logged this request. If an online meeting was selected, a Google Meet / Zoom link will be emailed to you shortly. For offline branch visits, please carry copy of your Resume and Passport.
            </p>

            <div style="display:flex; flex-direction:column; gap:12px;">
                <a href="{{ route('home') }}" class="btn-primary" style="display:block; text-align:center;">Back to Home</a>
                <a href="https://wa.me/919876543210?text=Hi%20NV%20Visa,%20I%20have%20booked%20an%20appointment%20with%20ref%20{{ $appointment->booking_ref }}" target="_blank" class="btn-outline" style="display:block; text-align:center; border-color:#25D366; color:#25D366;">
                    <i class="fab fa-whatsapp"></i> Notify on WhatsApp
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
