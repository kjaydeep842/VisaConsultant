@extends('layouts.app')
@section('title', 'Book a Consultation')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Book an Appointment</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Consultation Booking</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 800px;">
        <div class="form-card">
            <h2 class="text-center" style="margin-bottom: 10px;">Schedule Consultation</h2>
            <p class="text-center" style="color: var(--text-muted); margin-bottom: 35px;">Select your preferred meeting date, channel (Online Zoom/Google Meet or Branch Office) and consultant to lock your appointment.</p>
            
            <form action="{{ route('appointment.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="client_name">Your Full Name *</label>
                        <input type="text" name="client_name" id="client_name" class="form-control" value="{{ auth()->check() ? auth()->user()->name : '' }}" placeholder="e.g. John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="client_email">Email Address *</label>
                        <input type="email" name="client_email" id="client_email" class="form-control" value="{{ auth()->check() ? auth()->user()->email : '' }}" placeholder="e.g. name@domain.com" required>
                    </div>
                    <div class="form-group">
                        <label for="client_phone">Phone Number *</label>
                        <input type="text" name="client_phone" id="client_phone" class="form-control" value="{{ auth()->check() ? auth()->user()->phone : '' }}" placeholder="e.g. +91 9876543210" required>
                    </div>
                    <div class="form-group">
                        <label for="consultant_id">Select Consultant (Optional)</label>
                        <select name="consultant_id" id="consultant_id" class="form-control">
                            <option value="">Auto Assign (Best Available)</option>
                            @foreach($consultants as $con)
                                <option value="{{ $con->id }}">{{ $con->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="appointment_date">Preferred Date *</label>
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_time">Preferred Time *</label>
                        <select name="appointment_time" id="appointment_time" class="form-control" required>
                            <option value="">Select Time Slot</option>
                            <option value="10:00:00">10:00 AM – 11:00 AM</option>
                            <option value="11:30:00">11:30 AM – 12:30 PM</option>
                            <option value="14:00:00">02:00 PM – 03:00 PM</option>
                            <option value="15:30:00">03:30 PM – 04:30 PM</option>
                            <option value="17:00:00">05:00 PM – 06:00 PM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="meeting_type">Meeting Channel *</label>
                        <select name="meeting_type" id="meeting_type" class="form-control" required>
                            <option value="offline">Offline / Office Visit</option>
                            <option value="online_meet">Google Meet (Online)</option>
                            <option value="zoom">Zoom Video Call (Online)</option>
                            <option value="whatsapp">WhatsApp Audio/Video call</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="branch">Office Branch</label>
                        <select name="branch" id="branch" class="form-control">
                            <option value="Mumbai Head Office">Mumbai (Corporate Head Office)</option>
                            <option value="Pune Branch">Pune Branch</option>
                            <option value="Delhi Branch">Delhi Branch</option>
                            <option value="Virtual Branch">Online/Remote Consultation</option>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label for="purpose">Describe Your Immigration Goal / Query</label>
                        <textarea name="purpose" id="purpose" rows="4" class="form-control" placeholder="Describe the visa category you are interested in or questions you have..."></textarea>
                    </div>
                </div>
                
                <button type="submit" class="btn-primary" style="width:100%; border:none;">Confirm Appointment Booking</button>
            </form>
        </div>
    </div>
</section>
@endsection
