@extends('admin.layout')
@section('title', 'Lead Pipeline')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Lead Pipeline CRM <small>Assign agents and track conversions</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.leads.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Lead</a>
    </div>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-user-tag"></i> All Leads</div>
        <span style="font-size:12px;color:var(--admin-muted);">{{ $leads->total() }} total leads</span>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Lead</th>
                    <th>Contact</th>
                    <th>Destination / Visa</th>
                    <th>Source</th>
                    <th>Assigned Agent</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                <tr>
                    <td>
                        <div style="font-weight:600;color:var(--admin-text);">{{ $lead->name }}</div>
                        <div style="font-size:11px;color:var(--admin-muted);">{{ $lead->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        <div style="font-size:13px;">{{ $lead->email }}</div>
                        <div style="font-size:12px;color:var(--admin-muted);">{{ $lead->phone }}</div>
                    </td>
                    <td>
                        <div style="font-size:13px;font-weight:600;">{{ $lead->country_interested ?? '—' }}</div>
                        <div style="font-size:11px;color:var(--admin-muted);">{{ $lead->visa_type ?? '—' }}</div>
                    </td>
                    <td>
                        <span style="font-size:12px;text-transform:capitalize;background:#f1f5f9;padding:3px 8px;border-radius:4px;">
                            {{ str_replace('_', ' ', $lead->source) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.leads.assign', $lead->id) }}" method="POST">
                            @csrf
                            <select name="assigned_to" onchange="this.form.submit()" class="admin-form-control" style="padding:6px 10px;font-size:12px;">
                                <option value="">Unassigned</option>
                                @foreach($consultants as $con)
                                <option value="{{ $con->id }}" @selected($lead->assigned_to == $con->id)>{{ $con->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td><span class="badge badge-{{ $lead->status }}">{{ $lead->status }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.leads.show', $lead->id) }}" class="btn btn-sm btn-outline btn-icon" title="View"><i class="fas fa-eye"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="confirmAndSubmitDelete('{{ route('admin.leads.destroy', $lead->id) }}', 'Delete this lead?')" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="7"><i class="fas fa-user-tag" style="font-size:24px;display:block;margin-bottom:8px;"></i>No leads in the pipeline yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($leads->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $leads->links() }}</div>
    @endif
</div>
@endsection
