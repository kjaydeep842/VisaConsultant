@extends('admin.layout')
@section('title', 'Add Team Member')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Add Team Member <small>Add a consultant or staff profile</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.team.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-user-plus"></i> Member Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.team.store') }}" method="POST">
            @csrf
            <div class="admin-form-grid">
                <div class="admin-form-group"><label>Full Name *</label><input type="text" name="name" class="admin-form-control" required placeholder="Dr. Sarah Johnson"></div>
                <div class="admin-form-group"><label>Designation *</label><input type="text" name="designation" class="admin-form-control" required placeholder="Senior Immigration Consultant"></div>
                <div class="admin-form-group"><label>Email</label><input type="email" name="email" class="admin-form-control" placeholder="sarah@nvvisa.com"></div>
                <div class="admin-form-group"><label>Phone</label><input type="text" name="phone" class="admin-form-control" placeholder="+91 98765 43210"></div>
                <div class="admin-form-group full"><label>Bio / Description</label><textarea name="bio" class="admin-form-control" rows="3" placeholder="Brief professional background..."></textarea></div>
                <div class="admin-form-group"><label>Avatar URL</label><input type="text" name="avatar" class="admin-form-control" placeholder="https://..."></div>
                <div class="admin-form-group"><label>LinkedIn URL</label><input type="text" name="linkedin" class="admin-form-control" placeholder="https://linkedin.com/in/..."></div>
                <div class="admin-form-group"><label>Sort Order</label><input type="number" name="sort_order" class="admin-form-control" value="0"></div>
                <div class="admin-form-group"><label>Status</label><select name="status" class="admin-form-control"><option value="active">Active</option><option value="inactive">Hidden</option></select></div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Add Member</button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
