@extends('admin.layout')
@section('title', 'Users')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">User Management <small>Manage roles, permissions, and account access</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add User</a>
    </div>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-users-cog"></i> All Users</div>
        <span style="font-size:12px;color:var(--admin-muted);">{{ $users->total() }} registered users</span>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#0B3D91,#00A4E4);color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($user->name,0,2)) }}
                            </div>
                            <strong>{{ $user->name }}</strong>
                        </div>
                    </td>
                    <td style="font-size:13px;">{{ $user->email }}</td>
                    <td style="font-size:13px;">{{ $user->phone ?? '—' }}</td>
                    <td>
                        <span class="badge" style="background:@if($user->role=='admin'||$user->role=='superadmin') rgba(11,61,145,0.1);color:#0B3D91 @elseif($user->role=='consultant') rgba(0,164,228,0.1);color:#0077b6 @else rgba(100,116,139,0.1);color:#475569 @endif;">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge @if($user->status=='active') badge-active @elseif($user->status=='inactive') badge-pending @else badge-rejected @endif">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td style="font-size:12px;color:var(--admin-muted);">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" style="display:flex;gap:6px;align-items:center;">
                            @csrf @method('PUT')
                            <select name="role" class="admin-form-control" style="padding:5px 8px;font-size:11px;min-width:100px;">
                                <option value="client" @selected($user->role=='client')>Client</option>
                                <option value="consultant" @selected($user->role=='consultant')>Consultant</option>
                                <option value="admin" @selected($user->role=='admin')>Admin</option>
                                <option value="superadmin" @selected($user->role=='superadmin')>Superadmin</option>
                            </select>
                            <select name="status" class="admin-form-control" style="padding:5px 8px;font-size:11px;min-width:90px;">
                                <option value="active" @selected($user->status=='active')>Active</option>
                                <option value="inactive" @selected($user->status=='inactive')>Inactive</option>
                                <option value="banned" @selected($user->status=='banned')>Banned</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary btn-icon" title="Save"><i class="fas fa-check"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="7"><i class="fas fa-users" style="font-size:24px;display:block;margin-bottom:8px;"></i>No users registered yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $users->links() }}</div>
    @endif
</div>
@endsection
