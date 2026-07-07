<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialAdminController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'message' => 'required|string',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create([
            'name'    => $request->name,
            'country' => $request->country,
            'visa_type' => $request->visa_type,
            'message' => $request->message,
            'rating'  => $request->rating,
            'avatar'  => $request->avatar,
            'status'  => $request->status ?? 'published',
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully!');
    }

    public function edit(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($request->only(['name','country','visa_type','message','rating','avatar','status']));
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated!');
    }

    public function destroy(string $id)
    {
        Testimonial::findOrFail($id)->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted!');
    }
}
