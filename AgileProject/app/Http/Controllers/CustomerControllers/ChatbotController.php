<?php

namespace App\Http\Controllers\CustomerControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;

class ChatbotController extends Controller
{
    public function handle(Request $request)
    {
        $intent = $request->input('queryResult.intent.displayName');

        switch ($intent) {
            case 'CheckAvailableSlots':
                return $this->checkAvailableSlots();
            case 'BookAppointment':
                return $this->bookAppointment($request);
            case 'CancelAppointment':
                return $this->cancelAppointment($request);
            default:
                return response()->json(['fulfillmentText' => 'Sorry, I did not understand that.']);
        }
    }

    private function checkAvailableSlots()
    {
        $availableSlots = Appointment::where('available', true)->pluck('time')->toArray();
        return response()->json([
            'fulfillmentText' => empty($availableSlots) ? 'No available slots.' : 'Available slots: ' . implode(', ', $availableSlots)
        ]);
    }

    private function bookAppointment(Request $request)
    {
        $params = $request->input('queryResult.parameters');

        $appointment = Appointment::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'date' => $params['date'],
            'time' => $params['time'],
            'consultation_type' => $params['consultation_type'],
            'description' => $params['description'],
            'available' => false
        ]);

        return response()->json(['fulfillmentText' => 'Your appointment is booked for ' . $params['date'] . ' at ' . $params['time']]);
    }

    private function cancelAppointment(Request $request)
    {
        $params = $request->input('queryResult.parameters');

        $appointment = Appointment::where('email', $params['email'])
                                  ->where('date', $params['date'])
                                  ->where('time', $params['time'])
                                  ->first();

        if ($appointment) {
            $appointment->delete();
            return response()->json(['fulfillmentText' => 'Your appointment has been canceled.']);
        } else {
            return response()->json(['fulfillmentText' => 'No appointment found with the provided details.']);
        }
    }
}
