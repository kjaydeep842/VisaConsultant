<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $gallery = Gallery::with('country')->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        $countries = Country::active()->orderBy('name')->get();
        return view('admin.gallery.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'country_id' => 'nullable|exists:countries,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create([
            'title' => $request->title,
            'image' => $imagePath,
            'category' => $request->category ?? 'General',
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image uploaded successfully!');
    }

    public function edit(string $id)
    {
        $item = Gallery::findOrFail($id);
        $countries = Country::active()->orderBy('name')->get();
        return view('admin.gallery.edit', compact('item', 'countries'));
    }

    public function update(Request $request, string $id)
    {
        $item = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'country_id' => 'nullable|exists:countries,id',
        ]);

        $data = [
            'title' => $request->title,
            'category' => $request->category ?? 'General',
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
            'country_id' => $request->country_id,
        ];

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully!');
    }

    public function destroy(string $id)
    {
        $item = Gallery::findOrFail($id);
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully!');
    }
}
