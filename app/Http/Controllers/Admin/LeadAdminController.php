<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class LeadAdminController extends Controller
{
    public function index()
    {
        $leads = Lead::with('assignedConsultant')->orderBy('created_at', 'desc')->paginate(15);
        $consultants = User::where('role', 'consultant')->get();
        return view('admin.leads.index', compact('leads', 'consultants'));
    }

    public function create()
    {
        return view('admin.leads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        Lead::create([
            'name'               => $request->name,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'country_interested' => $request->country_interested,
            'visa_type'          => $request->visa_type,
            'source'             => $request->source ?? 'website',
            'notes'              => $request->notes,
            'status'             => 'new',
        ]);

        return redirect()->route('admin.leads.index')->with('success', 'Lead added to pipeline!');
    }

    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        $consultants = User::where('role', 'consultant')->get();
        return view('admin.leads.show', compact('lead', 'consultants'));
    }

    public function assign(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $lead->assigned_to = $request->assigned_to;
        $lead->status = 'contacted';
        $lead->save();

        return back()->with('success', 'Lead assigned successfully!');
    }

    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $request->validate([
            'status' => 'required|in:new,contacted,qualified,converted,lost',
            'notes'  => 'nullable|string',
        ]);

        $lead->status = $request->status;
        $lead->notes  = $request->notes;
        if ($request->assigned_to) {
            $lead->assigned_to = $request->assigned_to;
        }
        $lead->save();

        return back()->with('success', 'Lead updated successfully!');
    }

    public function destroy($id)
    {
        Lead::findOrFail($id)->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted!');
    }
}
