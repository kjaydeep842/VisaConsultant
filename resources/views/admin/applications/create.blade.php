@extends('admin.layout')
@section('title', 'New Application')
@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">New Application <small>Create a manual application record</small></h1></div>
    <div class="admin-page-actions"><a href="{{ route('admin.applications.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a></div>
</div>
<div class="data-card" style="max-width:680px;">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-folder-plus"></i> Application Details</div></div>
    <div class="data-card-body">
        <form action="{{ route('admin.applications.store') }}" method="POST">
            @csrf
            <div class="admin-form-group"><label>Applicant Name *</label><input type="text" name="applicant_name" class="admin-form-control" required></div>
            <div class="admin-form-group"><label>Passport Number</label><input type="text" name="passport_number" class="admin-form-control"></div>
            <div class="admin-form-group"><label>Status</label><select name="status" class="admin-form-control"><option value="submitted">Submitted</option><option value="under_review">Under Review</option><option value="processing">Processing</option></select></div>
            <div style="margin-top:8px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Application</button></div>
        </form>
    </div>
</div>
@endsection
