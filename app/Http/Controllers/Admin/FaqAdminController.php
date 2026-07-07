<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqAdminController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer'   => 'required|string',
        ]);

        Faq::create([
            'question'   => $request->question,
            'answer'     => $request->answer,
            'category'   => $request->category ?? 'general',
            'sort_order' => $request->sort_order ?? 0,
            'status'     => $request->status ?? 'active',
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ added successfully!');
    }

    public function edit(string $id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($request->only(['question','answer','category','sort_order','status']));
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated!');
    }

    public function destroy(string $id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted!');
    }
}
