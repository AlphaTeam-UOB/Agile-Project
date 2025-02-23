<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Show all appointments
    public function index()
    {
        $appointments = Appointment::all();
        return view('AdminSide.Appointments.index', compact('appointments'));
    }

    // Show form for creating a new appointment
    public function create()
    {
        return view('AdminSide.Appointments.create');
    }

    // Store a new appointment
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'status' => 'required|in:Scheduled,Completed,Cancelled',
        ]);

        Appointment::create([
            'name' => $request->name,
            'email' => $request->email,
            'date' => $request->date,
            'time' => $request->time,
            'status' => $request->status,
        ]);

        return redirect()->route('AdminSide.Appointments.index')->with('success', 'Appointment created successfully!');
    }

    // Show the form for editing an appointment
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('AdminSide.Appointments.edit', compact('appointment'));
    }

    // Update an appointment
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'status' => 'required|in:Scheduled,Completed,Cancelled',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'name' => $request->name,
            'email' => $request->email,
            'date' => $request->date,
            'time' => $request->time,
            'status' => $request->status,
        ]);

        return redirect()->route('AdminSide.Appointments.index')->with('success', 'Appointment updated successfully!');
    }

    // Delete an appointment
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('AdminSide.Appointments.index')->with('success', 'Appointment deleted successfully!');
    }
}