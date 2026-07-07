@extends('layouts.app')
@section('title', 'My Uploaded Documents')

@section('content')
<section class="page-header" style="padding: 40px 0;">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; text-align:left;">
        <div>
            <h1 style="font-size:28px; margin:0;">Documents Locker</h1>
            <p style="color:rgba(255,255,255,0.7); margin:0;">Upload your passport, academic transcripts, and professional files securely.</p>
        </div>
        <div>
            <a href="{{ route('client.dashboard') }}" class="btn-topbar"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div style="display:grid; grid-template-columns: 280px 1fr; gap:30px; align-items:flex-start;">
            
            <!-- Dashboard Sidebar -->
            <div class="form-card" style="padding: 20px;">
                <h4 style="margin-bottom:15px; font-size:14px; text-transform:uppercase; color:var(--text-muted);">Client Menu</h4>
                <ul style="list-style:none; padding:0; display:flex; flex-direction:column; gap:10px;">
                    <li>
                        <a href="{{ route('client.dashboard') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-chart-line"></i> Dashboard Overview
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.applications') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-folder-open"></i> My Applications
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.appointments') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-calendar-alt"></i> My Appointments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.documents') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; background:rgba(11, 61, 145, 0.05); color:var(--primary-color); border-radius:8px; font-weight:600;">
                            <i class="fas fa-file-signature"></i> Uploaded Documents
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.invoices') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-file-invoice-dollar"></i> Receipts & Invoices
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.profile') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-user-cog"></i> Account Settings
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content Area -->
            <div>
                <!-- Upload form -->
                <div class="form-card" style="margin-bottom:30px;">
                    <h3><i class="fas fa-cloud-upload-alt"></i> Upload New Document</h3>
                    <p style="color:var(--text-muted); font-size:14px; margin-bottom:20px;">Accepted formats: PDF, JPG, PNG (Max 5MB per file).</p>
                    
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="document_type">Document Type *</label>
                                <select name="document_type" id="document_type" class="form-control" required>
                                    <option value="passport">Passport Bio Page</option>
                                    <option value="resume">Professional Resume / CV</option>
                                    <option value="ielts">IELTS / PTE / English Score Card</option>
                                    <option value="academic">Academic Transcripts / Degree</option>
                                    <option value="experience">Experience Letters</option>
                                    <option value="other">Other Supporting Documents</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="document_file">Select File *</label>
                                <input type="file" name="document_file" id="document_file" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-primary" style="border:none;">Upload Securely <i class="fas fa-shield-alt"></i></button>
                    </form>
                </div>

                <!-- Document Checklist -->
                <div class="form-card">
                    <h3>Uploaded Files Locker</h3>
                    <div style="display:flex; flex-direction:column; gap:15px; margin-top:20px;">
                        @forelse($documents as $doc)
                        <div style="display:flex; justify-content:space-between; align-items:center; border:1px solid var(--border-color); padding:15px 20px; border-radius:8px;">
                            <div>
                                <strong style="color:var(--primary-color);">{{ $doc->name }}</strong>
                                <div style="font-size:12px; color:var(--text-muted);">Uploaded on: {{ $doc->created_at->format('d M Y') }}</div>
                            </div>
                            <div style="display:flex; align-items:center; gap:15px;">
                                <span class="btn-topbar" style="background:@if($doc->status == 'approved') #1e7e34 @else #d4af37 @endif; font-size:12px; border-radius:4px; padding:3px 8px;">
                                    {{ strtoupper($doc->status) }}
                                </span>
                                <a href="#" style="color:var(--primary-color);"><i class="fas fa-download"></i></a>
                            </div>
                        </div>
                        @empty
                        <div style="text-align:center; color:var(--text-muted); padding:20px;">
                            <i class="fas fa-file-invoice" style="font-size:40px; opacity:0.1; margin-bottom:10px;"></i>
                            <p>No documents uploaded yet.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
