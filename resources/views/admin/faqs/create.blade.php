@extends('admin.layout')
@section('title', 'Add FAQ')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Add FAQ <small>Add a new frequently asked question</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.faqs.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-question-circle"></i> FAQ Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div class="admin-form-group"><label>Question *</label><input type="text" name="question" class="admin-form-control" placeholder="What is the processing time for Canada PR?" required></div>
            <div class="admin-form-group"><label>Answer *</label><textarea name="answer" class="admin-form-control" rows="6" required placeholder="Detailed answer..."></textarea></div>
            <div class="admin-form-grid">
                <div class="admin-form-group"><label>Category</label><select name="category" class="admin-form-control"><option value="general">General</option><option value="visa">Visa Process</option><option value="documents">Documents</option><option value="fees">Fees</option><option value="timeline">Timeline</option></select></div>
                <div class="admin-form-group"><label>Sort Order</label><input type="number" name="sort_order" class="admin-form-control" value="0" min="0"></div>
                <div class="admin-form-group"><label>Status</label><select name="status" class="admin-form-control"><option value="active">Active</option><option value="inactive">Hidden</option></select></div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save FAQ</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
