@extends('admin.layout')
@section('title', 'Edit Visa Category')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Edit Visa Category <small>Edit visa type or service category</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.visa-categories.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:600px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-id-card"></i> Category Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.visa-categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="admin-form-group"><label>Category Name *</label><input type="text" name="name" class="admin-form-control" value="{{ $category->name }}" required></div>
            <div class="admin-form-group"><label>Font Awesome Icon Class</label><input type="text" name="icon" class="admin-form-control" value="{{ $category->icon }}"></div>
            <div class="admin-form-group"><label>Description</label><textarea name="description" class="admin-form-control" rows="4">{{ $category->description }}</textarea></div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                <a href="{{ route('admin.visa-categories.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
