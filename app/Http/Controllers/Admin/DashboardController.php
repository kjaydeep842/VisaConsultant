<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Application;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Blog;
use App\Models\Country;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_leads' => Lead::count(),
            'new_leads' => Lead::where('status', 'new')->count(),
            'total_applications' => Application::count(),
            'pending_applications' => Application::where('status', 'submitted')->orWhere('status', 'under_review')->count(),
            'today_appointments' => Appointment::where('appointment_date', today())->count(),
            'total_users' => User::where('role', 'client')->count(),
            'total_blogs' => Blog::count(),
            'total_countries' => Country::count(),
        ];

        $recentLeads = Lead::with('assignedConsultant')->orderBy('created_at', 'desc')->take(10)->get();
        $todayAppointments = Appointment::with('consultant')->whereDate('appointment_date', today())->orderBy('appointment_time')->get();
        $recentApplications = Application::with('user', 'country')->orderBy('created_at', 'desc')->take(10)->get();

        // Lead sources chart data
        $leadSources = Lead::selectRaw('source, COUNT(*) as count')
            ->groupBy('source')->pluck('count', 'source');

        // Monthly applications chart
        $monthlyApps = Application::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month');

        return view('admin.dashboard', compact(
            'stats', 'recentLeads', 'todayAppointments', 'recentApplications',
            'leadSources', 'monthlyApps'
        ));
    }

    public function analytics()
    {
        return view('admin.analytics');
    }

    public function reports()
    {
        return view('admin.reports');
    }
}
