<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\VisaCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = VisaCategory::active()->orderBy('sort_order')->paginate(12);
        return view('web.services', compact('services'));
    }

    public function show($slug)
    {
        $service = VisaCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedServices = VisaCategory::active()->where('id', '!=', $service->id)->take(4)->get();
        return view('web.service-detail', compact('service', 'relatedServices'));
    }
}
