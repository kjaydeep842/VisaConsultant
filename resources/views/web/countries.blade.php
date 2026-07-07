@extends('layouts.app')
@section('title', 'Immigration Destinations')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Immigration Destination Countries</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Countries</span>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Where to Go</span>
            <h2 class="section-title">Explore Your Relocation Pathways</h2>
            <p class="section-subtitle">We offer authorized legal representation and document processing services for top global economies.</p>
        </div>

        <div class="services-grid">
            @forelse($countries as $country)
            <div class="country-card" style="text-align: left;">
                <div style="display:flex; align-items:center; gap:15px; margin-bottom:15px;">
                    <div class="country-flag" style="margin: 0; width:50px; height:50px;">
                        <img src="https://flagcdn.com/w80/{{ strtolower($country->code ?? 'ca') }}.png" alt="{{ $country->name }}">
                    </div>
                    <h3>{{ $country->name }}</h3>
                </div>
                <p style="margin-bottom:20px;">{{ $country->overview }}</p>
                <a href="{{ route('countries.show', $country->slug) }}" class="btn-outline-sm" style="display:inline-block;">Learn Pathways <i class="fas fa-arrow-right"></i></a>
            </div>
            @empty
            <div class="country-card">
                <h3>No countries registered.</h3>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
