<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AwardAdminController extends Controller
{
    public function index()
    {
        $awards = Award::orderBy('sort_order', 'asc')->get();
        return view('admin.awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.awards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('awards', 'public');
        }

        Award::create($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award/Certificate created successfully.');
    }

    public function edit(Award $award)
    {
        return view('admin.awards.edit', compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            if ($award->image_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($award->image_path);
            }

            $data['image_path'] = $request->file('image')->store('awards', 'public');
        }

        $award->update($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award/Certificate updated successfully.');
    }

    public function destroy(Award $award)
    {
        if ($award->image_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($award->image_path);
        }
        $award->delete();

        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }
}
