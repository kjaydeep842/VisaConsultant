<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationTrackerController extends Controller
{
    public function index()
    {
        return view('web.tracker');
    }

    public function track(Request $request)
    {
        $request->validate([
            'application_id' => 'required|string',
            'passport_number' => 'required|string',
        ]);

        $application = Application::with(['timelines', 'documents', 'country', 'visaCategory'])
            ->where('application_id', strtoupper($request->application_id))
            ->where('passport_number', strtoupper($request->passport_number))
            ->first();

        if (!$application) {
            return back()->with('error', 'No application found with the provided details. Please check and try again.');
        }

        return view('web.tracker-result', compact('application'));
    }
}
