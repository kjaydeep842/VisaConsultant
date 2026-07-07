@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')

{{-- Page Header --}}
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">
            Overview Dashboard
            <small>Welcome back, {{ auth()->user()->name }} — {{ now()->format('l, d M Y') }}</small>
        </h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Lead
        </a>
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline">
            <i class="fas fa-calendar"></i> Appointments
        </a>
    </div>
</div>

{{-- Stats Cards --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-user-tag"></i></div>
        <div class="stat-info">
            <div class="stat-label">Total Leads</div>
            <div class="stat-value">{{ $stats['total_leads'] }}</div>
            <div class="stat-sub" style="color:#ef4444;"><i class="fas fa-circle" style="font-size:8px;"></i> New: {{ $stats['new_leads'] }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon cyan"><i class="fas fa-folder-open"></i></div>
        <div class="stat-info">
            <div class="stat-label">Applications</div>
            <div class="stat-value">{{ $stats['total_applications'] }}</div>
            <div class="stat-sub"><i class="fas fa-clock" style="font-size:9px;"></i> Pending: {{ $stats['pending_applications'] }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-calendar-check"></i></div>
        <div class="stat-info">
            <div class="stat-label">Today's Appointments</div>
            <div class="stat-value">{{ $stats['today_appointments'] }}</div>
            <div class="stat-sub">Sessions booked</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <div class="stat-label">Client Accounts</div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-sub">Registered clients</div>
        </div>
    </div>
</div>

{{-- Second stats row --}}
<div class="stats-grid" style="margin-bottom:24px;">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-newspaper"></i></div>
        <div class="stat-info">
            <div class="stat-label">Blog Posts</div>
            <div class="stat-value">{{ $stats['total_blogs'] }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon cyan"><i class="fas fa-globe-americas"></i></div>
        <div class="stat-info">
            <div class="stat-label">Countries</div>
            <div class="stat-value">{{ $stats['total_countries'] }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-chart-bar"></i></div>
        <div class="stat-info">
            <div class="stat-label">Conversion Rate</div>
            <div class="stat-value">{{ $stats['total_leads'] > 0 ? round(($stats['total_applications']/$stats['total_leads'])*100) : 0 }}%</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
        <div class="stat-info">
            <div class="stat-label">Success Rate</div>
            <div class="stat-value">98%</div>
            <div class="stat-sub">Industry-leading</div>
        </div>
    </div>
</div>

<div class="grid-2">
    {{-- Recent Leads --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-user-tag"></i> Recent Sales Leads</div>
            <a href="{{ route('admin.leads.index') }}" class="btn btn-sm btn-outline">View All</a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Assigned</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLeads as $lead)
                    <tr>
                        <td>
                            <div style="font-weight:600;">{{ $lead->name }}</div>
                            <div style="font-size:12px;color:#64748b;">{{ $lead->email }}</div>
                        </td>
                        <td>{{ $lead->country_interested }}</td>
                        <td>{{ optional($lead->assignedConsultant)->name ?? '—' }}</td>
                        <td>
                            <span class="badge badge-{{ $lead->status }}">{{ $lead->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row"><td colspan="4"><i class="fas fa-inbox" style="font-size:20px;display:block;margin-bottom:8px;"></i>No leads yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Today's Appointments --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-calendar-check"></i> Today's Consultations</div>
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline">Calendar</a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Client</th>
                        <th>Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todayAppointments as $apt)
                    <tr>
                        <td><strong>{{ date('h:i A', strtotime($apt->appointment_time)) }}</strong></td>
                        <td>{{ $apt->client_name }}</td>
                        <td style="font-size:12px;text-transform:uppercase;">{{ str_replace('_',' ',$apt->meeting_type) }}</td>
                        <td><span class="badge badge-{{ $apt->status }}">{{ $apt->status }}</span></td>
                    </tr>
                    @empty
                    <tr class="empty-row"><td colspan="4"><i class="fas fa-calendar-times" style="font-size:20px;display:block;margin-bottom:8px;"></i>No meetings today</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Recent Applications --}}
<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-folder-open"></i> Recent Applications</div>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-outline">All Cases</a>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>Applicant</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentApplications as $app)
                <tr>
                    <td><strong>{{ $app->application_id }}</strong></td>
                    <td>{{ $app->applicant_name }}</td>
                    <td>{{ optional($app->country)->name }}</td>
                    <td><span class="badge badge-{{ $app->status }}">{{ $app->status }}</span></td>
                    <td>{{ $app->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.applications.show', $app) }}" class="btn btn-sm btn-outline btn-icon" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="6"><i class="fas fa-inbox" style="font-size:20px;display:block;margin-bottom:8px;"></i>No applications filed</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
