@extends('admin.layout')
@section('title', 'Add Banner')

@section('content')
<div class="admin-page-header">
    <div>
        <a href="{{ route('admin.banners.index') }}" class="back-link"><i class="fas fa-arrow-left"></i> Back to Banners</a>
        <h1 class="admin-page-title">Add New Banner</h1>
    </div>
</div>

<div class="data-card" style="max-width: 800px;">
    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="admin-form-group">
            <label>Title</label>
            <input type="text" name="title" class="admin-form-control" value="{{ old('title') }}" placeholder="e.g. Immigration Services">
            @error('title')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        
        <div class="admin-form-group">
            <label>Subtitle / Text</label>
            <input type="text" name="subtitle" class="admin-form-control" value="{{ old('subtitle') }}" placeholder="e.g. From Expert Adviser">
            @error('subtitle')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        
        <div class="admin-form-group">
            <label>Banner Image *</label>
            <input type="file" name="image" class="admin-form-control" accept="image/*" required style="padding:8px 12px;" onchange="if(this.files[0].size > 5242880){alert('File is too big! Max size is 5MB.'); this.value='';}">
            <small style="color:var(--admin-muted); display:block; margin-top:4px;">Recommended size: 1920x800px. JPG, PNG, WEBP (Max 5MB).</small>
            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="admin-form-group">
            <label>Button Text (Optional)</label>
            <input type="text" name="button_text" class="admin-form-control" value="{{ old('button_text') }}" placeholder="e.g. Book Free Consultation">
            @error('button_text')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="admin-form-group">
            <label>Button Link (Optional)</label>
            <input type="text" name="button_link" class="admin-form-control" value="{{ old('button_link') }}" placeholder="e.g. /book-consultation">
            @error('button_link')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        
        <div class="admin-form-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="admin-form-group">
                <label>Order</label>
                <input type="number" name="order" class="admin-form-control" value="{{ old('order', 0) }}">
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <div style="display:flex; align-items:center; gap:10px; margin-top:10px;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width:20px; height:20px;">
                    <label for="is_active" style="margin:0; cursor:pointer;">Active</label>
                </div>
            </div>
        </div>
        
        <div class="form-actions" style="margin-top:30px; border-top:1px solid #e2e8f0; padding-top:20px;">
            <button type="submit" class="btn btn-primary">Save Banner</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
