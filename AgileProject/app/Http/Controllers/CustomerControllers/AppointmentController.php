<?php


namespace App\Http\Controllers\CustomerControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    // Store appointment
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'date' => 'required|date',
            'time' => 'required|string',
            'consultation_type' => 'required|string',
            'description' => 'required|string',
        ]);

        Appointment::create($request->all());

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }

    // Fetch all appointments (optional for admin view)
    public function index()
    {
        $appointments = Appointment::latest()->get();
        return view('appointments.index', compact('appointments'));
    }
}
