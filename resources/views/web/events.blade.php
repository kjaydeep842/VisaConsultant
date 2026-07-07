@extends('layouts.app')
@section('title', 'Upcoming Events')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Immigration Seminars & Webinars</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Events</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Stay Vetted</span>
            <h2 class="section-title">Upcoming Live Seminars</h2>
            <p class="section-subtitle">Reserve your seat for interactive Q&A sessions with our RCIC and MARA registered immigration counsels.</p>
        </div>

        <div class="why-us-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
            @forelse($events as $event)
                <div class="form-card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <div style="margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="background: rgba(11, 61, 145, 0.1); color: var(--primary-color); padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase;">
                                {{ $event->is_online ? 'Webinar (Online)' : 'Physical Seminar' }}
                            </span>
                            @if($event->fee == 0)
                                <span style="color: #2ec4b6; font-weight: 600; font-size: 14px;">FREE</span>
                            @else
                                <span style="color: var(--primary-color); font-weight: 600; font-size: 14px;">₹{{ number_format($event->fee, 0) }}</span>
                            @endif
                        </div>
                        <h3 style="margin: 0 0 10px 0; font-size: 18px; color: var(--text-dark);">{{ $event->title }}</h3>
                        <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 5px;">
                            <i class="far fa-calendar-alt" style="margin-right: 5px; color: var(--primary-color);"></i>
                            {{ $event->event_date->format('M d, Y @ h:i A') }}
                        </p>
                        <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 15px;">
                            <i class="fas fa-map-marker-alt" style="margin-right: 5px; color: var(--primary-color);"></i>
                            {{ $event->is_online ? 'Zoom Meeting' : $event->venue . ', ' . $event->city }}
                        </p>
                        <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                            {{ Str::limit($event->description, 100) }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ $event->is_online ? $event->meeting_link ?? route('contact') : route('contact') }}" target="_blank" class="btn-primary" style="display: block; text-align: center; text-decoration: none; border: none;">
                            Book Seat ({{ $event->seats_available }} Left)
                        </a>
                    </div>
                </div>
            @empty
                @php
                $fakeEvents = [
                    ['title'=>'Canada Express Entry Strategy 2026','type'=>'Webinar','fee'=>'Free','date'=>'July 25, 2026 @ 5:00 PM','loc'=>'Zoom Meeting','desc'=>'Learn how to maximize your CRS score using category-based draws in healthcare, STEM and trades.'],
                    ['title'=>'Study in Europe & Germany Opportunity Card','type'=>'Seminar','fee'=>'Free','date'=>'August 12, 2026 @ 11:00 AM','loc'=>'NV Head Office, Mumbai','desc'=>'Understand Germany Chancenkarte rules and requirements to study and work in high-growth European countries.'],
                    ['title'=>'Australia Subclass GSM Points Audit Q&A','type'=>'Webinar','fee'=>'Free','date'=>'August 28, 2026 @ 4:00 PM','loc'=>'Zoom Meeting','desc'=>'Interactive session to verify subclass points calculations and regional nomination selection targets.']
                ];
                @endphp
                @foreach($fakeEvents as $fe)
                    <div class="form-card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div>
                            <div style="margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="background: rgba(11, 61, 145, 0.1); color: var(--primary-color); padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase;">
                                    {{ $fe['type'] }}
                                </span>
                                <span style="color: #2ec4b6; font-weight: 600; font-size: 14px;">{{ $fe['fee'] }}</span>
                            </div>
                            <h3 style="margin: 0 0 10px 0; font-size: 18px; color: var(--text-dark);">{{ $fe['title'] }}</h3>
                            <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 5px;">
                                <i class="far fa-calendar-alt" style="margin-right: 5px; color: var(--primary-color);"></i>
                                {{ $fe['date'] }}
                            </p>
                            <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 15px;">
                                <i class="fas fa-map-marker-alt" style="margin-right: 5px; color: var(--primary-color);"></i>
                                {{ $fe['loc'] }}
                            </p>
                            <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                                {{ $fe['desc'] }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('contact') }}" class="btn-primary" style="display: block; text-align: center; text-decoration: none; border: none;">
                                Register Free Now
                            </a>
                        </div>
                    </div>
                @endforeach
            @endforelse
        </div>

        @if(isset($events) && $events instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div style="margin-top: 30px;">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
