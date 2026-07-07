@extends('admin.layout')
@section('title', 'Add Country')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Add Destination Country <small>Configure a new immigration destination</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.countries.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Countries</a>
    </div>
</div>

<div class="data-card" style="max-width:680px;">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-globe-americas"></i> Country Details</div>
    </div>
    <div class="data-card-body">
        <form action="{{ route('admin.countries.store') }}" method="POST">
            @csrf
            <div class="admin-form-grid">
                <div class="admin-form-group">
                    <label>Country Name *</label>
                    <input type="text" name="name" class="admin-form-control" placeholder="e.g. Ireland" value="{{ old('name') }}" required>
                </div>
                <div class="admin-form-group">
                    <label>ISO 3166 Code *</label>
                    <input type="text" name="code" class="admin-form-control" placeholder="e.g. IE" maxlength="2" value="{{ old('code') }}" required>
                </div>
                <div class="admin-form-group full">
                    <label>Slug (URL path)</label>
                    <input type="text" name="slug" class="admin-form-control" placeholder="e.g. ireland (auto-generated if empty)" value="{{ old('slug') }}">
                </div>
                <div class="admin-form-group full">
                    <label>Immigration Overview *</label>
                    <textarea name="overview" class="admin-form-control" rows="5" placeholder="Describe pathways, opportunities, and requirements..." required>{{ old('overview') }}</textarea>
                </div>
                <div class="admin-form-group full">
                    <label>Processing Time</label>
                    <input type="text" name="processing_time" class="admin-form-control" placeholder="e.g. 2–4 months" value="{{ old('processing_time') }}">
                </div>
                <div class="admin-form-group">
                    <label>Min Investment (optional)</label>
                    <input type="text" name="investment_required" class="admin-form-control" placeholder="e.g. $1,500" value="{{ old('investment_required') }}">
                </div>
                <div class="admin-form-group">
                    <label>Success Rate (optional)</label>
                    <input type="text" name="success_rate" class="admin-form-control" placeholder="e.g. 97%" value="{{ old('success_rate') }}">
                </div>
            </div>
            <div style="margin-top:8px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Country</button>
                <a href="{{ route('admin.countries.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
