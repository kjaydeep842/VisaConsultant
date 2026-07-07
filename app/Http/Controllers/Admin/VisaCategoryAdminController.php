<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VisaCategoryAdminController extends Controller
{
    public function index()
    {
        $categories = VisaCategory::orderBy('name')->paginate(20);
        return view('admin.visa-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.visa-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        VisaCategory::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'icon'        => $request->icon ?? 'fas fa-id-card',
        ]);

        return redirect()->route('admin.visa-categories.index')->with('success', 'Visa category added!');
    }

    public function edit(string $id)
    {
        $category = VisaCategory::findOrFail($id);
        return view('admin.visa-categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $category = VisaCategory::findOrFail($id);
        $category->update($request->only(['name','description','icon']));
        return redirect()->route('admin.visa-categories.index')->with('success', 'Visa category updated!');
    }

    public function destroy(string $id)
    {
        VisaCategory::findOrFail($id)->delete();
        return redirect()->route('admin.visa-categories.index')->with('success', 'Category deleted!');
    }
}
