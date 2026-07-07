@extends('admin.layout')
@section('title', 'Application Detail')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">
            Case: {{ $app->application_id }}
            <small>{{ $app->applicant_name }} &nbsp;|&nbsp; Passport: {{ $app->passport_number }}</small>
        </h1>
    </div>
    <div class="admin-page-actions">
        <span class="badge badge-{{ $app->status }}" style="font-size:13px;padding:6px 14px;">{{ str_replace('_',' ',$app->status) }}</span>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> All Cases</a>
    </div>
</div>

<div class="grid-2">
    {{-- Update Status --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-sync-alt"></i> Update Application Status</div>
        </div>
        <div class="data-card-body">
            <form action="{{ route('admin.applications.update', $app->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="admin-form-group">
                    <label>Application Status</label>
                    <select name="status" class="admin-form-control" required>
                        @foreach(['draft','submitted','under_review','documents_required','processing','approved','rejected','on_hold','completed'] as $s)
                        <option value="{{ $s }}" @selected($app->status == $s)>{{ ucwords(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Current Stage Label</label>
                    <input type="text" name="current_stage" class="admin-form-control" value="{{ $app->current_stage }}" placeholder="e.g. Visa Fee Deposited">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                    <i class="fas fa-save"></i> Update Status
                </button>
            </form>
        </div>
    </div>

    {{-- Add Timeline Milestone --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-flag"></i> Log Timeline Milestone</div>
        </div>
        <div class="data-card-body">
            <form action="{{ route('admin.applications.timeline', $app->id) }}" method="POST">
                @csrf
                <div class="admin-form-group">
                    <label>Milestone Title *</label>
                    <input type="text" name="stage" class="admin-form-control" placeholder="e.g. Biometrics Requested" required>
                </div>
                <div class="admin-form-group">
                    <label>Details / Notes</label>
                    <textarea name="description" class="admin-form-control" rows="4" placeholder="Brief explanation of this milestone..."></textarea>
                </div>
                <button type="submit" class="btn btn-secondary" style="width:100%;justify-content:center;">
                    <i class="fas fa-plus"></i> Add Milestone
                </button>
            </form>
        </div>
    </div>
</div>

<div class="grid-2" style="margin-top:0;">
    {{-- Timeline --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-history"></i> Milestones Timeline</div>
        </div>
        <div class="data-card-body">
            <div style="border-left:2px solid var(--admin-secondary);padding-left:20px;margin-left:8px;display:flex;flex-direction:column;gap:20px;">
                @forelse($app->timelines as $t)
                <div style="position:relative;">
                    <span style="position:absolute;left:-27px;top:4px;width:12px;height:12px;border-radius:50%;background:var(--admin-secondary);border:2px solid white;box-shadow:0 0 0 2px var(--admin-secondary);"></span>
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:8px;">
                        <strong style="font-size:14px;">{{ $t->stage }}</strong>
                        <small style="color:var(--admin-muted);white-space:nowrap;font-size:11px;">{{ $t->completed_at ? $t->completed_at->format('d M Y') : '' }}</small>
                    </div>
                    <p style="font-size:13px;color:var(--admin-muted);margin-top:4px;">{{ $t->description }}</p>
                </div>
                @empty
                <p style="color:var(--admin-muted);font-size:13px;">No milestones logged yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Documents --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-folder"></i> Uploaded Documents</div>
        </div>
        <div class="data-card-body">
            <div style="display:flex;flex-direction:column;gap:10px;">
                @forelse($app->documents as $doc)
                <div style="display:flex;justify-content:space-between;align-items:center;background:#f8fafc;padding:12px 14px;border-radius:8px;border:1px solid #e2e8f0;">
                    <div>
                        <div style="font-weight:600;font-size:13px;"><i class="fas fa-file-alt" style="color:var(--admin-primary);margin-right:6px;"></i>{{ $doc->name }}</div>
                        <div style="font-size:11px;color:var(--admin-muted);">Uploaded {{ $doc->created_at->format('d M Y') }}</div>
                    </div>
                    <span class="badge badge-{{ $doc->status }}">{{ $doc->status }}</span>
                </div>
                @empty
                <div style="text-align:center;padding:24px;color:var(--admin-muted);">
                    <i class="fas fa-folder-open" style="font-size:32px;display:block;margin-bottom:8px;opacity:0.3;"></i>
                    No documents uploaded yet
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
