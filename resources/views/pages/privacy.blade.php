@extends('layouts.app')
@section('title', 'Privacy Policy')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Privacy Policy</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Privacy Policy</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width:800px;">
        <div class="form-card" style="text-align:left; line-height:1.8;">
            <p>Last updated: July 2026</p>
            <h3 style="margin-top:20px; margin-bottom:10px;">1. Information We Collect</h3>
            <p>We collect personal information that you voluntarily provide to us when you register on the portal, express an interest in obtaining information about us or our services, or calculate your visa eligibility points.</p>
            
            <h3 style="margin-top:20px; margin-bottom:10px;">2. How We Use Your Information</h3>
            <p>We use personal information collected via our website for a variety of business purposes, including processing your visa application, scheduling consultant meetings, responding to inquiries, and keeping you informed about global immigration updates.</p>

            <h3 style="margin-top:20px; margin-bottom:10px;">3. Document Encryption & Security</h3>
            <p>All sensitive documents (including Passports, Resumes, and Financial Statements) uploaded through our Client Dashboard are fully encrypted at rest and in transit. Access is limited strictly to your assigned Case Consultant.</p>
        </div>
    </div>
</section>
@endsection
