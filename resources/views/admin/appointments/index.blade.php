@extends('admin.layout')
@section('title', 'Appointments')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Appointments Calendar <small>Manage consultations, channels, and statuses</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Appointment</a>
    </div>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-calendar-check"></i> All Appointments</div>
        <span style="font-size:12px;color:var(--admin-muted);">{{ $appointments->total() }} total bookings</span>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Ref / Date & Time</th>
                    <th>Client</th>
                    <th>Contact</th>
                    <th>Channel</th>
                    <th>Consultant</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $apt)
                <tr>
                    <td>
                        <div style="font-weight:600;font-size:13px;">{{ $apt->booking_ref }}</div>
                        <div style="font-size:11px;color:var(--admin-muted);">
                            {{ $apt->appointment_date->format('d M Y') }} at {{ date('h:i A', strtotime($apt->appointment_time)) }}
                        </div>
                    </td>
                    <td><strong>{{ $apt->client_name }}</strong></td>
                    <td>
                        <div style="font-size:12px;">{{ $apt->client_email }}</div>
                        <div style="font-size:11px;color:var(--admin-muted);">{{ $apt->client_phone }}</div>
                    </td>
                    <td>
                        <span style="font-size:12px;text-transform:uppercase;background:#f1f5f9;padding:3px 8px;border-radius:4px;">
                            {{ str_replace('_',' ',$apt->meeting_type) }}
                        </span>
                    </td>
                    <td>{{ optional($apt->consultant)->name ?? 'Auto Assigned' }}</td>
                    <td><span class="badge badge-{{ $apt->status }}">{{ $apt->status }}</span></td>
                    <td>
                        <form action="{{ route('admin.appointments.update', $apt->id) }}" method="POST">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="admin-form-control" style="padding:6px 10px;font-size:12px;min-width:120px;">
                                <option value="pending" @selected($apt->status=='pending')>Pending</option>
                                <option value="confirmed" @selected($apt->status=='confirmed')>Confirmed</option>
                                <option value="completed" @selected($apt->status=='completed')>Completed</option>
                                <option value="cancelled" @selected($apt->status=='cancelled')>Cancelled</option>
                                <option value="no_show" @selected($apt->status=='no_show')>No Show</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="7"><i class="fas fa-calendar-times" style="font-size:24px;display:block;margin-bottom:8px;"></i>No appointments booked yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($appointments->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $appointments->links() }}</div>
    @endif
</div>
@endsection
