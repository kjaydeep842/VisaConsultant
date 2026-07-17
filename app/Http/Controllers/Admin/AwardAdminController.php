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
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/awards'), $imageName);
            $data['image_path'] = 'images/awards/' . $imageName;
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
            if (File::exists(public_path($award->image_path))) {
                File::delete(public_path($award->image_path));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/awards'), $imageName);
            $data['image_path'] = 'images/awards/' . $imageName;
        }

        $award->update($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award/Certificate updated successfully.');
    }

    public function destroy(Award $award)
    {
        if (File::exists(public_path($award->image_path))) {
            File::delete(public_path($award->image_path));
        }
        $award->delete();

        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }
}
