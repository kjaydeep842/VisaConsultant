@extends('admin.layout')
@section('title', 'Team')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Team Members <small>Manage consultants and staff profiles</small></h1></div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.team.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Member</a>
    </div>
</div>
<div class="data-card">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-users"></i> All Team Members</div></div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Member</th><th>Designation</th><th>Contact</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($members as $m)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            @if($m->avatar)
                                <img src="{{ $m->avatar }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;" alt="{{ $m->name }}">
                            @else
                                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#0B3D91,#00A4E4);color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;">{{ strtoupper(substr($m->name,0,2)) }}</div>
                            @endif
                            <strong>{{ $m->name }}</strong>
                        </div>
                    </td>
                    <td>{{ $m->designation }}</td>
                    <td>
                        <div style="font-size:12px;">{{ $m->email }}</div>
                        <div style="font-size:11px;color:var(--admin-muted);">{{ $m->phone }}</div>
                    </td>
                    <td><span class="badge badge-{{ $m->status == 'active' ? 'active' : 'pending' }}">{{ $m->status }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.team.edit', $m->id) }}" class="btn btn-sm btn-outline btn-icon"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="confirmAndSubmitDelete('{{ route('admin.team.destroy', $m->id) }}', 'Remove this team member?')" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="5"><i class="fas fa-users" style="font-size:24px;display:block;margin-bottom:8px;"></i>No team members added yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($members->hasPages())<div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $members->links() }}</div>@endif
</div>
@endsection
