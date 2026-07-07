@extends('admin.layout')
@section('title', 'Add Lead')
@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Add Lead <small>Manually add a lead to the pipeline</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.leads.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-user-tag"></i> Lead Information</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.leads.store') }}" method="POST">
            @csrf
            <div class="admin-form-grid">
                <div class="admin-form-group"><label>Full Name *</label><input type="text" name="name" class="admin-form-control" required></div>
                <div class="admin-form-group"><label>Email *</label><input type="email" name="email" class="admin-form-control" required></div>
                <div class="admin-form-group"><label>Phone *</label><input type="text" name="phone" class="admin-form-control" required></div>
                <div class="admin-form-group"><label>Destination Country</label><input type="text" name="country_interested" class="admin-form-control" placeholder="e.g. Canada"></div>
                <div class="admin-form-group"><label>Visa Type</label><input type="text" name="visa_type" class="admin-form-control" placeholder="e.g. PR, Student, Work"></div>
                <div class="admin-form-group"><label>Source</label><select name="source" class="admin-form-control"><option value="website">Website</option><option value="referral">Referral</option><option value="social_media">Social Media</option><option value="walk_in">Walk In</option><option value="other">Other</option></select></div>
                <div class="admin-form-group full"><label>Notes</label><textarea name="notes" class="admin-form-control" rows="3" placeholder="Initial discussion notes..."></textarea></div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Add Lead</button>
                <a href="{{ route('admin.leads.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
