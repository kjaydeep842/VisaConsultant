@extends('admin.layout')
@section('title', 'Edit Testimonial')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Edit Testimonial <small>Edit client review or success story</small></h1></div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-star"></i> Testimonial Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="admin-form-grid">
                <div class="admin-form-group"><label>Client Name *</label><input type="text" name="name" class="admin-form-control" value="{{ $testimonial->name }}" required></div>
                <div class="admin-form-group"><label>Country *</label><input type="text" name="country" class="admin-form-control" value="{{ $testimonial->country }}" required></div>
                <div class="admin-form-group"><label>Visa Type</label><input type="text" name="visa_type" class="admin-form-control" value="{{ $testimonial->visa_type }}"></div>
                <div class="admin-form-group">
                    <label>Rating (1-5) *</label>
                    <select name="rating" class="admin-form-control" required>
                        <option value="5" @selected($testimonial->rating == 5)>⭐⭐⭐⭐⭐ 5 Stars</option>
                        <option value="4" @selected($testimonial->rating == 4)>⭐⭐⭐⭐ 4 Stars</option>
                        <option value="3" @selected($testimonial->rating == 3)>⭐⭐⭐ 3 Stars</option>
                    </select>
                </div>
                <div class="admin-form-group full"><label>Review Message *</label><textarea name="message" class="admin-form-control" rows="4" required>{{ $testimonial->message }}</textarea></div>
                <div class="admin-form-group"><label>Avatar URL</label><input type="text" name="avatar" class="admin-form-control" value="{{ $testimonial->avatar }}"></div>
                <div class="admin-form-group"><label>Status</label><select name="status" class="admin-form-control"><option value="published" @selected($testimonial->status == 'published')>Published</option><option value="draft" @selected($testimonial->status == 'draft')>Draft</option></select></div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
