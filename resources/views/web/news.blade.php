@extends('layouts.app')
@section('title', 'Immigration News & Policy Updates')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Immigration News & Policy Updates</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>News</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Latest Updates</span>
            <h2 class="section-title">Global Immigration Changes</h2>
            <p class="section-subtitle">Stay informed about the latest immigration draws, threshold changes, and visa policies around the world.</p>
        </div>

        <div class="why-us-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
            @forelse($news as $item)
                <div class="form-card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <div style="margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: var(--primary-color); font-size: 13px; font-weight: 600;">
                                <i class="far fa-clock"></i> {{ $item->published_at ? $item->published_at->format('M d, Y') : now()->format('M d, Y') }}
                            </span>
                            @if($item->is_featured)
                                <span style="background: #e63946; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase;">FEATURED</span>
                            @endif
                        </div>
                        <h3 style="margin: 0 0 12px 0; font-size: 18px; color: var(--text-dark); line-height: 1.4;">{{ $item->title }}</h3>
                        <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                            {{ $item->excerpt }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('news.show', $item->slug) }}" class="btn-primary" style="display: block; text-align: center; text-decoration: none; border: none;">
                            Read Full Article
                        </a>
                    </div>
                </div>
            @empty
                <p>No recent news articles found. Please check back later.</p>
            @endforelse
        </div>

        @if(isset($news) && $news instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div style="margin-top: 30px;">
                {{ $news->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
