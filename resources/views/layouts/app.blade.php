<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="@yield('meta_description', 'NV Visa Consultancy - Your Trusted Immigration Partner. Expert visa assistance for Canada, Australia, UK, USA and 25+ countries.')">
    <meta name="keywords"
        content="@yield('meta_keywords', 'visa consultancy, immigration, Canada visa, Australia visa, UK visa, student visa, work permit')">
    <meta property="og:title" content="@yield('title', 'NV Visa Consultancy') | Your Trusted Immigration Partner">
    <meta property="og:description"
        content="@yield('meta_description', 'Expert immigration consultancy with 98% success rate.')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <title>@yield('title', 'Home') | NV Visa Consultancy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    @stack('styles')
</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader-wrap">
            <div class="loader-ring"></div>
            <img src="{{ asset('images/logo-white.png') }}" alt="NV Visa" class="loader-logo"
                onerror="this.style.display='none'">
            <p>Loading...</p>
        </div>
    </div>

    <!-- Top Bar -->
    <div class="topbar">
        <div class="container">
            <div class="topbar-left">
                <a href="mailto:nvvisainternational@gmail.com"><i class="fas fa-envelope"></i> nvvisainternational@gmail.com</a>
                <a href="tel:+918980751038"><i class="fas fa-phone"></i> +91 98765 43210</a>
            </div>
            <div class="topbar-right">
                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                @auth
                    <a href="{{ route('client.dashboard') }}" class="btn-topbar">My Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-topbar">Login</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Nav Overlay (mobile) -->
    <div class="nav-overlay" id="navOverlay"></div>

    <!-- Navbar -->
    <nav class="navbar" id="mainNav">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="nav-logo">
                @if(isset($siteSettings['company_logo']) && $siteSettings['company_logo'])
                    <img src="{{ storageFile($siteSettings['company_logo']) }}"
                        alt="{{ $siteSettings['site_name'] ?? 'NV Visa Consultancy' }}"
                        style="max-height: 45px; width: auto; display: block;">
                @else
                    <div class="logo-text">
                        <span class="logo-nv">NV</span><span class="logo-visa">Visa</span>
                    </div>
                    <small>Consultancy</small>
                @endif
            </a>

            <ul class="nav-menu" id="navMenu">
                <button class="nav-close-btn" id="navClose" aria-label="Close menu"><i
                        class="fas fa-times"></i></button>
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li class="has-dropdown">
                    <a href="{{ route('services.index') }}">Services <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown">
                        @if(isset($navServices) && $navServices->count() > 0)
                            @foreach($navServices as $navSvc)
                                <li><a href="{{ route('services.show', $navSvc->slug) }}"><i
                                            class="fas {{ $navSvc->icon ?? 'fa-passport' }}"></i> {{ $navSvc->name }}</a></li>
                            @endforeach
                        @else
                            <li><a href="{{ route('services.show', 'student-visa') }}"><i class="fas fa-graduation-cap"></i>
                                    Student Visa</a></li>
                            <li><a href="{{ route('services.show', 'work-permit') }}"><i class="fas fa-briefcase"></i> Work
                                    Permit</a></li>
                            <li><a href="{{ route('services.show', 'permanent-residency') }}"><i class="fas fa-home"></i>
                                    Permanent Residency</a></li>
                            <li><a href="{{ route('services.show', 'visitor-visa') }}"><i class="fas fa-passport"></i>
                                    Visitor Visa</a></li>
                            <li><a href="{{ route('services.show', 'business-visa') }}"><i class="fas fa-handshake"></i>
                                    Business Visa</a></li>
                        @endif
                        <li><a href="{{ route('services.index') }}" class="view-all">View All Services →</a></li>
                    </ul>
                </li>
                <li class="has-dropdown">
                    <a href="{{ route('countries.index') }}">Countries <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown dropdown-countries">
                        @if(isset($navCountries) && $navCountries->count() > 0)
                            @foreach($navCountries as $navCty)
                                <li><a href="{{ route('countries.show', $navCty->slug) }}">
                                        <img src="https://flagcdn.com/w20/{{ strtolower($navCty->code ?? 'ca') }}.png"
                                            alt="{{ $navCty->name }}"
                                            style="width:18px; margin-right:8px; vertical-align:middle; border-radius:2px;">
                                        {{ $navCty->name }}
                                    </a></li>
                            @endforeach
                        @else
                            <li><a href="{{ route('countries.show', 'canada') }}">🍁 Canada</a></li>
                            <li><a href="{{ route('countries.show', 'australia') }}">🦘 Australia</a></li>
                            <li><a href="{{ route('countries.show', 'united-kingdom') }}">🇬🇧 United Kingdom</a></li>
                            <li><a href="{{ route('countries.show', 'usa') }}">🇺🇸 USA</a></li>
                            <li><a href="{{ route('countries.show', 'germany') }}">🇩🇪 Germany</a></li>
                            <li><a href="{{ route('countries.show', 'new-zealand') }}">🇳🇿 New Zealand</a></li>
                        @endif
                        <li><a href="{{ route('countries.index') }}" class="view-all">All Countries →</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('success-stories') }}"
                        class="{{ request()->routeIs('success-stories') ? 'active' : '' }}">Success Visa</a></li>
                <li><a href="{{ route('gallery') }}"
                        class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Customers Gallery</a></li>
                <li><a href="{{ route('blog.index') }}"
                        class="{{ request()->routeIs('blog.index') ? 'active' : '' }}">Blog</a></li>
                <li><a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                {{-- Mobile actions --}}
                <li class="mobile-only"
                    style="margin-top:12px;border-top:1px solid var(--border-color);padding-top:12px;">
                    <a href="{{ route('assessment.index') }}"
                        style="display:block;padding:10px 16px;background:var(--primary-color);color:#fff;border-radius:8px;font-weight:600;text-align:center;margin-bottom:8px;">Free
                        Assessment</a>
                    <a href="{{ route('appointment.index') }}"
                        style="display:block;padding:10px 16px;background:var(--secondary-color);color:#fff;border-radius:8px;font-weight:600;text-align:center;">Book
                        Consultation</a>
                </li>
            </ul>

            <div class="nav-actions">
                <a href="{{ route('assessment.index') }}" class="btn-assess">Free Assessment</a>
                <a href="{{ route('appointment.index') }}" class="btn-book">Book Consultation</a>
                <button class="nav-toggle" id="navToggle" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button class="alert-close">&times;</button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button class="alert-close">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-col footer-about">
                        <div class="footer-logo">
                            @if(isset($siteSettings['company_logo']) && $siteSettings['company_logo'])
                                <img src="{{ storageFile($siteSettings['company_logo']) }}"
                                    alt="{{ $siteSettings['site_name'] ?? 'NV Visa Consultancy' }}"
                                    style="max-height: 45px; width: auto; display: block; margin-bottom: 15px;">
                            @else
                                <div class="logo-text">
                                    <span class="logo-nv">NV</span><span class="logo-visa">Visa</span>
                                </div>
                                <small>Consultancy</small>
                            @endif
                        </div>
                        <p>Your trusted immigration partner with 12+ years of experience. We've helped 50,000+ clients
                            achieve their immigration dreams across 25+ countries.</p>
                        <div class="footer-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="footer-col">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('services.index') }}">Our Services</a></li>
                            <li><a href="{{ route('countries.index') }}">Countries</a></li>
                            <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                            <li><a href="{{ route('success-stories') }}">Success Visa</a></li>
                            <li><a href="{{ route('gallery') }}">Customers Gallery</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Services</h4>
                        <ul>
                            <li><a href="{{ route('services.show', 'student-visa') }}">Student Visa</a></li>
                            <li><a href="{{ route('services.show', 'work-permit') }}">Work Permit</a></li>
                            <li><a href="{{ route('services.show', 'permanent-residency') }}">Permanent Residency</a>
                            </li>
                            <li><a href="{{ route('services.show', 'visitor-visa') }}">Visitor Visa</a></li>
                            <li><a href="{{ route('services.show', 'business-visa') }}">Business Visa</a></li>
                            <li><a href="{{ route('assessment.index') }}">Free Assessment</a></li>
                            <li><a href="{{ route('tracker.index') }}">Track Application</a></li>
                        </ul>
                    </div>
                    <div class="footer-col footer-contact-info">
                        <h4>Contact Us</h4>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123, Visa Tower, Business District<br>Mumbai - 400001, India</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+91 98765 43210<br>+91 98765 43211</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>nvvisainternational@gmail.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <span>Mon–Sat: 9:00 AM – 7:00 PM<br>Sun: 10:00 AM – 4:00 PM</span>
                        </div>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="footer-newsletter">
                    <div class="newsletter-text">
                        <h4><i class="fas fa-paper-plane"></i> Subscribe to Immigration Updates</h4>
                        <p>Get latest visa news, policy updates and immigration tips directly in your inbox.</p>
                    </div>
                    <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email address" required>
                        <button type="submit">Subscribe <i class="fas fa-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; {{ date('Y') }} NV Visa Consultancy. All Rights Reserved.</p>
                <div class="footer-links">
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                    <a href="{{ route('terms') }}">Terms of Service</a>
                    <a href="{{ route('refund') }}">Refund Policy</a>
                    <a href="{{ route('cookie') }}">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/918980751038?text=Hello!%20I%20need%20visa%20consultation." class="whatsapp-float"
        target="_blank" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span>Chat with us</span>
    </a>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>