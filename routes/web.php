<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CountryController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\AppointmentController;
use App\Http\Controllers\Web\EligibilityController;
use App\Http\Controllers\Web\ApplicationTrackerController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CountryAdminController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\LeadAdminController;
use App\Http\Controllers\Admin\AppointmentAdminController;
use App\Http\Controllers\Admin\ApplicationAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\TestimonialAdminController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\Admin\SettingAdminController;
use App\Http\Controllers\Admin\VisaCategoryAdminController;
use App\Http\Controllers\Admin\TeamAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Client\ClientDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — NV Visa Consultancy
|--------------------------------------------------------------------------
*/

// ── Public / Website Routes ─────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Countries
Route::prefix('countries')->name('countries.')->group(function () {
    Route::get('/', [CountryController::class, 'index'])->name('index');
    Route::get('/{slug}', [CountryController::class, 'show'])->name('show');
});

// Services / Visa Categories
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('show');
});

// Blog
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{id}/comments', [BlogController::class, 'storeComment'])->name('comment');
});

// Appointments & Consultations
Route::get('/book-consultation', [AppointmentController::class, 'index'])->name('appointment.index');
Route::post('/book-consultation', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/book-consultation/success/{ref}', [AppointmentController::class, 'success'])->name('appointment.success');

// Free Eligibility Assessment
Route::get('/free-assessment', [EligibilityController::class, 'index'])->name('assessment.index');
Route::post('/free-assessment', [EligibilityController::class, 'calculate'])->name('assessment.calculate');

// Application Tracker
Route::get('/track-application', [ApplicationTrackerController::class, 'index'])->name('tracker.index');
Route::post('/track-application', [ApplicationTrackerController::class, 'track'])->name('tracker.track');

// Testimonials, Success Stories, FAQs
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/success-stories', [HomeController::class, 'successStories'])->name('success-stories');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/events', [HomeController::class, 'events'])->name('events');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/news/{slug}', [HomeController::class, 'newsShow'])->name('news.show');
Route::get('/careers', [HomeController::class, 'careers'])->name('careers');
Route::get('/careers/{slug}', [HomeController::class, 'careerShow'])->name('career.show');
Route::post('/careers/{id}/apply', [HomeController::class, 'careerApply'])->name('career.apply');

// Static Pages
Route::get('/privacy-policy', fn() => view('pages.privacy'))->name('privacy');
Route::get('/terms', fn() => view('pages.terms'))->name('terms');
Route::get('/refund-policy', fn() => view('pages.refund'))->name('refund');
Route::get('/cookie-policy', fn() => view('pages.cookie'))->name('cookie');

// Newsletter
Route::post('/newsletter/subscribe', [HomeController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

// ── Authentication ───────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    // Google OAuth
    Route::get('/auth/google', [AuthController::class, 'googleRedirect'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('auth.google.callback');

    // OTP
    Route::get('/otp-login', [AuthController::class, 'otpForm'])->name('otp.form');
    Route::post('/otp-send', [AuthController::class, 'sendOtp'])->name('otp.send');
    Route::post('/otp-verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ── Client Dashboard ─────────────────────────────────────────────────────
Route::prefix('client')->name('client.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/applications', [ClientDashboardController::class, 'applications'])->name('applications');
    Route::get('/appointments', [ClientDashboardController::class, 'appointments'])->name('appointments');
    Route::get('/documents', [ClientDashboardController::class, 'documents'])->name('documents');
    Route::get('/invoices', [ClientDashboardController::class, 'invoices'])->name('invoices');
    Route::get('/profile', [ClientDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [ClientDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/messages', [ClientDashboardController::class, 'messages'])->name('messages');
});

// ── Admin Authentication (no auth middleware) ───────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'loginForm'])->name('login')->middleware('guest');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post')->middleware('guest');
});

// ── Admin Panel ──────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Countries
    Route::resource('countries', CountryAdminController::class);

    // Visa Categories
    Route::resource('visa-categories', VisaCategoryAdminController::class);

    // Blog
    Route::resource('blogs', BlogAdminController::class);

    // Leads CRM
    Route::resource('leads', LeadAdminController::class);
    Route::post('/leads/{lead}/assign', [LeadAdminController::class, 'assign'])->name('leads.assign');

    // Appointments
    Route::resource('appointments', AppointmentAdminController::class);

    // Applications
    Route::resource('applications', ApplicationAdminController::class);
    Route::post('/applications/{app}/timeline', [ApplicationAdminController::class, 'addTimeline'])->name('applications.timeline');

    // Users
    Route::resource('users', UserAdminController::class);

    // Testimonials
    Route::resource('testimonials', TestimonialAdminController::class);

    // FAQs
    Route::resource('faqs', FaqAdminController::class);

    // Team
    Route::resource('team', TeamAdminController::class);

    // News
    Route::resource('news', NewsAdminController::class);

    // Gallery
    Route::resource('gallery', GalleryAdminController::class);

    // Settings
    Route::get('/settings', [SettingAdminController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingAdminController::class, 'update'])->name('settings.update');

    // Analytics
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
});

// ── 404 ──────────────────────────────────────────────────────────────────
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
