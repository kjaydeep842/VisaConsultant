@extends('layouts.app')
@section('title', 'Your Immigration Assessment Result')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Your Eligibility Assessment Result</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <a href="{{ route('assessment.index') }}">Calculator</a> / <span>Result</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 700px;">
        <div class="form-card text-center" style="border-top: 5px solid @if($score >= 70) #1e7e34 @elseif($score >= 50) #0B3D91 @else #d4af37 @endif;">
            
            <div style="width: 130px; height: 130px; border-radius: 50%; border: 8px solid rgba(11, 61, 145, 0.05); display: flex; align-items:center; justify-content:center; margin: 0 auto 25px;">
                <div style="font-size: 36px; font-weight: 800; color: var(--primary-color);">{{ $score }}<span style="font-size:16px;">/100</span></div>
            </div>

            <h2 style="margin-bottom: 10px;">Status: {{ $recommendation['level'] }}</h2>
            <p style="margin-bottom: 25px;">{{ $recommendation['message'] }}</p>

            <div style="text-align: left; background: var(--bg-light); border-radius: var(--border-radius); padding: 25px; margin-bottom: 30px;">
                <h4 style="margin-bottom: 15px; color: var(--primary-dark);"><i class="fas fa-route"></i> Recommended Immigration Pathways:</h4>
                <ul style="list-style: none; padding-left: 0; display:flex; flex-direction:column; gap:10px;">
                    @foreach($recommendation['visa_types'] as $visa)
                        <li style="display:flex; align-items:center; gap:10px;">
                            <i class="fas fa-check-circle" style="color: var(--secondary-color);"></i>
                            <strong>{{ $visa }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div style="display:flex; flex-direction:column; gap:12px;">
                <a href="{{ route('appointment.index') }}" class="btn-primary" style="display:block; text-align:center;">
                    <i class="fas fa-calendar-check"></i> {{ $recommendation['recommended_action'] }}
                </a>
                <a href="{{ route('assessment.index') }}" class="btn-outline" style="display:block; text-align:center;">
                    <i class="fas fa-redo"></i> Check Again
                </a>
            </div>

            <p style="margin-top: 25px; font-size:12px; color: var(--text-muted);">
                * This is a preliminary estimation based on self-reported inputs. A formal verification of IELTS, ECA reports and proof of experience is required to finalize your case.
            </p>
        </div>
    </div>
</section>
@endsection
