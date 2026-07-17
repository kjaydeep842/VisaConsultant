<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\VisaCategory;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Lead;
use App\Models\News;
use App\Models\Career;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\SuccessStory;
use App\Models\NewsletterSubscriber;
use App\Models\Banner;
use App\Models\Award;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $countries = Country::active()->featured()->orderBy('sort_order')->take(12)->get();
        $services = VisaCategory::active()->featured()->orderBy('sort_order')->take(9)->get();
        $testimonials = Testimonial::active()->orderBy('sort_order')->take(6)->get();
        $blogs = Blog::published()->with('author', 'category')->orderBy('published_at', 'desc')->take(3)->get();
        $faqs = Faq::active()->take(8)->get();
        $stats = [
            'years_experience' => 12,
            'visa_approved' => 50000,
            'countries_served' => 25,
            'success_rate' => 98,
        ];
        $banners = Banner::where('is_active', true)->orderBy('order', 'asc')->get();
        $awards = Award::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $gallery_images = \App\Models\Gallery::where('is_active', true)->orderBy('sort_order', 'asc')->take(10)->get();

        return view('web.home', compact('countries', 'services', 'testimonials', 'blogs', 'faqs', 'stats', 'banners', 'awards', 'gallery_images'));
    }

    public function about()
    {
        $team = \App\Models\TeamMember::where('is_active', true)->orderBy('sort_order')->get();
        $stats = [
            'years_experience' => 12,
            'visa_approved' => 50000,
            'countries_served' => 25,
            'success_rate' => 98,
        ];
        return view('web.about', compact('team', 'stats'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::active()->paginate(12);
        return view('web.testimonials', compact('testimonials'));
    }

    public function successStories()
    {
        $stories = SuccessStory::where('is_active', true)->paginate(9);
        return view('web.success-stories', compact('stories'));
    }

    public function faqs()
    {
        $faqs = Faq::active()->orderBy('sort_order')->get()->groupBy('category');
        $countries = Country::active()->get(['id', 'name']);
        $visaCategories = VisaCategory::active()->get(['id', 'name']);
        return view('web.faqs', compact('faqs', 'countries', 'visaCategories'));
    }

    public function gallery()
    {
        $gallery = Gallery::where('is_active', true)->orderBy('sort_order')->paginate(20);
        return view('web.gallery', compact('gallery'));
    }

    public function events()
    {
        $events = Event::where('is_active', true)->where('event_date', '>=', now())->orderBy('event_date')->paginate(9);
        return view('web.events', compact('events'));
    }

    public function news()
    {
        $news = News::where('status', 'published')->orderBy('published_at', 'desc')->paginate(9);
        return view('web.news', compact('news'));
    }

    public function newsShow($slug)
    {
        $item = News::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $related = News::where('status', 'published')->where('id', '!=', $item->id)->take(3)->get();
        return view('web.news-show', compact('item', 'related'));
    }

    public function careers()
    {
        $careers = Career::where('is_active', true)->paginate(9);
        return view('web.careers', compact('careers'));
    }

    public function careerShow($slug)
    {
        $career = Career::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('web.career-show', compact('career'));
    }

    public function careerApply(Request $request, $id)
    {
        $career = Career::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'nullable|string',
        ]);

        $path = $request->file('resume')->store('resumes', 'public');

        \App\Models\CareerApplication::create([
            'career_id' => $career->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume' => $path,
            'cover_letter' => $request->cover_letter,
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    public function newsletterSubscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        NewsletterSubscriber::firstOrCreate(['email' => $request->email], [
            'name' => $request->name,
            'is_active' => true,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Subscribed successfully!']);
        }

        return back()->with('success', 'Subscribed to newsletter successfully!');
    }
}
