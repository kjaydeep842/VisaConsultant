<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingAdminController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        if ($request->hasFile('company_logo')) {
            $request->validate([
                'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);
            
            $path = $request->file('company_logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'company_logo'], ['value' => $path]);
        }

        foreach ($request->except(['_token', 'company_logo']) as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'System settings saved successfully!');
    }
}
