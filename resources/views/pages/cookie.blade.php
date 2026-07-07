@extends('layouts.app')
@section('title', 'Cookie Policy')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Cookie Policy</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Cookie Policy</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width:800px;">
        <div class="form-card" style="text-align:left; line-height:1.8;">
            <p>Last updated: July 2026</p>
            <h3 style="margin-top:20px; margin-bottom:10px;">1. What Are Cookies</h3>
            <p>Cookies are small pieces of text sent by your web browser by a website you visit. A cookie file is stored in your web browser and allows the Service or a third-party to recognize you and make your next visit easier and the Service more useful to you.</p>
            
            <h3 style="margin-top:20px; margin-bottom:10px;">2. How We Use Cookies</h3>
            <p>We use cookies to enable certain functions of the Service, to provide analytics, to store your preferences, and to enable advertisements delivery, including behavioral advertising.</p>

            <h3 style="margin-top:20px; margin-bottom:10px;">3. Secure Session Cookies</h3>
            <p>The client portal uses secure session tokens to keep you logged into the application tracker. Clearing your browser cookies will require you to log back into the system.</p>
        </div>
    </div>
</section>
@endsection
