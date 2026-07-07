<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\ApplicationDocument;
use Illuminate\Support\Facades\Hash;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $applications = Application::where('user_id', $user->id)->with(['country', 'visaCategory'])->get();
        $appointments = Appointment::where('user_id', $user->id)->orderBy('appointment_date', 'desc')->take(5)->get();
        $invoices = Invoice::where('user_id', $user->id)->orderBy('created_at', 'desc')->take(5)->get();
        $documents = ApplicationDocument::whereHas('application', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->orderBy('created_at', 'desc')->take(5)->get();

        return view('client.dashboard', compact('applications', 'appointments', 'invoices', 'documents'));
    }

    public function applications()
    {
        $applications = Application::where('user_id', auth()->id())->with(['country', 'visaCategory', 'timelines'])->get();
        return view('client.applications', compact('applications'));
    }

    public function appointments()
    {
        $appointments = Appointment::where('user_id', auth()->id())->orderBy('appointment_date', 'desc')->get();
        return view('client.appointments', compact('appointments'));
    }

    public function documents()
    {
        $applications = Application::where('user_id', auth()->id())->pluck('id');
        $documents = ApplicationDocument::whereIn('application_id', $applications)->get();
        return view('client.documents', compact('documents'));
    }

    public function invoices()
    {
        $invoices = Invoice::where('user_id', auth()->id())->get();
        return view('client.invoices', compact('invoices'));
    }

    public function profile()
    {
        return view('client.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function messages()
    {
        return view('client.messages');
    }
}
