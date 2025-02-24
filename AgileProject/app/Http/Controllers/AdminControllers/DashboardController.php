<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $appointments = Appointment::select('id', 'name as title', 'date as start', 'time as end')->get();

        return view('AdminSide.Dashboard', compact('totalAppointments', 'pendingAppointments', 'completedAppointments', 'appointments'));
    }
}
