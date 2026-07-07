@extends('admin.layout')
@section('title', 'Add Visa Category')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Add Visa Category <small>Create a new visa type or service</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.visa-categories.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:600px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-id-card"></i> Category Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.visa-categories.store') }}" method="POST">
            @csrf
            <div class="admin-form-group"><label>Category Name *</label><input type="text" name="name" class="admin-form-control" placeholder="e.g. Student Visa" required></div>
            <div class="admin-form-group"><label>Font Awesome Icon Class</label><input type="text" name="icon" class="admin-form-control" placeholder="fas fa-graduation-cap" value="fas fa-id-card"></div>
            <div class="admin-form-group"><label>Description</label><textarea name="description" class="admin-form-control" rows="4" placeholder="Brief description of this visa category..."></textarea></div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Category</button>
                <a href="{{ route('admin.visa-categories.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
