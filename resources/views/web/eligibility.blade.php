@extends('layouts.app')
@section('title', 'Free Immigration Eligibility Calculator')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Free Eligibility Checker</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>Eligibility Calculator</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 800px;">
        <div class="form-card">
            <h2 class="text-center" style="margin-bottom: 10px;">Check Your Points Instantly</h2>
            <p class="text-center" style="color: var(--text-muted); margin-bottom: 35px;">Calculate your preliminary CRS/Points eligibility for immigration streams like Canada Express Entry, Australia General Skilled Migration, and UK Point-Based System.</p>
            
            <form action="{{ route('assessment.calculate') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <!-- Personal Info -->
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. +91 98765 43210" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Current Age *</label>
                        <input type="number" name="age" id="age" class="form-control" min="18" max="65" placeholder="e.g. 28" required>
                    </div>

                    <!-- Profile Criteria -->
                    <div class="form-group">
                        <label for="education">Highest Level of Education *</label>
                        <select name="education" id="education" class="form-control" required>
                            <option value="">Select Education Level</option>
                            <option value="phd">PhD / Doctoral Degree</option>
                            <option value="masters">Master's Degree / Post-Graduation</option>
                            <option value="bachelors">Bachelor's Degree / Graduation</option>
                            <option value="diploma">3-Year Diploma / Post-Secondary Certificate</option>
                            <option value="high_school">Secondary Education / High School</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="experience">Work Experience (Years) *</label>
                        <select name="experience" id="experience" class="form-control" required>
                            <option value="">Select Experience Duration</option>
                            <option value="0">Less than 1 Year</option>
                            <option value="1">1 to 2 Years</option>
                            <option value="2">2 to 3 Years</option>
                            <option value="4">4 to 5 Years</option>
                            <option value="6">6+ Years</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="english_score">English Proficiency Score (IELTS / PTE Band) *</label>
                        <input type="number" step="0.5" name="english_score" id="english_score" class="form-control" min="0" max="9" placeholder="e.g. 7.5 (Overall)" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Preferred Immigration Country *</label>
                        <select name="country" id="country" class="form-control" required>
                            <option value="">Select Target Country</option>
                            @if(isset($navCountries) && $navCountries->count() > 0)
                                @foreach($navCountries as $navCty)
                                    <option value="{{ $navCty->name }}">{{ $navCty->name }}</option>
                                @endforeach
                            @else
                                <option value="Canada">Canada 🍁</option>
                                <option value="Australia">Australia 🦘</option>
                                <option value="United Kingdom">United Kingdom 🇬🇧</option>
                                <option value="USA">USA 🇺🇸</option>
                                <option value="Germany">Germany 🇩🇪</option>
                                <option value="New Zealand">New Zealand 🇳🇿</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="occupation">Current Occupation / Field</label>
                        <input type="text" name="occupation" id="occupation" class="form-control" placeholder="e.g. Software Engineer, Doctor, Teacher">
                    </div>
                    <div class="form-group">
                        <label for="budget">Investment / Relocation Budget (USD)</label>
                        <input type="number" name="budget" id="budget" class="form-control" placeholder="e.g. 20000">
                    </div>
                    <div class="form-group full-width">
                        <label for="family_members">Accompanying Family Members</label>
                        <select name="family_members" id="family_members" class="form-control">
                            <option value="0">No (Applying alone)</option>
                            <option value="1">Spouse only</option>
                            <option value="2">Spouse & 1 Child</option>
                            <option value="3">Spouse & 2+ Children</option>
                            <option value="4">Other dependants</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn-primary" style="width:100%; border:none;">Calculate Score Now</button>
            </form>
        </div>
    </div>
</section>
@endsection
