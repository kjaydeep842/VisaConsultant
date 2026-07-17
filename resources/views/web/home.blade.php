@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <!-- Hero Section with Dynamic Banners -->
    <section class="hero-slider" style="position: relative;">
        @if(isset($banners) && $banners->count() > 0)
            <div class="swiper heroSwiper">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                        <div class="swiper-slide">
                            <div class="hero" style="background: url('{{ storageFile($banner->image_path) }}') center center/cover no-repeat; padding: 120px 0 250px; display: flex; align-items: center; position: relative;">
                                <div class="hero-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4);"></div>
                                <div class="container hero-content" style="position: relative; z-index: 2; text-align: right; width: 100%; display: flex; flex-direction: column; align-items: flex-end;">
                                    <div class="hero-badge">WHAT WE DO</div>
                                    <h1 class="hero-title" style="font-size: 64px; font-weight: 800; color: var(--secondary-color); margin-bottom: 15px;">
                                        {!! nl2br(e($banner->title)) !!}
                                    </h1>
                                    <p class="hero-subtitle" style="font-size: 18px; color: rgba(255, 255, 255, 0.8); margin-bottom: 40px;">{{ $banner->subtitle }}</p>
                                    @if($banner->button_text)
                                    <div class="hero-actions" style="justify-content: flex-end; margin-bottom: 50px;">
                                        <a href="{{ $banner->button_link ?? '#' }}" class="btn-primary-hero">
                                            {{ $banner->button_text }}
                                        </a>
                                    </div>
                                    @endif
                                    <div class="hero-quick-actions" style="display: flex; justify-content: flex-end; gap: 20px; flex-wrap: wrap;">
                                        <a href="https://wa.me/918980751038" class="quick-action whatsapp" target="_blank">
                                            <i class="fab fa-whatsapp"></i> WhatsApp
                                        </a>
                                        <a href="tel:+918980751038" class="quick-action call">
                                            <i class="fas fa-phone"></i> Call Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        @else
            <!-- Fallback Static Banner -->
            <section class="hero" style="background: url('https://images.unsplash.com/photo-1541535881962-3bb380b08458?q=80&w=2000&auto=format&fit=crop') center center/cover no-repeat; padding: 120px 0 250px; display: flex; align-items: center; position: relative;">
                <div class="hero-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4);"></div>
                <div class="container hero-content" style="position: relative; z-index: 2; text-align: right; width: 100%; display: flex; flex-direction: column; align-items: flex-end;">
                    <div class="hero-badge">WHAT WE DO</div>
                    <h1 class="hero-title" style="font-size: 64px; font-weight: 800; color: var(--secondary-color); margin-bottom: 15px;">
                        Immigration Services<br>
                        <span class="hero-highlight" style="color: var(--secondary-color);">From Expert Adviser</span>
                    </h1>
                    <p class="hero-subtitle" style="font-size: 18px; color: rgba(255, 255, 255, 0.8); margin-bottom: 40px;">Join Our Free Visa Counselling Session With Experts</p>
                    <div class="hero-actions" style="justify-content: flex-end; margin-bottom: 50px;">
                        <a href="{{ route('appointment.index') }}" class="btn-primary-hero">
                            <i class="fas fa-calendar-check"></i> Book Free Consultation
                        </a>
                    </div>
                    <div class="hero-quick-actions" style="display: flex; justify-content: flex-end; gap: 20px; flex-wrap: wrap;">
                        <a href="https://wa.me/918980751038" class="quick-action whatsapp" target="_blank">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="tel:+918980751038" class="quick-action call">
                            <i class="fas fa-phone"></i> Call Now
                        </a>
                    </div>
                </div>
            </section>
        @endif
    </section>

    <!-- Hero Cards (Overlapping) -->
    <section class="hero-cards-section">
        <div class="container">
            <div class="hero-cards-wrapper">
                <div class="hero-feature-card hover-3d" style="background: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=500&auto=format&fit=crop') center/cover;">
                    <i class="fas fa-graduation-cap hero-feature-icon"></i>
                    <div class="hero-feature-content">
                        <h3>Dependent Visa</h3>
                        <span class="hero-feature-number">01</span>
                    </div>
                </div>
                <div class="hero-feature-card hover-3d" style="background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=500&auto=format&fit=crop') center/cover;">
                    <i class="fas fa-plane hero-feature-icon"></i>
                    <div class="hero-feature-content">
                        <h3>Family Visa</h3>
                        <span class="hero-feature-number">02</span>
                    </div>
                </div>
                <div class="hero-feature-card hover-3d" style="background: url('https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=500&auto=format&fit=crop') center/cover;">
                    <i class="fas fa-chart-line hero-feature-icon"></i>
                    <div class="hero-feature-content">
                        <h3>Student visa</h3>
                        <span class="hero-feature-number">03</span>
                    </div>
                </div>
                <div class="hero-highlight-card hover-3d">
                    <div>
                        <h3>Visitor Visa</h3>
                        <p>Visitor visa are a form of tourist visa that you might be qualified for if you only plan to travel for a short period for tourism purposes.</p>
                    </div>
                    <a href="{{ route('services.show', 'visitor-visa') }}" class="btn-read-more">Read More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Visa Search -->
    <section class="visa-search-section">
        <div class="container">
            <div class="visa-search-card">
                <h2><i class="fas fa-search"></i> Find Your Perfect Visa</h2>
                <form class="visa-search-form" action="{{ route('countries.index') }}" method="GET">
                    <div class="search-group">
                        <label>Destination Country</label>
                        <select name="country" class="search-select">
                            <option value="">Select Country</option>
                            @if(isset($navCountries) && $navCountries->count() > 0)
                                @foreach($navCountries as $navCty)
                                    <option value="{{ $navCty->slug }}">{{ $navCty->name }}</option>
                                @endforeach
                            @else
                                <option value="canada">🍁 Canada</option>
                                <option value="australia">🦘 Australia</option>
                                <option value="united-kingdom">🇬🇧 United Kingdom</option>
                                <option value="usa">🇺🇸 USA</option>
                                <option value="germany">🇩🇪 Germany</option>
                                <option value="new-zealand">🇳🇿 New Zealand</option>
                                <option value="ireland">🇮🇪 Ireland</option>
                                <option value="uae">🇦🇪 UAE</option>
                            @endif
                        </select>
                    </div>
                    <div class="search-group">
                        <label>Visa Type</label>
                        <select name="visa_type" class="search-select">
                            <option value="">Select Visa Type</option>
                            @if(isset($navServices) && $navServices->count() > 0)
                                @foreach($navServices as $navSvc)
                                    <option value="{{ $navSvc->slug }}">{{ $navSvc->name }}</option>
                                @endforeach
                            @else
                                <option value="student-visa">Student Visa</option>
                                <option value="work-permit">Work Permit</option>
                                <option value="permanent-residency">Permanent Residency</option>
                                <option value="visitor-visa">Visitor Visa</option>
                                <option value="business-visa">Business Visa</option>
                                <option value="tourist-visa">Tourist Visa</option>
                            @endif
                        </select>
                    </div>
                    <div class="search-group">
                        <label>Your Qualification</label>
                        <select name="education" class="search-select">
                            <option value="">Select Education</option>
                            <option value="phd">PhD / Doctorate</option>
                            <option value="masters">Masters Degree</option>
                            <option value="bachelors">Bachelor's Degree</option>
                            <option value="diploma">Diploma</option>
                            <option value="high_school">High School</option>
                        </select>
                    </div>
                    <button type="submit" class="search-btn">
                        <i class="fas fa-arrow-right"></i> Check Options
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Countries Slider -->
    <section class="countries-section section-padding">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Destinations</span>
                <h2 class="section-title">Popular Immigration Destinations</h2>
                <p class="section-subtitle">We provide expert visa assistance for 25+ countries worldwide</p>
            </div>
            <div class="swiper countriesSwiper">
                <div class="swiper-wrapper">
                    @foreach($countries as $country)
                        <div class="swiper-slide">
                            <a href="{{ route('countries.show', $country->slug) }}" class="country-card">
                                <div class="country-flag">
                                    <img src="https://flagcdn.com/w80/{{ strtolower($country->code ?? 'ca') }}.png"
                                         alt="{{ $country->name }}"
                                         onerror="this.src='{{ asset('images/flag-placeholder.png') }}'">
                                </div>
                                <h3>{{ $country->name }}</h3>
                                <p>{{ Str::limit($country->overview, 60) }}</p>
                                <span class="explore-link">Explore <i class="fas fa-arrow-right"></i></span>
                            </a>
                        </div>
                    @endforeach
                    @if($countries->isEmpty())
                        @foreach([['name' => 'Canada', 'code' => 'ca', 'slug' => 'canada'], ['name' => 'Australia', 'code' => 'au', 'slug' => 'australia'], ['name' => 'United Kingdom', 'code' => 'gb', 'slug' => 'united-kingdom'], ['name' => 'Germany', 'code' => 'de', 'slug' => 'germany'], ['name' => 'New Zealand', 'code' => 'nz', 'slug' => 'new-zealand'], ['name' => 'USA', 'code' => 'us', 'slug' => 'usa']] as $c)
                            <div class="swiper-slide">
                                <a href="{{ route('countries.show', $c['slug']) }}" class="country-card">
                                    <div class="country-flag">
                                        <img src="https://flagcdn.com/w80/{{ $c['code'] }}.png" alt="{{ $c['name'] }}">
                                    </div>
                                    <h3>{{ $c['name'] }}</h3>
                                    <p>Immigration pathways available</p>
                                    <span class="explore-link">Explore <i class="fas fa-arrow-right"></i></span>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('countries.index') }}" class="btn-outline">View All 25+ Countries <i class="fas fa-globe"></i></a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">What We Offer</span>
                <h2 class="section-title">Our Immigration Services</h2>
                <p class="section-subtitle">Comprehensive visa and immigration solutions tailored to your needs</p>
            </div>
            <div class="services-grid">
                @php
                    $defaultServices = [
                        ['icon' => 'fa-graduation-cap', 'name' => 'Student Visa', 'slug' => 'student-visa', 'desc' => 'Study at top universities worldwide'],
                        ['icon' => 'fa-briefcase', 'name' => 'Work Permit', 'slug' => 'work-permit', 'desc' => 'Professional work opportunities abroad'],
                        ['icon' => 'fa-home', 'name' => 'Permanent Residency', 'slug' => 'permanent-residency', 'desc' => 'Make your dream country your home'],
                        ['icon' => 'fa-passport', 'name' => 'Visitor Visa', 'slug' => 'visitor-visa', 'desc' => 'Visit family and friends abroad'],
                        ['icon' => 'fa-handshake', 'name' => 'Business Visa', 'slug' => 'business-visa', 'desc' => 'Expand your business globally'],
                        ['icon' => 'fa-chart-line', 'name' => 'Investor Visa', 'slug' => 'investor-visa', 'desc' => 'Invest and gain residency'],
                        ['icon' => 'fa-users', 'name' => 'Family Sponsorship', 'slug' => 'family-sponsorship', 'desc' => 'Reunite with your loved ones'],
                        ['icon' => 'fa-flag', 'name' => 'Citizenship', 'slug' => 'citizenship', 'desc' => 'Become a citizen of your dream country'],
                        ['icon' => 'fa-plane', 'name' => 'Tourist Visa', 'slug' => 'tourist-visa', 'desc' => 'Travel the world freely'],
                    ];
                @endphp
                @forelse($services as $svc)
                    <a href="{{ route('services.show', $svc->slug) }}" class="service-card">
                        <div class="service-icon"><i class="fas {{ $svc->icon ?? 'fa-passport' }}"></i></div>
                        <h3>{{ $svc->name }}</h3>
                        <p>{{ Str::limit($svc->description, 70) }}</p>
                        <span class="service-link">Learn More <i class="fas fa-arrow-right"></i></span>
                    </a>
                @empty
                    @foreach($defaultServices as $svc)
                        <a href="{{ route('services.show', $svc['slug']) }}" class="service-card">
                            <div class="service-icon"><i class="fas {{ $svc['icon'] }}"></i></div>
                            <h3>{{ $svc['name'] }}</h3>
                            <p>{{ $svc['desc'] }}</p>
                            <span class="service-link">Learn More <i class="fas fa-arrow-right"></i></span>
                        </a>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-us-section section-padding">
        <div class="container">
            <div class="why-us-grid">
                <div class="why-us-content">
                    <span class="section-badge">Why Choose NV Visa</span>
                    <h2 class="section-title">India's Most Trusted Immigration Partner</h2>
                    <p>With 12+ years of expertise and 50,000+ successful cases, we understand the complexities of immigration and provide personalised solutions for every client.</p>
                    <div class="feature-list">
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                            <div>
                                <h4>98% Success Rate</h4>
                                <p>Industry-leading visa approval rate backed by expert case evaluation</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-user-tie"></i></div>
                            <div>
                                <h4>ICCRC Certified Consultants</h4>
                                <p>Licensed and government-approved immigration experts</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-clock"></i></div>
                            <div>
                                <h4>24/7 Support</h4>
                                <p>Round-the-clock assistance via WhatsApp, phone and email</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-money-bill-wave"></i></div>
                            <div>
                                <h4>Transparent Pricing</h4>
                                <p>No hidden fees. Clear pricing with money-back guarantee</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="btn-primary mt-3">Learn More About Us</a>
                </div>
                <div class="why-us-visual">
                    <div class="achievement-card ac-top">
                        <i class="fas fa-trophy"></i>
                        <strong>Best Immigration Company 2025</strong>
                        <span>Times of India Award</span>
                    </div>
                    <div class="achievement-card ac-bottom">
                        <i class="fas fa-star"></i>
                        <strong>4.9/5 Google Rating</strong>
                        <span>Based on 2,500+ Reviews</span>
                    </div>
                    <div class="why-us-img">
                        <img src="{{ asset('images/why-us.jpg') }}" alt="Why NV Visa Consultancy"
                             onerror="this.parentElement.classList.add('no-img')">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Eligibility CTA -->
    <section class="eligibility-cta-section">
        <div class="container">
            <div class="eligibility-cta-card">
                <div class="eligibility-cta-content">
                    <h2>🎯 Check Your Visa Eligibility for FREE!</h2>
                    <p>Answer a few simple questions and get your eligibility score instantly. Our AI-powered calculator gives you personalised recommendations.</p>
                    <ul class="cta-features">
                        <li><i class="fas fa-check"></i> Takes only 2 minutes</li>
                        <li><i class="fas fa-check"></i> Instant results</li>
                        <li><i class="fas fa-check"></i> Free expert consultation</li>
                    </ul>
                </div>
                <div class="eligibility-cta-action">
                    <a href="{{ route('assessment.index') }}" class="btn-cta-large">
                        <i class="fas fa-calculator"></i> Start Free Assessment
                    </a>
                    <small>No registration required</small>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Client Reviews</span>
                <h2 class="section-title">What Our Clients Say</h2>
                <p class="section-subtitle">Real stories from real people who achieved their immigration dreams</p>
            </div>
            <div class="swiper testimonialsSwiper">
                <div class="swiper-wrapper">
                    @forelse($testimonials as $t)
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="testimonial-stars">
                                    @for($i = 0; $i < $t->rating; $i++)<i class="fas fa-star"></i>@endfor
                                </div>
                                <p class="testimonial-text">"{{ $t->testimonial }}"</p>
                                <div class="testimonial-author">
                                    <img src="{{ $t->avatar ? storageFile($t->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($t->client_name) . '&background=0B3D91&color=fff' }}"
                                         alt="{{ $t->client_name }}">
                                    <div>
                                        <strong>{{ $t->client_name }}</strong>
                                        <span>{{ $t->visa_type }} – {{ $t->country_approved }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        @foreach([
                                ['name' => 'Rahul Sharma', 'country' => 'Canada PR', 'text' => 'NV Visa made my Canada PR dream come true! The team was incredibly professional and guided me through every step.'],
                                ['name' => 'Priya Patel', 'country' => 'Australia Student Visa', 'text' => 'Got my student visa approved in just 3 weeks! Excellent service and very transparent about the process.'],
                                ['name' => 'Amit Kumar', 'country' => 'UK Work Permit', 'text' => 'The best immigration consultancy I have worked with. Highly recommend to anyone planning to move abroad.'],
                            ] as $t)
                            <div class="swiper-slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-stars">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <p class="testimonial-text">"{{ $t['text'] }}"</p>
                                    <div class="testimonial-author">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($t['name']) }}&background=0B3D91&color=fff" alt="{{ $t['name'] }}">
                                        <div>
                                            <strong>{{ $t['name'] }}</strong>
                                            <span>{{ $t['country'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="google-rating-bar">
                <div class="google-rating">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/24px-Google_%22G%22_Logo.svg.png" alt="Google">
                    <div>
                        <div class="stars-row">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <span>4.9/5 – 2,500+ Google Reviews</span>
                    </div>
                </div>
                <a href="{{ route('testimonials') }}" class="btn-outline-sm">View All Reviews</a>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section section-padding">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Latest Updates</span>
                <h2 class="section-title">Immigration News & Insights</h2>
                <p class="section-subtitle">Stay updated with the latest visa news, policy changes and immigration tips</p>
            </div>
            <div class="blog-grid">
                @forelse($blogs as $blog)
                    <article class="blog-card">
                        <div class="blog-img">
                            <img src="{{ $blog->featured_image_url ?? 'https://picsum.photos/400/250?random=' . rand() }}"
                                 alt="{{ $blog->title }}"
                                 onerror="this.src='https://picsum.photos/400/250'">
                            <span class="blog-category">{{ optional($blog->category)->name ?? 'Immigration' }}</span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="fas fa-user"></i> {{ $blog->author->name }}</span>
                                <span><i class="fas fa-calendar"></i> {{ $blog->published_at->format('d M Y') }}</span>
                            </div>
                            <h3><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                            <p>{{ Str::limit($blog->excerpt, 100) }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                @empty
                    @foreach(range(1, 3) as $i)
                        <article class="blog-card">
                            <div class="blog-img">
                                <img src="https://picsum.photos/400/250?random={{ $i }}" alt="Blog">
                                <span class="blog-category">Immigration</span>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span><i class="fas fa-calendar"></i> {{ now()->format('d M Y') }}</span>
                                </div>
                                <h3><a href="{{ route('blog.index') }}">Latest Immigration Updates for {{ date('Y') }}</a></h3>
                                <p>Stay informed about the latest changes in immigration policies and visa requirements.</p>
                                <a href="{{ route('blog.index') }}" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                    @endforeach
                @endforelse
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('blog.index') }}" class="btn-outline">View All Articles <i class="fas fa-newspaper"></i></a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Got Questions?</span>
                <h2 class="section-title">Frequently Asked Questions</h2>
            </div>
            <div class="faq-grid">
                @forelse($faqs as $faq)
                    <div class="faq-item">
                        <button class="faq-question">
                            {{ $faq->question }}
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="faq-answer">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                @empty
                    @foreach([
                            ['q' => 'What documents do I need for a Canada PR application?', 'a' => 'You need your passport, educational certificates, work experience letters, IELTS/CELPIP scores, police clearance certificate, and medical examination reports.'],
                            ['q' => 'How long does the visa process take?', 'a' => 'Processing times vary by country and visa type. Typically 2–12 weeks. Our team will give you an accurate timeline during consultation.'],
                            ['q' => 'What is your success rate?', 'a' => 'We maintain a 98% visa approval rate across all categories. This is achieved through thorough documentation and expert case preparation.'],
                            ['q' => 'Do you offer post-landing services?', 'a' => 'Yes! We provide comprehensive post-landing support including accommodation, airport pickup, and settlement assistance.'],
                        ] as $faq)
                        <div class="faq-item">
                            <button class="faq-question">{{ $faq['q'] }} <i class="fas fa-plus"></i></button>
                            <div class="faq-answer"><p>{{ $faq['a'] }}</p></div>
                        </div>
                    @endforeach
                @endforelse
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('faqs') }}" class="btn-outline">View All FAQs</a>
            </div>
        </div>
    </section>

    <!-- Awards & Certificates Section -->
    @if(isset($awards) && $awards->count() > 0)
    <section class="awards-section section-padding" style="background: var(--bg-light); padding: 80px 0;">
        <div class="container">
            <div class="section-header text-center" style="margin-bottom: 50px;">
                <span class="section-badge" style="margin: 0 auto 15px; display: inline-block;">Excellence</span>
                <h2 class="section-title">Our Awards & Certificates</h2>
                <p style="color: var(--text-muted); max-width: 600px; margin: 10px auto 0;">Recognized globally for our outstanding immigration services and customer success.</p>
            </div>
            
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px;">
                @foreach($awards as $award)
                    <div class="award-card hover-3d" style="background: var(--bg-white); padding: 30px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); text-align: center; border: 1px solid rgba(0,0,0,0.03); display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; max-width: 280px;">
                        <div style="height: 140px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; width: 100%;">
                            <img src="{{ storageFile($award->image_path) }}" alt="{{ $award->title }}" style="max-height: 100%; max-width: 100%; object-fit: contain; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));">
                        </div>
                        @if($award->title)
                            <h4 style="font-size: 18px; font-weight: 700; color: var(--primary-color); margin: 0; line-height: 1.4; word-break: break-word;">{{ $award->title }}</h4>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Customer Gallery Section -->
    @if(isset($gallery_images) && $gallery_images->count() > 0)
    <section class="gallery-section section-padding" style="padding: 80px 0;">
        <div class="container">
            <div class="section-header" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 20px; margin-bottom: 40px;">
                <div>
                    <span class="section-badge">Our Clients</span>
                    <h2 class="section-title text-gradient" style="margin-bottom: 0;">Customer Gallery</h2>
                </div>
                <a href="{{ route('gallery') }}" class="btn-primary-hero" style="padding: 10px 25px; font-size: 15px; border-radius: 8px;">View All Photos <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
                @foreach($gallery_images as $image)
                    <div class="gallery-item hover-3d" style="border-radius: 16px; overflow: hidden; height: 250px; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 2px solid var(--border-color);">
                        <img src="{{ storageFile($image->image) }}" alt="{{ $image->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); color: white;">
                            <h4 style="margin: 0; font-size: 16px; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">{{ Str::limit($image->title, 40) }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Banner -->
    <section class="cta-banner-section">
        <div class="container">
            <div class="cta-banner">
                <div class="cta-banner-content">
                    <h2>Ready to Start Your Immigration Journey?</h2>
                    <p>Book a free consultation with our certified immigration experts today.</p>
                </div>
                <div class="cta-banner-actions">
                    <a href="{{ route('appointment.index') }}" class="btn-cta-white">
                        <i class="fas fa-calendar-check"></i> Book Free Consultation
                    </a>
                    <a href="https://wa.me/918980751038" class="btn-cta-whatsapp" target="_blank">
                        <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
    // Hero Banners Swiper
    if(document.querySelector('.heroSwiper')) {
        new Swiper('.heroSwiper', {
            slidesPerView: 1,
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            effect: 'fade',
            fadeEffect: { crossFade: true }
        });
    }

    // Countries Swiper
    new Swiper('.countriesSwiper', {
        slidesPerView: 2,
        spaceBetween: 16,
        loop: true,
        autoplay: { delay: 3000, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        breakpoints: {
            576: { slidesPerView: 3 },
            768: { slidesPerView: 4 },
            1024: { slidesPerView: 5 },
            1280: { slidesPerView: 6 },
        }
    });

    // Testimonials Swiper
    new Swiper('.testimonialsSwiper', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: { delay: 4000 },
        pagination: { el: '.swiper-pagination', clickable: true },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        }
    });
    </script>
@endpush
