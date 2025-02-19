<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AdminController extends Controller
{
    // Show Login Form
    public function loginForm()
    {
        return view('AdminSide.Login');
    }

    // Handle Login
    public function login(Request $request)
    {
        // Logic to authenticate admin (you may want to use Laravel's built-in auth system)
    }

    // Admin Dashboard
    public function dashboard()
    {
        return view('AdminSide.Dashboard');
    }

    // Admin Profile
    public function profile()
    {
        return view('AdminSide.Profile');
    }

    // Update Admin Profile
    public function updateProfile(Request $request)
    {
        // Logic to update admin profile
    }

    // Appointment Management
    public function appointments()
    {
        $appointments = Appointment::all(); // Retrieve all appointments from the database
        return view('AdminSide.Appointments', compact('appointments'));
    }

    // Manage Appointments
    public function manageAppointments(Request $request)
    {
        // Logic to manage appointments
    }
}
