<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountryAdminController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('sort_order')->paginate(15);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'overview' => 'required|string',
        ]);

        Country::create([
            'name' => $request->name,
            'code' => $request->code,
            'slug' => Str::slug($request->name),
            'overview' => $request->overview,
            'is_active' => true,
        ]);

        return redirect()->route('admin.countries.index')->with('success', 'Country added successfully!');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully!');
    }
}
