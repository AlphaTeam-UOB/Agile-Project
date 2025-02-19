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
    // Sample data for now (replace this with your actual data later)
    $appointments = [
        [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'date' => '2025-02-20',
            'time' => '10:00 AM',
            'status' => 'Scheduled',
        ],
        [
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'date' => '2025-02-21',
            'time' => '2:00 PM',
            'status' => 'Scheduled',
        ]
    ];

    // Pass data to the view
    return view('AdminSide.Appointments', compact('appointments'));
}


    // Manage Appointments
    public function manageAppointments(Request $request)
    {
        // Logic to manage appointments
    }
}
