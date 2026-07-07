<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $consultants = User::where('role', 'consultant')->where('status', 'active')->get(['id', 'name']);
        return view('web.appointment', compact('consultants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email',
            'client_phone' => 'required|string',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'meeting_type' => 'required|in:offline,online_meet,zoom,whatsapp',
            'branch' => 'nullable|string',
            'purpose' => 'nullable|string',
        ]);

        $appointment = Appointment::create([
            'user_id' => auth()->id(),
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'client_phone' => $request->client_phone,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'meeting_type' => $request->meeting_type,
            'branch' => $request->branch,
            'purpose' => $request->purpose,
            'consultant_id' => $request->consultant_id,
            'status' => 'pending',
        ]);

        // TODO: Send confirmation email/SMS

        return redirect()->route('appointment.success', $appointment->booking_ref);
    }

    public function success($ref)
    {
        $appointment = Appointment::where('booking_ref', $ref)->firstOrFail();
        return view('web.appointment-success', compact('appointment'));
    }
}
