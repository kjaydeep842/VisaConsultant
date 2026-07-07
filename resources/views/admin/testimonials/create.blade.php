@extends('admin.layout')
@section('title', 'Add Testimonial')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Add Testimonial <small>Add a client review or success story</small></h1></div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-star"></i> Testimonial Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.testimonials.store') }}" method="POST">
            @csrf
            <div class="admin-form-grid">
                <div class="admin-form-group"><label>Client Name *</label><input type="text" name="name" class="admin-form-control" placeholder="John Smith" required></div>
                <div class="admin-form-group"><label>Country *</label><input type="text" name="country" class="admin-form-control" placeholder="India → Canada" required></div>
                <div class="admin-form-group"><label>Visa Type</label><input type="text" name="visa_type" class="admin-form-control" placeholder="e.g. Permanent Residency"></div>
                <div class="admin-form-group">
                    <label>Rating (1-5) *</label>
                    <select name="rating" class="admin-form-control" required>
                        <option value="5">⭐⭐⭐⭐⭐ 5 Stars</option>
                        <option value="4">⭐⭐⭐⭐ 4 Stars</option>
                        <option value="3">⭐⭐⭐ 3 Stars</option>
                    </select>
                </div>
                <div class="admin-form-group full"><label>Review Message *</label><textarea name="message" class="admin-form-control" rows="4" required placeholder="Client's experience..."></textarea></div>
                <div class="admin-form-group"><label>Avatar URL</label><input type="text" name="avatar" class="admin-form-control" placeholder="https://..."></div>
                <div class="admin-form-group"><label>Status</label><select name="status" class="admin-form-control"><option value="published">Published</option><option value="draft">Draft</option></select></div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Testimonial</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
