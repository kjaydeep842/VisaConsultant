@extends('admin.layout')
@section('title', 'Applications')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Applications & Cases <small>Track immigration applications and documents</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.applications.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Application</a>
    </div>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-folder-open"></i> All Applications</div>
        <span style="font-size:12px;color:var(--admin-muted);">{{ $applications->total() }} total cases</span>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>App ID</th>
                    <th>Applicant</th>
                    <th>Country</th>
                    <th>Visa Category</th>
                    <th>Current Stage</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                <tr>
                    <td><code style="background:#f1f5f9;padding:3px 8px;border-radius:4px;font-size:12px;">{{ $app->application_id }}</code></td>
                    <td>
                        <div style="font-weight:600;">{{ $app->applicant_name }}</div>
                        <div style="font-size:11px;color:var(--admin-muted);">{{ $app->passport_number }}</div>
                    </td>
                    <td>{{ optional($app->country)->name ?? '—' }}</td>
                    <td>{{ optional($app->visaCategory)->name ?? '—' }}</td>
                    <td>
                        <span style="font-size:12px;background:#f1f5f9;padding:3px 8px;border-radius:4px;">
                            {{ $app->current_stage ?? 'In Progress' }}
                        </span>
                    </td>
                    <td><span class="badge badge-{{ $app->status }}">{{ str_replace('_',' ',$app->status) }}</span></td>
                    <td style="font-size:12px;color:var(--admin-muted);">{{ $app->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.applications.show', $app->id) }}" class="btn btn-sm btn-outline btn-icon" title="Manage"><i class="fas fa-cog"></i></a>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="8"><i class="fas fa-folder-open" style="font-size:24px;display:block;margin-bottom:8px;"></i>No applications filed yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($applications->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $applications->links() }}</div>
    @endif
</div>
@endsection
