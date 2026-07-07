@extends('layouts.app')
@section('title', $blog->title)

@section('content')
<section class="page-header">
    <div class="container">
        <h1 style="font-size:32px;">{{ $blog->title }}</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <a href="{{ route('blog.index') }}">Blog</a> / <span>{{ Str::limit($blog->title, 20) }}</span>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container" style="max-width:800px;">
        <div class="form-card">
            
            <div style="height:350px; border-radius:var(--border-radius); overflow:hidden; margin-bottom:30px; box-shadow:0 4px 15px rgba(0,0,0,0.05);">
                <img src="{{ $blog->featured_image ?? 'https://picsum.photos/800/400' }}" alt="{{ $blog->title }}" style="width:100%; height:100%; object-fit:cover;">
            </div>

            <div style="display:flex; gap:15px; color:var(--text-muted); font-size:13px; margin-bottom:20px; border-bottom:1px solid var(--border-color); padding-bottom:15px;">
                <span><i class="fas fa-calendar-alt"></i> Published: {{ $blog->created_at->format('d M Y') }}</span>
                <span><i class="fas fa-user-edit"></i> Author: {{ optional($blog->author)->name ?? 'Immigration Expert' }}</span>
            </div>

            <div style="line-height:1.9; color:var(--text-color); font-size:16px;">
                {!! $blog->content !!}
            </div>

            <div class="text-center mt-4" style="border-top:1px solid var(--border-color); padding-top:30px;">
                <a href="{{ route('blog.index') }}" class="btn-outline">Back to Blog Feed</a>
            </div>

        </div>
    </div>
</section>
@endsection
