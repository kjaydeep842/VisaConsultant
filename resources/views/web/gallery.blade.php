@extends('layouts.app')
@section('title', 'Photo Gallery')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Our Gallery</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Gallery</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Life at NV</span>
            <h2 class="section-title">Moments & Milestones</h2>
            <p class="section-subtitle">Highlights from our immigration seminars, branch openings, and successful client celebration draws.</p>
        </div>

        <div class="why-us-grid" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            @forelse($gallery as $item)
                <div class="form-card" style="padding: 10px; overflow: hidden;">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: 10px;">
                    @else
                        <div style="width: 100%; height: 200px; background: #cbd5e1; border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                            <i class="fas fa-image" style="font-size: 40px; color: #94a3b8;"></i>
                        </div>
                    @endif
                    <h4 style="margin: 0 0 8px 0; color: var(--text-dark); font-size: 16px;">{{ $item->title }}</h4>
                    <span style="font-size: 11px; font-weight: 600; background: rgba(11, 61, 145, 0.1); color: var(--primary-color); padding: 2px 8px; border-radius: 4px; display: inline-block; margin-bottom: 10px;">{{ $item->category }}</span>
                    @if($item->description)
                        <p style="color: var(--text-muted); font-size: 13px; line-height: 1.5; margin: 0;">
                            {{ $item->description }}
                        </p>
                    @endif
                </div>
            @empty
                @php
                $fakeGallery = [
                    ['title'=>'Canada Immigration Seminar 2026','category'=>'Seminars'],
                    ['title'=>'Mumbai Head Office Launch','category'=>'Events'],
                    ['title'=>'Client Visa Success Celebration','category'=>'Celebrations'],
                    ['title'=>'Australia Subclass Expert Panel Meeting','category'=>'Seminars'],
                    ['title'=>'Team Annual Meet 2026','category'=>'Internal'],
                    ['title'=>'Free Assessment Camp Pune','category'=>'Events'],
                ];
                @endphp
                @foreach($fakeGallery as $fg)
                    <div class="form-card" style="padding: 10px; overflow: hidden;">
                        <div style="width: 100%; height: 200px; background: #cbd5e1; border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                            <i class="fas fa-image" style="font-size: 40px; color: #94a3b8;"></i>
                        </div>
                        <h4 style="margin: 0 0 5px 0; color: var(--text-dark);">{{ $fg['title'] }}</h4>
                        <p style="color: var(--text-muted); font-size: 12px; margin: 0;">{{ $fg['category'] }}</p>
                    </div>
                @endforeach
            @endforelse
        </div>

        @if(isset($gallery) && $gallery instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div style="margin-top: 30px;">
                {{ $gallery->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
