@extends('layouts.app')
@section('title', 'Refund Policy')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Refund Policy</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Refund Policy</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width:800px;">
        <div class="form-card" style="text-align:left; line-height:1.8;">
            <p>Last updated: July 2026</p>
            <h3 style="margin-top:20px; margin-bottom:10px;">1. Initial Consultation Fee</h3>
            <p>The fee charged for the initial eligibility assessment and consultant matchmaking session is non-refundable once the session has been scheduled and confirmed by our system.</p>
            
            <h3 style="margin-top:20px; margin-bottom:10px;">2. Retainer Agreements</h3>
            <p>Immigration retainer fees are deposited in a client trust account. Refunds for active cases are calculated pro-rata based on the milestones achieved (e.g. ECA complete, profile entry, embassy submission) in accordance with the signed retainer agreement.</p>

            <h3 style="margin-top:20px; margin-bottom:10px;">3. Process Failures</h3>
            <p>NV Visa Consultancy does not guarantee visa approvals as decision-making authority rests solely with the respective embassies and high commissions. No refunds will be issued for rejections arising from misrepresentation or medical/security grounds.</p>
        </div>
    </div>
</section>
@endsection
