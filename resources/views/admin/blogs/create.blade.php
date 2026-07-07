@extends('admin.layout')
@section('title', 'Write Article')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">New Blog Article <small>Publish immigration news, guides, and updates</small></h1>
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
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="admin-form-grid">
                <div class="admin-form-group full">
                    <label>Article Title *</label>
                    <input type="text" name="title" class="admin-form-control" placeholder="e.g. Canada Express Entry Draw 2025 Update" value="{{ old('title') }}" required>
                </div>
                <div class="admin-form-group">
                    <label>Category</label>
                    <select name="category" class="admin-form-control">
                        <option value="">— Select Category —</option>
                        <option value="news">Immigration News</option>
                        <option value="guide">Visa Guide</option>
                        <option value="tips">Tips & Advice</option>
                        <option value="update">Policy Update</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Status</label>
                    <select name="status" class="admin-form-control">
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="admin-form-group full">
                    <label>Excerpt / Summary</label>
                    <textarea name="excerpt" class="admin-form-control" rows="2" placeholder="Short description shown in blog listing...">{{ old('excerpt') }}</textarea>
                </div>
                <div class="admin-form-group full">
                    <label>Body Content (HTML allowed) *</label>
                    <textarea name="content" class="admin-form-control" rows="14" placeholder="Write full article content here..." required>{{ old('content') }}</textarea>
                </div>
                <div class="admin-form-group full">
                    <label>Featured Image URL</label>
                    <input type="text" name="image" class="admin-form-control" placeholder="https://... or leave blank" value="{{ old('image') }}">
                </div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Publish Article</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
