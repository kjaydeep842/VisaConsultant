<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationTimeline;
use Illuminate\Http\Request;

class ApplicationAdminController extends Controller
{
    public function index()
    {
        $applications = Application::with('user', 'country', 'visaCategory')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function create()
    {
        return view('admin.applications.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.applications.index')->with('success', 'Application recorded!');
    }

    public function show($id)
    {
        $app = Application::with(['user', 'timelines', 'documents'])->findOrFail($id);
        return view('admin.applications.show', compact('app'));
    }

    public function update(Request $request, $id)
    {
        $app = Application::findOrFail($id);
        $request->validate([
            'status'        => 'required|in:draft,submitted,under_review,documents_required,processing,approved,rejected,on_hold,completed',
            'current_stage' => 'nullable|string|max:255',
        ]);

        $app->status        = $request->status;
        $app->current_stage = $request->current_stage;
        $app->save();

        return back()->with('success', 'Application status updated successfully!');
    }

    public function addTimeline(Request $request, $id)
    {
        $app = Application::findOrFail($id);
        $request->validate([
            'stage'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ApplicationTimeline::create([
            'application_id' => $app->id,
            'stage'          => $request->stage,
            'description'    => $request->description,
            'completed_at'   => now(),
        ]);

        return back()->with('success', 'Timeline milestone added successfully!');
    }

    public function destroy($id)
    {
        Application::findOrFail($id)->delete();
        return redirect()->route('admin.applications.index')->with('success', 'Application deleted!');
    }
}
