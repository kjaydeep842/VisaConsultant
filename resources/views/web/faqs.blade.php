@extends('layouts.app')
@section('title', 'Frequently Asked Questions')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Frequently Asked Questions</h1>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / <span>FAQs</span>
        </div>
    </div>
</section>

<!-- FAQs Content -->
<section class="section-padding">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="section-header text-center" style="margin-bottom: 40px;">
                <span class="section-badge" style="margin: 0 auto 15px; display: inline-block;">Got Questions?</span>
                <h2 class="section-title">We Have Answers</h2>
                <p style="color: var(--text-muted);">Find answers to the most common questions about immigration, our services, and the visa application process.</p>
            </div>

            @if(isset($faqs) && count($faqs) > 0)
                @foreach($faqs as $category => $categoryFaqs)
                    <div style="margin-bottom: 40px;">
                        <h3 style="margin-bottom: 20px; color: var(--primary-color); border-bottom: 2px solid var(--border-color); padding-bottom: 10px;">{{ $category ?: 'General Questions' }}</h3>
                        <div class="faq-grid" style="display: block;">
                            @foreach($categoryFaqs as $faq)
                                <div class="faq-item" style="margin-bottom: 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.03); border: 1px solid var(--border-color); background: var(--bg-white);">
                                    <button class="faq-question" style="width: 100%; text-align: left; padding: 20px; font-weight: 600; font-size: 16px; background: none; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center; color: var(--text-color);">
                                        {{ $faq->question }}
                                        <i class="fas fa-plus" style="color: var(--secondary-color); transition: transform 0.3s;"></i>
                                    </button>
                                    <div class="faq-answer" style="padding: 0 20px 20px; display: none; color: var(--text-muted); line-height: 1.6;">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback Static FAQs if DB is empty -->
                <div class="faq-grid" style="display: block;">
                    @foreach([
                        ['q' => 'What documents do I need for a Canada PR application?', 'a' => 'You need your passport, educational certificates, work experience letters, IELTS/CELPIP scores, police clearance certificate, and medical examination reports.'],
                        ['q' => 'How long does the visa process take?', 'a' => 'Processing times vary by country and visa type. Typically 2–12 weeks. Our team will give you an accurate timeline during consultation.'],
                        ['q' => 'What is your success rate?', 'a' => 'We maintain a 98% visa approval rate across all categories. This is achieved through thorough documentation and expert case preparation.'],
                        ['q' => 'Do you offer post-landing services?', 'a' => 'Yes! We provide comprehensive post-landing support including accommodation, airport pickup, and settlement assistance.'],
                    ] as $index => $faq)
                        <div class="faq-item" style="margin-bottom: 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.03); border: 1px solid var(--border-color); background: var(--bg-white);">
                            <button class="faq-question" style="width: 100%; text-align: left; padding: 20px; font-weight: 600; font-size: 16px; background: none; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center; color: var(--text-color);">
                                {{ $faq['q'] }}
                                <i class="fas fa-plus" style="color: var(--secondary-color); transition: transform 0.3s;"></i>
                            </button>
                            <div class="faq-answer" style="padding: 0 20px 20px; display: none; color: var(--text-muted); line-height: 1.6;">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div style="text-align: center; margin-top: 50px; padding: 40px; background: var(--bg-light); border-radius: 12px;">
                <h3 style="margin-bottom: 15px;">Still have questions?</h3>
                <p style="margin-bottom: 25px; color: var(--text-muted);">Can't find the answer you're looking for? Please chat to our friendly team.</p>
                <a href="{{ route('contact') }}" class="btn-primary-hero">Get in touch</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const icon = question.querySelector('i');
                const isOpen = answer.style.display === 'block';
                
                // Close all other FAQs (optional accordion effect)
                // document.querySelectorAll('.faq-answer').forEach(ans => ans.style.display = 'none');
                // document.querySelectorAll('.faq-question i').forEach(i => {
                //     i.classList.remove('fa-minus');
                //     i.classList.add('fa-plus');
                //     i.style.transform = 'rotate(0deg)';
                // });

                if (!isOpen) {
                    answer.style.display = 'block';
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    answer.style.display = 'none';
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                    icon.style.transform = 'rotate(0deg)';
                }
            });
        });
    });
</script>
@endpush
