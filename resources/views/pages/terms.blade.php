@extends('layouts.app')
@section('title', 'Terms of Service')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Terms of Service</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Terms of Service</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width:800px;">
        <div class="form-card" style="text-align:left; line-height:1.8;">
            <p>Last updated: July 2026</p>
            <h3 style="margin-top:20px; margin-bottom:10px;">1. Terms</h3>
            <p>By accessing the website at NV Visa Consultancy, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws.</p>
            
            <h3 style="margin-top:20px; margin-bottom:10px;">2. Use License</h3>
            <p>Permission is granted to temporarily download one copy of the materials (information or software) on NV Visa Consultancy's website for personal, non-commercial transitory viewing only.</p>

            <h3 style="margin-top:20px; margin-bottom:10px;">3. Disclaimer</h3>
            <p>The materials on NV Visa Consultancy's website are provided on an 'as is' basis. NV Visa Consultancy makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
        </div>
    </div>
</section>
@endsection
