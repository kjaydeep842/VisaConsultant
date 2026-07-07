<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamAdminController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->paginate(20);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'designation'=> 'required|string|max:255',
        ]);

        TeamMember::create([
            'name'        => $request->name,
            'designation' => $request->designation,
            'bio'         => $request->bio,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'avatar'      => $request->avatar,
            'linkedin'    => $request->linkedin,
            'sort_order'  => $request->sort_order ?? 0,
            'status'      => $request->status ?? 'active',
        ]);

        return redirect()->route('admin.team.index')->with('success', 'Team member added!');
    }

    public function edit(string $id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.team.edit', compact('member'));
    }

    public function update(Request $request, string $id)
    {
        $member = TeamMember::findOrFail($id);
        $member->update($request->only(['name','designation','bio','email','phone','avatar','linkedin','sort_order','status']));
        return redirect()->route('admin.team.index')->with('success', 'Team member updated!');
    }

    public function destroy(string $id)
    {
        TeamMember::findOrFail($id)->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted!');
    }
}
