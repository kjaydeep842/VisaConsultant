@extends('layouts.app')
@section('title', 'Success Stories')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Success Stories</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Success Stories</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Achievers</span>
            <h2 class="section-title">Inspirational Journeys of Our Clients</h2>
            <p class="section-subtitle">Real people, real visas. Read about how they successfully achieved their migration goals.</p>
        </div>

        <div class="why-us-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
            @forelse($stories as $story)
                <div class="form-card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                            @if($story->image)
                                <img src="{{ asset('storage/' . $story->image) }}" alt="{{ $story->client_name }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                            @else
                                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--primary-color); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px;">
                                    {{ substr($story->client_name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h3 style="margin: 0; font-size: 18px; color: var(--text-dark);">{{ $story->client_name }}</h3>
                                <small style="color: var(--primary-color); font-weight: 500;">
                                    {{ $story->visa_type }} to {{ $story->to_country }}
                                </small>
                            </div>
                        </div>
                        <p style="font-style: italic; color: var(--text-muted); line-height: 1.6; font-size: 15px;">
                            "{{ $story->story }}"
                        </p>
                    </div>
                    @if($story->video_url)
                        <div style="margin-top: 15px;">
                            <a href="{{ $story->video_url }}" target="_blank" class="btn-outline" style="padding: 8px 15px; font-size: 13px; display: inline-flex; align-items: center; gap: 8px;">
                                <i class="fas fa-play-circle"></i> Watch Video Story
                            </a>
                        </div>
                    @endif
                </div>
            @empty
                @php
                $fakeStories = [
                    ['name'=>'Amanpreet Singh','from'=>'India','to'=>'Canada','visa'=>'Express Entry PR','text'=>'Getting my Canadian PR within 6 months was a dream come true. The team at NV Visa was extremely professional and guided me at each stage of ECA and Express Entry profile submittal.'],
                    ['name'=>'Dr. Anjali Mehta','from'=>'India','to'=>'United Kingdom','visa'=>'Health and Care Worker','text'=>'Very streamlined process. My documents and sponsor certificate checking was done with high accuracy. Recommended to all doctors looking to move to the UK.'],
                    ['name'=>'Ramesh Patel','from'=>'India','to'=>'Australia','visa'=>'Subclass 190 GSM','text'=>'I am incredibly thankful to Sarah and her team for advising on the subclass 190. They made the regional nomination process clear and easy to follow.']
                ];
                @endphp
                @foreach($fakeStories as $fs)
                    <div class="form-card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div>
                            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--primary-color); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px;">
                                    {{ substr($fs['name'], 0, 1) }}
                                </div>
                                <div>
                                    <h3 style="margin: 0; font-size: 18px; color: var(--text-dark);">{{ $fs['name'] }}</h3>
                                    <small style="color: var(--primary-color); font-weight: 500;">
                                        {{ $fs['visa'] }} to {{ $fs['to'] }}
                                    </small>
                                </div>
                            </div>
                            <p style="font-style: italic; color: var(--text-muted); line-height: 1.6; font-size: 15px;">
                                "{{ $fs['text'] }}"
                            </p>
                        </div>
                    </div>
                @endforeach
            @endforelse
        </div>

        @if(isset($stories) && $stories instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div style="margin-top: 30px;">
                {{ $stories->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
