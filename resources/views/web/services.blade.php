@extends('layouts.app')
@section('title', 'Our Visa Services')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Immigration & Visa Services</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Services</span>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">How We Help</span>
            <h2 class="section-title">Comprehensive Visa Categories</h2>
            <p class="section-subtitle">We manage your document checklist, visa application, and embassy filing for a high success rate.</p>
        </div>

        <div class="services-grid">
            @forelse($services as $svc)
            <div class="service-card">
                <div class="service-icon"><i class="fas {{ $svc->icon ?? 'fa-passport' }}"></i></div>
                <h3>{{ $svc->name }}</h3>
                <p>{{ $svc->description }}</p>
                <a href="{{ route('services.show', $svc->slug) }}" class="service-link">Learn Pathways <i class="fas fa-arrow-right"></i></a>
            </div>
            @empty
            <div class="service-card">
                <h3>No visa categories registered.</h3>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
