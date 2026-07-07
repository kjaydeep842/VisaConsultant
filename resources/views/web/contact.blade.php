@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Contact NV Visa Consultancy</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Contact Us</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="why-us-grid" style="align-items: flex-start;">
            <!-- Left Info Panel -->
            <div>
                <span class="section-badge">Get In Touch</span>
                <h2 class="section-title">Visit Our Branches or Reach Out Today</h2>
                <p>Have questions about country eligibility, document processing, or visa pathways? Speak with our team. We're here to help you navigate your journey.</p>
                
                <div class="feature-list mt-4">
                    <div class="feature-item">
                        <div class="feature-icon" style="background: rgba(11, 61, 145, 0.1); color: var(--primary-color);"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h4>Corporate Head Office</h4>
                            <p>123, Visa Tower, Business District, Mumbai - 400001, India</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon" style="background: rgba(11, 61, 145, 0.1); color: var(--primary-color);"><i class="fas fa-phone"></i></div>
                        <div>
                            <h4>Call Us</h4>
                            <p>+91 98765 43210 (Sales & Enquiries)</p>
                            <p>+91 98765 43211 (Customer Service)</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon" style="background: rgba(11, 61, 145, 0.1); color: var(--primary-color);"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h4>Email Enquiries</h4>
                            <p>info@nvvisa.com / support@nvvisa.com</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4" style="border-radius: var(--border-radius); overflow: hidden; height: 300px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); background:#e2e8f0; display:flex; align-items:center; justify-content:center;">
                    <!-- Placeholder for Map -->
                    <div style="text-align: center; color: var(--text-muted);">
                        <i class="fas fa-map-marked-alt" style="font-size: 50px; margin-bottom: 10px; color: var(--primary-color);"></i>
                        <p>Interactive Google Maps View</p>
                        <small>Mumbai Main Branch</small>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="form-card">
                <h3>Submit an Inquiry</h3>
                <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 25px;">Please fill out this form and a qualified consultant will reply within 24 business hours.</p>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Your Name *</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="e.g. John Doe" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="e.g. name@domain.com" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. +91 9876543210" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Preferred Country</label>
                            <select name="country" id="country" class="form-control">
                                <option value="">Select Destination</option>
                                <option value="Canada">Canada</option>
                                <option value="Australia">Australia</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="USA">USA</option>
                                <option value="Germany">Germany</option>
                                <option value="New Zealand">New Zealand</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label for="visa_type">Visa Category</label>
                            <select name="visa_type" id="visa_type" class="form-control">
                                <option value="">Select Category</option>
                                <option value="Student Visa">Student Visa</option>
                                <option value="Work Permit">Work Permit</option>
                                <option value="Permanent Residency">Permanent Residency</option>
                                <option value="Visitor Visa">Visitor Visa</option>
                                <option value="Business Visa">Business Visa</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label for="message">Detailed Message *</label>
                            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Briefly describe your profile, goals and queries..." required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; border:none;">Submit Enquire Now</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
