@extends('admin.layout')
@section('title', 'Edit Article')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Edit Blog Article <small>Update immigration news, guides, and updates</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Articles</a>
    </div>
</div>

<div class="data-card" style="max-width:800px;">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-edit"></i> Article Content</div>
    </div>
    <div class="data-card-body">
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="admin-form-grid">
                <div class="admin-form-group full">
                    <label>Article Title *</label>
                    <input type="text" name="title" class="admin-form-control" placeholder="e.g. Canada Express Entry Draw 2025 Update" value="{{ old('title', $blog->title) }}" required>
                </div>
                <div class="admin-form-group">
                    <label>Category</label>
                    <select name="category" class="admin-form-control">
                        <option value="">— Select Category —</option>
                        <option value="news" {{ (old('category', '') == 'news') ? 'selected' : '' }}>Immigration News</option>
                        <option value="guide" {{ (old('category', '') == 'guide') ? 'selected' : '' }}>Visa Guide</option>
                        <option value="tips" {{ (old('category', '') == 'tips') ? 'selected' : '' }}>Tips & Advice</option>
                        <option value="update" {{ (old('category', '') == 'update') ? 'selected' : '' }}>Policy Update</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Status</label>
                    <select name="status" class="admin-form-control">
                        <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="admin-form-group full">
                    <label>Excerpt / Summary</label>
                    <textarea name="excerpt" class="admin-form-control" rows="2" placeholder="Short description shown in blog listing...">{{ old('excerpt', $blog->excerpt) }}</textarea>
                </div>
                <div class="admin-form-group full">
                    <label>Body Content (HTML allowed) *</label>
                    <textarea name="content" class="admin-form-control" rows="14" placeholder="Write full article content here..." required>{{ old('content', $blog->content) }}</textarea>
                </div>
                <div class="admin-form-group full">
                    <label>Featured Image URL</label>
                    <input type="text" name="image" class="admin-form-control" placeholder="https://... or leave blank" value="{{ old('image', $blog->featured_image) }}">
                </div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Update Article</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
