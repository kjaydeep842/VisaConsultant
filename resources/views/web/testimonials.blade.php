@extends('layouts.app')
@section('title', 'Client Testimonials')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Client Testimonials</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Testimonials</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Reviews</span>
            <h2 class="section-title">What Our Clients Say</h2>
            <p class="section-subtitle">We have helped thousands of families, students, and businesses establish new lives overseas.</p>
        </div>

        <div class="why-us-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
            @forelse($testimonials as $test)
                <div class="form-card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <div style="color: #ffb703; margin-bottom: 15px;">
                            @for($i = 0; $i < ($test->rating ?? 5); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <p style="font-style: italic; color: var(--text-muted); line-height: 1.6; font-size: 15px; margin-bottom: 20px;">
                            "{{ $test->testimonial }}"
                        </p>
                    </div>
                    <div>
                        <h3 style="margin: 0; font-size: 18px; color: var(--text-dark);">{{ $test->client_name }}</h3>
                        <small style="color: var(--primary-color); font-weight: 500;">
                            {{ $test->client_designation }} ({{ $test->visa_type }} to {{ $test->country_approved }})
                        </small>
                    </div>
                </div>
            @empty
                @php
                $fakeTestimonials = [
                    ['name'=>'Vikram Reddy','designation'=>'Solutions Architect','visa'=>'PR Visa Subclass 189','country'=>'Australia','text'=>'NV Visa Consultancy provided exceptional support during my skilled worker assessment process. Their team knows all subclass policies inside out.'],
                    ['name'=>'Aishwarya Roy','designation'=>'Post Graduate Student','visa'=>'Student Permit','country'=>'Canada','text'=>'Sarah helped me secure my admission and student visa without any hassle. The support during documents layout check was fantastic.'],
                    ['name'=>'Manish Sharma','designation'=>'Business Director','visa'=>'Entrepreneur Visa','country'=>'United Kingdom','text'=>'Reliable, expert legal counsel. They took care of everything from company setup checks to sponsor registration checks for my UK relocation.']
                ];
                @endphp
                @foreach($fakeTestimonials as $ft)
                    <div class="form-card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div>
                            <div style="color: #ffb703; margin-bottom: 15px;">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p style="font-style: italic; color: var(--text-muted); line-height: 1.6; font-size: 15px; margin-bottom: 20px;">
                                "{{ $ft['text'] }}"
                            </p>
                        </div>
                        <div>
                            <h3 style="margin: 0; font-size: 18px; color: var(--text-dark);">{{ $ft['name'] }}</h3>
                            <small style="color: var(--primary-color); font-weight: 500;">
                                {{ $ft['designation'] }} ({{ $ft['visa'] }} to {{ $ft['country'] }})
                            </small>
                        </div>
                    </div>
                @endforeach
            @endforelse
        </div>

        @if(isset($testimonials) && $testimonials instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div style="margin-top: 30px;">
                {{ $testimonials->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
