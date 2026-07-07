@extends('layouts.app')
@section('title', 'Careers')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Careers at NV Visa</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Careers</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Join Our Team</span>
            <h2 class="section-title">Open Career Opportunities</h2>
            <p class="section-subtitle">We are looking for motivated and passionate professionals who want to help clients change their lives.</p>
        </div>

        <div class="why-us-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
            @forelse($careers as $career)
                <div class="form-card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <div style="margin-bottom: 15px;">
                            <span style="background: rgba(11, 61, 145, 0.1); color: var(--primary-color); padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                                {{ str_replace('_', ' ', $career->type) }}
                            </span>
                        </div>
                        <h3 style="margin: 0 0 10px 0; font-size: 20px; color: var(--text-dark);">{{ $career->title }}</h3>
                        <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 5px;">
                            <i class="fas fa-building" style="margin-right: 5px;"></i> {{ $career->department }}
                        </p>
                        <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">
                            <i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i> {{ $career->location }}
                        </p>
                        <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                            {{ Str::limit($career->description, 100) }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('career.show', $career->slug) }}" class="btn-primary" style="display: block; text-align: center; text-decoration: none; border: none;">
                            View Details & Apply
                        </a>
                    </div>
                </div>
            @empty
                @php
                $fakeCareers = [
                    ['title'=>'Senior Immigration Consultant','dept'=>'Consulting','loc'=>'Mumbai (Head Office)','type'=>'Full Time','desc'=>'Provide advice and guidance on Express Entry points profiles, MARA standards, and PR processing guidelines.'],
                    ['title'=>'Business Development Associate','dept'=>'Sales','loc'=>'Pune Branch','type'=>'Full Time','desc'=>'Engage with potential candidates, outline suitable visa categories, and manage lead generation funnels.'],
                    ['title'=>'Document Specialist','dept'=>'Operations','loc'=>'Remote / Mumbai','type'=>'Full Time','desc'=>'Audit submitted documents, prepare visa applications files, and ensure compliance with embassy criteria.']
                ];
                @endphp
                @foreach($fakeCareers as $fc)
                    <div class="form-card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div>
                            <div style="margin-bottom: 15px;">
                                <span style="background: rgba(11, 61, 145, 0.1); color: var(--primary-color); padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                                    {{ $fc['type'] }}
                                </span>
                            </div>
                            <h3 style="margin: 0 0 10px 0; font-size: 20px; color: var(--text-dark);">{{ $fc['title'] }}</h3>
                            <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 5px;">
                                <i class="fas fa-building" style="margin-right: 5px;"></i> {{ $fc['dept'] }}
                            </p>
                            <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">
                                <i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i> {{ $fc['loc'] }}
                            </p>
                            <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                                {{ $fc['desc'] }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('contact') }}" class="btn-primary" style="display: block; text-align: center; text-decoration: none; border: none;">
                                Contact Us to Apply
                            </a>
                        </div>
                    </div>
                @endforeach
            @endforelse
        </div>

        @if(isset($careers) && $careers instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div style="margin-top: 30px;">
                {{ $careers->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
