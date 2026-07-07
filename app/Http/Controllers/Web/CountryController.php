<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::active()
            ->when($request->search, fn($q) => $q->where('name', 'like', '%'.$request->search.'%'))
            ->orderBy('sort_order')
            ->paginate(12);

        return view('web.countries', compact('countries'));
    }

    public function show($slug)
    {
        $country = Country::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedCountries = Country::active()->where('id', '!=', $country->id)->take(4)->get();
        $gallery = \App\Models\Gallery::where('country_id', $country->id)->where('is_active', true)->orderBy('sort_order')->get();
        return view('web.country-detail', compact('country', 'relatedCountries', 'gallery'));
    }
}
