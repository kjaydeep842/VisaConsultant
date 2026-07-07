@extends('admin.layout')
@section('title', 'Edit Team Member')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Edit Team Member <small>Edit consultant or staff profile</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.team.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-user-edit"></i> Member Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.team.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="admin-form-grid">
                <div class="admin-form-group"><label>Full Name *</label><input type="text" name="name" class="admin-form-control" value="{{ $member->name }}" required></div>
                <div class="admin-form-group"><label>Designation *</label><input type="text" name="designation" class="admin-form-control" value="{{ $member->designation }}" required></div>
                <div class="admin-form-group"><label>Email</label><input type="email" name="email" class="admin-form-control" value="{{ $member->email }}"></div>
                <div class="admin-form-group"><label>Phone</label><input type="text" name="phone" class="admin-form-control" value="{{ $member->phone }}"></div>
                <div class="admin-form-group full"><label>Bio / Description</label><textarea name="bio" class="admin-form-control" rows="3">{{ $member->bio }}</textarea></div>
                <div class="admin-form-group"><label>Avatar URL</label><input type="text" name="avatar" class="admin-form-control" value="{{ $member->avatar }}"></div>
                <div class="admin-form-group"><label>LinkedIn URL</label><input type="text" name="linkedin" class="admin-form-control" value="{{ $member->linkedin }}"></div>
                <div class="admin-form-group"><label>Sort Order</label><input type="number" name="sort_order" class="admin-form-control" value="{{ $member->sort_order }}"></div>
                <div class="admin-form-group"><label>Status</label><select name="status" class="admin-form-control"><option value="active" @selected($member->status == 'active')>Active</option><option value="inactive" @selected($member->status == 'inactive')>Hidden</option></select></div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
