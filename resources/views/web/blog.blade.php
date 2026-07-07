@extends('layouts.app')
@section('title', 'Immigration News & Blogs')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Immigration News & Insights</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Blog</span>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Latest Updates</span>
            <h2 class="section-title">Visa Regulations & News</h2>
            <p class="section-subtitle">Stay informed about express entry draw changes, study permit quotas, and work permit amendments.</p>
        </div>

        <div class="blog-grid">
            @forelse($blogs as $blog)
            <article class="blog-card">
                <div class="blog-img">
                    <img src="{{ $blog->featured_image ?? 'https://picsum.photos/400/250' }}" alt="{{ $blog->title }}">
                    <span class="blog-category">Immigration Draw</span>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('d M Y') }}</span>
                    </div>
                    <h3><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                    <p>{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                    <a href="{{ route('blog.show', $blog->slug) }}" class="blog-read-more">Read Full Article <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
            @empty
            <div class="blog-card">
                <h3>No articles published.</h3>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
