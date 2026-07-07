@extends('admin.layout')
@section('title', 'Add News')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Add News Article <small>Publish immigration news and policy updates</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.news.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:800px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-bullhorn"></i> Article Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.news.store') }}" method="POST">
            @csrf
            <div class="admin-form-group"><label>Headline *</label><input type="text" name="title" class="admin-form-control" required placeholder="e.g. Canada Announces New Express Entry Draws"></div>
            <div class="admin-form-group"><label>Short Summary</label><textarea name="excerpt" class="admin-form-control" rows="2" placeholder="Brief overview shown in news listing..."></textarea></div>
            <div class="admin-form-group"><label>Full Content *</label><textarea name="content" class="admin-form-control" rows="12" required placeholder="Full news article content..."></textarea></div>
            <div class="admin-form-grid">
                <div class="admin-form-group"><label>Status</label><select name="status" class="admin-form-control"><option value="published">Published</option><option value="draft">Draft</option></select></div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Publish News</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
