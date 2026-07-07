@extends('admin.layout')
@section('title', 'New Appointment')
@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">New Appointment <small>Manually schedule a consultation</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.appointments.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-calendar-plus"></i> Appointment Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.appointments.store') }}" method="POST">
            @csrf
            <div class="admin-form-grid">
                <div class="admin-form-group"><label>Client Name *</label><input type="text" name="client_name" class="admin-form-control" required></div>
                <div class="admin-form-group"><label>Client Email *</label><input type="email" name="client_email" class="admin-form-control" required></div>
                <div class="admin-form-group"><label>Client Phone *</label><input type="text" name="client_phone" class="admin-form-control" required></div>
                <div class="admin-form-group"><label>Date *</label><input type="date" name="appointment_date" class="admin-form-control" required></div>
                <div class="admin-form-group"><label>Time *</label><input type="time" name="appointment_time" class="admin-form-control" required></div>
                <div class="admin-form-group"><label>Meeting Channel</label><select name="meeting_type" class="admin-form-control"><option value="video_call">Video Call</option><option value="phone_call">Phone Call</option><option value="in_person">In Person</option><option value="whatsapp">WhatsApp</option></select></div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-calendar-check"></i> Book Appointment</button>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
