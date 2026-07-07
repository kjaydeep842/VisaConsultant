@extends('admin.layout')
@section('title', 'Upload Gallery Image')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Upload Gallery Image <small>Add a new photo to the customer gallery page</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.gallery.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-image"></i> Photo Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="admin-form-group">
                <label>Title / Heading *</label>
                <input type="text" name="title" class="admin-form-control" placeholder="e.g. Canada PR Success Celebration" required>
            </div>
            
            <div class="admin-form-group">
                <label>Select Image *</label>
                <input type="file" name="image" class="admin-form-control" required style="padding:8px 12px;">
                <small style="color:var(--admin-muted); display:block; margin-top:4px;">Supported formats: JPEG, PNG, JPG, WEBP. Max size: 5MB.</small>
            </div>

            <div class="admin-form-group">
                <label>Description *</label>
                <textarea name="description" class="admin-form-control" rows="5" placeholder="Enter brief details or stories about this photo..." required></textarea>
            </div>

            <div class="admin-form-grid">
                <div class="admin-form-group">
                    <label>Category</label>
                    <select name="category" class="admin-form-control">
                        <option value="Seminars">Seminars</option>
                        <option value="Celebrations">Celebrations</option>
                        <option value="Events">Events</option>
                        <option value="General">General</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" class="admin-form-control" value="0" min="0">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Link to Country (Optional)</label>
                <select name="country_id" class="admin-form-control">
                    <option value="">-- No Specific Country --</option>
                    @foreach($countries as $cty)
                        <option value="{{ $cty->id }}">{{ $cty->name }}</option>
                    @endforeach
                </select>
                <small style="color:var(--admin-muted); display:block; margin-top:4px;">If selected, this image will also appear on the country details page.</small>
            </div>

            <div class="admin-form-group" style="display:flex; align-items:center; gap:10px; margin-top:15px; margin-bottom:20px;">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked style="width:20px; height:20px;">
                <label for="is_active" style="margin:0; cursor:pointer;">Publish Immediately (Visible on Front Page)</label>
            </div>

            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload Image</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
