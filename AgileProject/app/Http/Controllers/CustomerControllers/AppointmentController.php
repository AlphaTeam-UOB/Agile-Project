<?php

namespace App\Http\Controllers\CustomerControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Mail\AppointmentConfirmationMail;
use Illuminate\Support\Facades\Mail;

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

        $appointment = Appointment::create($request->all());

        // Send confirmation email
        Mail::to($request->email)->send(new AppointmentConfirmationMail($appointment));

        return redirect()->back()->with('success', 'Appointment booked successfully! A confirmation email has been sent.');
    }

    // Fetch all appointments (optional for admin view)
    public function index()
    {
        $appointments = Appointment::latest()->get();
        return view('CustomerSide.AppointmentsPage', compact('appointments'));
    }

    // Show a specific appointment

    
}
