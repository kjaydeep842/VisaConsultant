@extends('layouts.app')
@section('title', 'About Us')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>About NV Visa Consultancy</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>About Us</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="why-us-grid">
            <div class="why-us-content">
                <span class="section-badge">Our Story</span>
                <h2 class="section-title">Pioneering Premium Immigration Services Since 2014</h2>
                <p>NV Visa Consultancy has been at the forefront of global immigration solutions, enabling students, professionals, and families to settle in their dream destinations. With a deep commitment to trust, legal compliance, and customer success, we've established ourselves as a top-tier consultancy firm.</p>
                <p class="mt-3">Our team consists of government-authorized practitioners, legal consultants, and process experts who ensure every document is evaluated carefully. We stand for transparency, efficiency, and a seamless visa application lifecycle.</p>
                <div class="feature-list mt-3">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                        <div>
                            <h4>Authorized & Certified</h4>
                            <p>Direct representation through licensed practitioners (RCIC, MARA, etc.)</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                        <div>
                            <h4>Tailored Assessment</h4>
                            <p>We do not sell dreams; we assess options and outline realistic, viable pathways.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="why-us-visual">
                <div class="why-us-img no-img"></div>
            </div>
        </div>
    </div>
</section>

<!-- Stats banner -->
<section class="eligibility-cta-section text-center">
    <div class="container">
        <h2 style="color:white; margin-bottom: 20px;">Helping People Build Futures Globally</h2>
        <p style="color: rgba(255,255,255,0.8); max-width: 600px; margin: 0 auto 40px;">Our values of transparency, client success, and ethical standards keep us ranked among the best immigration consultants.</p>
        <div class="hero-stats-grid" style="position: static; background: none; border: none; backdrop-filter: none;">
            <div class="hero-stat">
                <strong style="color: var(--accent-color);">12+</strong>
                <small style="color: white;">Years Experience</small>
            </div>
            <div class="hero-stat">
                <strong style="color: var(--accent-color);">50,000+</strong>
                <small style="color: white;">Visas Approved</small>
            </div>
            <div class="hero-stat">
                <strong style="color: var(--accent-color);">25+</strong>
                <small style="color: white;">Countries Served</small>
            </div>
            <div class="hero-stat">
                <strong style="color: var(--accent-color);">98%</strong>
                <small style="color: white;">Success Rate</small>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Our Leaders</span>
            <h2 class="section-title">Meet Our Immigration Consultants</h2>
            <p class="section-subtitle">A dedicated team of verified professionals to handle your immigration cases.</p>
        </div>
        <div class="services-grid">
            @forelse($team ?? [] as $member)
            <div class="service-card text-center">
                <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto 20px;">
                    <img src="{{ $member->photo ? storageFile($member->photo) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&background=0B3D91&color=fff&size=120' }}" alt="{{ $member->name }}" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <h3>{{ $member->name }}</h3>
                <p style="color: var(--secondary-color); font-weight: 600; font-size:14px; margin-bottom: 10px;">{{ $member->designation }}</p>
                <p>{{ Str::limit($member->bio, 80) }}</p>
            </div>
            @empty
            <div class="service-card text-center">
                <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto 20px; background: #e2e8f0; display: flex; align-items:center; justify-content:center;">
                    <i class="fas fa-user-tie" style="font-size: 50px; color: #a0aec0;"></i>
                </div>
                <h3>Marcus Aurelius</h3>
                <p style="color: var(--secondary-color); font-weight: 600; font-size:14px; margin-bottom: 10px;">Senior Legal Advisor & Founder</p>
                <p>Licensed immigration advisor specializing in skilled migration and corporate visas.</p>
            </div>
            <div class="service-card text-center">
                <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto 20px; background: #e2e8f0; display: flex; align-items:center; justify-content:center;">
                    <i class="fas fa-user-tie" style="font-size: 50px; color: #a0aec0;"></i>
                </div>
                <h3>Sarah Jenkins</h3>
                <p style="color: var(--secondary-color); font-weight: 600; font-size:14px; margin-bottom: 10px;">Canada RCIC Consultant</p>
                <p>Registered Canadian Immigration Consultant, leading Express Entry and PR streams.</p>
            </div>
            <div class="service-card text-center">
                <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto 20px; background: #e2e8f0; display: flex; align-items:center; justify-content:center;">
                    <i class="fas fa-user-tie" style="font-size: 50px; color: #a0aec0;"></i>
                </div>
                <h3>John Doe</h3>
                <p style="color: var(--secondary-color); font-weight: 600; font-size:14px; margin-bottom: 10px;">Australia MARA Consultant</p>
                <p>Australia migration law expert dealing with TSS, PR subclass, and partner visas.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
