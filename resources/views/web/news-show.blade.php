@extends('layouts.app')
@section('title', $item->title)

@section('content')
<section class="page-header">
    <div class="container">
        <h1>{{ $item->title }}</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <a href="{{ route('news') }}">News</a> / <span>Article Details</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="why-us-grid" style="align-items: flex-start; grid-template-columns: 2fr 1fr; gap: 40px;">
            <!-- Article Body -->
            <div>
                <div style="background: #fff; border-radius: var(--border-radius); padding: 35px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 30px;">
                    <div style="margin-bottom: 20px; color: var(--text-muted); font-size: 14px;">
                        <span style="margin-right: 15px;">
                            <i class="far fa-clock" style="color: var(--primary-color); margin-right: 5px;"></i>
                            Published on: {{ $item->published_at ? $item->published_at->format('M d, Y') : now()->format('M d, Y') }}
                        </span>
                        <span>
                            <i class="fas fa-bullhorn" style="color: var(--primary-color); margin-right: 5px;"></i>
                            Visa News
                        </span>
                    </div>

                    <h2 style="font-size: 26px; color: var(--text-dark); margin-top: 0; margin-bottom: 20px; line-height: 1.4;">
                        {{ $item->title }}
                    </h2>

                    <div style="font-size: 16px; color: var(--text-muted); line-height: 1.8; white-space: pre-line;">
                        {{ $item->content }}
                    </div>
                </div>
            </div>

            <!-- Related Articles & Sidebar -->
            <div>
                <div class="form-card" style="padding: 25px; margin-bottom: 30px;">
                    <h3 style="margin-top: 0; margin-bottom: 20px; font-size: 18px; border-bottom: 2px solid var(--primary-color); padding-bottom: 10px;">
                        Related Updates
                    </h3>
                    @forelse($related as $rel)
                        <div style="margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
                            <small style="color: var(--primary-color); font-weight: 500;">
                                {{ $rel->published_at ? $rel->published_at->format('M d, Y') : now()->format('M d, Y') }}
                            </small>
                            <h4 style="margin: 5px 0 10px 0; font-size: 14px; line-height: 1.4;">
                                <a href="{{ route('news.show', $rel->slug) }}" style="color: var(--text-dark); text-decoration: none;">
                                    {{ $rel->title }}
                                </a>
                            </h4>
                        </div>
                    @empty
                        <p style="color: var(--text-muted); font-size: 14px;">No related articles found.</p>
                    @endforelse
                </div>

                <div class="form-card" style="background: var(--primary-color); color: #fff; text-align: center; padding: 30px;">
                    <h3 style="color: #fff; margin-top: 0;">Get Free Profile Assessment</h3>
                    <p style="color: rgba(255,255,255,0.8); font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                        Find out if you qualify for immigration under the latest rules. Complete our free visa eligibility audit today.
                    </p>
                    <a href="{{ route('assessment.index') }}" class="btn-primary" style="background: #fff; color: var(--primary-color); display: block; text-decoration: none; border: none; font-weight: 600;">
                        Start Free Audit
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
