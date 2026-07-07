@extends('admin.layout')
@section('title', 'Add User')
@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Add User <small>Create a new user account</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.users.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:600px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-user-plus"></i> User Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="admin-form-group"><label>Full Name *</label><input type="text" name="name" class="admin-form-control" required></div>
            <div class="admin-form-group"><label>Email *</label><input type="email" name="email" class="admin-form-control" required></div>
            <div class="admin-form-group"><label>Phone</label><input type="text" name="phone" class="admin-form-control"></div>
            <div class="admin-form-grid">
                <div class="admin-form-group"><label>Role</label><select name="role" class="admin-form-control"><option value="client">Client</option><option value="consultant">Consultant</option><option value="admin">Admin</option></select></div>
                <div class="admin-form-group"><label>Status</label><select name="status" class="admin-form-control"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
            </div>
            <div class="admin-form-group"><label>Password *</label><input type="password" name="password" class="admin-form-control" required></div>
            <div style="margin-top:8px;"><button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> Create User</button></div>
        </form>
    </div>
</div>
@endsection
