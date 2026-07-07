<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Country;
use App\Models\VisaCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        try {
            if (Schema::hasTable('settings')) {
                View::share('siteSettings', Setting::pluck('value', 'key')->toArray());
            }
            if (Schema::hasTable('countries')) {
                View::share('navCountries', Country::active()->orderBy('sort_order', 'asc')->orderBy('name', 'asc')->get());
            }
            if (Schema::hasTable('visa_categories')) {
                View::share('navServices', VisaCategory::active()->orderBy('sort_order', 'asc')->orderBy('name', 'asc')->get());
            }
        } catch (\Exception $e) {
            // Avoid failing during migrations or CLI runs
        }
    }
}
