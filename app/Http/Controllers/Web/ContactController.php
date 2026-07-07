<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('web.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string|min:10',
            'visa_type' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'visa_type' => $request->visa_type,
            'country_interested' => $request->country,
            'source' => 'contact_form',
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Thank you! We will contact you shortly.']);
        }

        return back()->with('success', 'Thank you! Our team will contact you within 24 hours.');
    }
}
