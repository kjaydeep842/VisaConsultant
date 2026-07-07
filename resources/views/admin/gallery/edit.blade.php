@extends('admin.layout')
@section('title', 'Edit Gallery Image')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Edit Gallery Image <small>Update photo details or change image file</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.gallery.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-edit"></i> Edit Photo details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.gallery.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="admin-form-group">
                <label>Title / Heading *</label>
                <input type="text" name="title" class="admin-form-control" value="{{ $item->title }}" required>
            </div>
            
            <div class="admin-form-group">
                <label>Current Image</label>
                @if($item->image)
                    <div style="margin-bottom:10px;">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="max-width:100%; max-height:200px; border-radius: var(--border-radius); border:1px solid #e2e8f0;">
                    </div>
                @endif
                <label>Change Image (Optional)</label>
                <input type="file" name="image" class="admin-form-control" style="padding:8px 12px;">
                <small style="color:var(--admin-muted); display:block; margin-top:4px;">Leave blank to keep existing image. Supported: JPEG, PNG, JPG, WEBP.</small>
            </div>

            <div class="admin-form-group">
                <label>Description *</label>
                <textarea name="description" class="admin-form-control" rows="5" required>{{ $item->description }}</textarea>
            </div>

            <div class="admin-form-grid">
                <div class="admin-form-group">
                    <label>Category</label>
                    <select name="category" class="admin-form-control">
                        <option value="Seminars" {{ $item->category == 'Seminars' ? 'selected' : '' }}>Seminars</option>
                        <option value="Celebrations" {{ $item->category == 'Celebrations' ? 'selected' : '' }}>Celebrations</option>
                        <option value="Events" {{ $item->category == 'Events' ? 'selected' : '' }}>Events</option>
                        <option value="General" {{ $item->category == 'General' ? 'selected' : '' }}>General</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" class="admin-form-control" value="{{ $item->sort_order }}" min="0">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Link to Country (Optional)</label>
                <select name="country_id" class="admin-form-control">
                    <option value="">-- No Specific Country --</option>
                    @foreach($countries as $cty)
                        <option value="{{ $cty->id }}" {{ $item->country_id == $cty->id ? 'selected' : '' }}>{{ $cty->name }}</option>
                    @endforeach
                </select>
                <small style="color:var(--admin-muted); display:block; margin-top:4px;">If selected, this image will also appear on the country details page.</small>
            </div>

            <div class="admin-form-group" style="display:flex; align-items:center; gap:10px; margin-top:15px; margin-bottom:20px;">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $item->is_active ? 'checked' : '' }} style="width:20px; height:20px;">
                <label for="is_active" style="margin:0; cursor:pointer;">Visible on Front Page</label>
            </div>

            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
