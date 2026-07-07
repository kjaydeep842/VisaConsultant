@extends('admin.layout')
@section('title', 'Reports')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Reports <small>Generate and export business reports</small></h1>
    </div>
</div>

<div class="grid-3">
    <div class="data-card" style="margin-bottom:0;">
        <div class="data-card-body" style="text-align:center;padding:30px 20px;">
            <div style="width:56px;height:56px;border-radius:14px;background:rgba(11,61,145,0.08);color:#0B3D91;font-size:24px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <i class="fas fa-user-tag"></i>
            </div>
            <h3 style="font-size:16px;margin-bottom:6px;">Leads Report</h3>
            <p style="font-size:12px;color:var(--admin-muted);margin-bottom:16px;">All leads with status, source, and assignment</p>
            <a href="{{ route('admin.leads.index') }}" class="btn btn-sm btn-outline" style="width:100%;justify-content:center;">View Leads</a>
        </div>
    </div>
    <div class="data-card" style="margin-bottom:0;">
        <div class="data-card-body" style="text-align:center;padding:30px 20px;">
            <div style="width:56px;height:56px;border-radius:14px;background:rgba(0,164,228,0.08);color:#00A4E4;font-size:24px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <i class="fas fa-folder-open"></i>
            </div>
            <h3 style="font-size:16px;margin-bottom:6px;">Applications Report</h3>
            <p style="font-size:12px;color:var(--admin-muted);margin-bottom:16px;">Cases with status, country, and timeline</p>
            <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-outline" style="width:100%;justify-content:center;">View Cases</a>
        </div>
    </div>
    <div class="data-card" style="margin-bottom:0;">
        <div class="data-card-body" style="text-align:center;padding:30px 20px;">
            <div style="width:56px;height:56px;border-radius:14px;background:rgba(212,175,55,0.08);color:#D4AF37;font-size:24px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3 style="font-size:16px;margin-bottom:6px;">Appointments Report</h3>
            <p style="font-size:12px;color:var(--admin-muted);margin-bottom:16px;">All bookings with consultant and channel</p>
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline" style="width:100%;justify-content:center;">View Appointments</a>
        </div>
    </div>
</div>

<div class="data-card" style="margin-top:0;">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-file-export"></i> Export Data</div>
    </div>
    <div class="data-card-body" style="text-align:center;padding:40px 20px;">
        <i class="fas fa-file-csv" style="font-size:48px;color:var(--admin-success);margin-bottom:16px;display:block;"></i>
        <h3 style="margin-bottom:8px;">CSV / Excel Export</h3>
        <p style="color:var(--admin-muted);max-width:400px;margin:0 auto 20px;font-size:14px;">
            Export functionality can be implemented with Laravel Excel package. Add the integration in Settings to enable one-click data exports.
        </p>
        <a href="{{ route('admin.settings') }}" class="btn btn-secondary"><i class="fas fa-cogs"></i> Configure Integrations</a>
    </div>
</div>
@endsection
