<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentAdminController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('consultant', 'user')->orderBy('appointment_date', 'desc')->paginate(15);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('admin.appointments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name'      => 'required|string',
            'client_email'     => 'required|email',
            'client_phone'     => 'required|string',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        Appointment::create([
            'booking_ref'      => 'APT-' . strtoupper(substr(uniqid(), -6)),
            'client_name'      => $request->client_name,
            'client_email'     => $request->client_email,
            'client_phone'     => $request->client_phone,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'meeting_type'     => $request->meeting_type ?? 'video_call',
            'status'           => 'confirmed',
        ]);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment booked!');
    }

    public function update(Request $request, $id)
    {
        $apt = Appointment::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed,no_show',
        ]);

        $apt->status = $request->status;
        $apt->save();

        return back()->with('success', 'Appointment updated successfully!');
    }

    public function destroy($id)
    {
        Appointment::findOrFail($id)->delete();
        return redirect()->route('admin.appointments.index')->with('success', 'Appointment deleted successfully!');
    }
}
