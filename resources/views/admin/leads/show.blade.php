@extends('admin.layout')
@section('title', 'Lead Details')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Lead: {{ $lead->name }} <small>Update pipeline stage and add notes</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.leads.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Pipeline</a>
    </div>
</div>

<div class="grid-2">
    {{-- Lead Info --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-info-circle"></i> Lead Information</div>
            <span class="badge badge-{{ $lead->status }}">{{ $lead->status }}</span>
        </div>
        <div class="data-card-body">
            <div style="display:flex;flex-direction:column;gap:14px;">
                <div style="display:flex;justify-content:space-between;padding-bottom:10px;border-bottom:1px solid #e2e8f0;">
                    <span style="font-size:13px;color:var(--admin-muted);">Full Name</span>
                    <strong>{{ $lead->name }}</strong>
                </div>
                <div style="display:flex;justify-content:space-between;padding-bottom:10px;border-bottom:1px solid #e2e8f0;">
                    <span style="font-size:13px;color:var(--admin-muted);">Email</span>
                    <a href="mailto:{{ $lead->email }}" style="color:var(--admin-secondary);">{{ $lead->email }}</a>
                </div>
                <div style="display:flex;justify-content:space-between;padding-bottom:10px;border-bottom:1px solid #e2e8f0;">
                    <span style="font-size:13px;color:var(--admin-muted);">Phone</span>
                    <a href="tel:{{ $lead->phone }}" style="color:var(--admin-secondary);">{{ $lead->phone }}</a>
                </div>
                <div style="display:flex;justify-content:space-between;padding-bottom:10px;border-bottom:1px solid #e2e8f0;">
                    <span style="font-size:13px;color:var(--admin-muted);">Destination</span>
                    <strong>{{ $lead->country_interested ?? '—' }}</strong>
                </div>
                <div style="display:flex;justify-content:space-between;padding-bottom:10px;border-bottom:1px solid #e2e8f0;">
                    <span style="font-size:13px;color:var(--admin-muted);">Visa Type</span>
                    <strong>{{ $lead->visa_type ?? '—' }}</strong>
                </div>
                <div style="display:flex;justify-content:space-between;">
                    <span style="font-size:13px;color:var(--admin-muted);">Source</span>
                    <span style="text-transform:capitalize;">{{ str_replace('_',' ',$lead->source) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Update Form --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-edit"></i> Update Lead Status</div>
        </div>
        <div class="data-card-body">
            <form action="{{ route('admin.leads.update', $lead->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="admin-form-group">
                    <label>Pipeline Stage</label>
                    <select name="status" class="admin-form-control" required>
                        <option value="new" @selected($lead->status == 'new')>🔴 New</option>
                        <option value="contacted" @selected($lead->status == 'contacted')>🟡 Contacted</option>
                        <option value="qualified" @selected($lead->status == 'qualified')>🔵 Qualified</option>
                        <option value="converted" @selected($lead->status == 'converted')>🟢 Converted</option>
                        <option value="lost" @selected($lead->status == 'lost')>⚫ Lost</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Assign Consultant</label>
                    <select name="assigned_to" class="admin-form-control">
                        <option value="">— Unassigned —</option>
                        @foreach($consultants as $con)
                        <option value="{{ $con->id }}" @selected($lead->assigned_to == $con->id)>{{ $con->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Follow-up Notes</label>
                    <textarea name="notes" class="admin-form-control" rows="5" placeholder="Add notes, call logs, follow-ups...">{{ $lead->notes }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
