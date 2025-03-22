<?php

namespace App\Http\Controllers\CustomerControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google\Client as Google_Client;
use Illuminate\Support\Facades\Log;
use App\Models\Appointment; // Import the Appointment model

class ChatbotController extends Controller
{  public function handleRequest(Request $request)
    {
        \Log::info('Chatbot request received:', $request->all());

        // Get the user's message from the request
        $userMessage = $request->input('message');

        // Get the output contexts from the request (if any)
        $outputContexts = $request->input('queryResult.outputContexts', []);

        // Send the message to Dialogflow and get the response
        $responseText = $this->sendToDialogflow($userMessage, $outputContexts);

        // Return the response as JSON
        return response()->json([
            "fulfillmentText" => $responseText
        ]);
    }

    private function sendToDialogflow($userMessage, $outputContexts)
    {
        try {
            // Path to your Dialogflow service account key
            $credentialsPath = storage_path('app/dialogflow-key.json');
            $projectId = env('DIALOGFLOW_PROJECT_ID');
            $sessionId = uniqid();

            // Create a Google_Client instance
            $client = new Google_Client();
            $client->setAuthConfig($credentialsPath);
            $client->addScope('https://www.googleapis.com/auth/dialogflow');

            // Get the Guzzle HTTP client
            $httpClient = $client->authorize();

            // Define the Dialogflow API endpoint
            $url = "https://dialogflow.googleapis.com/v2/projects/$projectId/agent/sessions/$sessionId:detectIntent";

            // Send the POST request to Dialogflow
            $response = $httpClient->post($url, [
                'json' => [
                    'queryInput' => [
                        'text' => [
                            'text' => $userMessage,
                            'languageCode' => 'en-US',
                        ],
                    ],
                    'queryParams' => [
                        'contexts' => $outputContexts,
                    ],
                ],
            ]);

            // Decode the response
            $responseData = json_decode($response->getBody(), true);

            // Log the full response for debugging
            \Log::info('Dialogflow API Response:', $responseData);

            // Check if the response contains the expected key
            if (!isset($responseData['queryResult'])) {
                throw new \Exception('Invalid response from Dialogflow API: queryResult key missing.');
            }

            // Handle the intent locally
            $intentName = $responseData['queryResult']['intent']['displayName'];
            $parameters = $responseData['queryResult']['parameters'];

            // Safely access outputContexts (default to an empty array if not present)
            $outputContexts = $responseData['queryResult']['outputContexts'] ?? [];

            // Handle the intent based on the intent name
            switch ($intentName) {
                case 'Cancel Appointment Intent':
                    return $this->cancelAppointment($parameters, $outputContexts);
                case 'Reschedule Appointment Intent':
                        return $this->rescheduleAppointment($parameters, $outputContexts);
                case 'BookAppointmentIntent':
            case 'Schedule Appointment Intent':
                    return $this->bookAppointment($parameters, $outputContexts);
                case 'CheckAvailabilityIntent':
                    return $this->checkAvailability($parameters, $outputContexts);
                default:
                    return $responseData['queryResult']['fulfillmentText'];
            }
        } catch (\Exception $e) {
            \Log::error('Dialogflow Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(), // Log the full stack trace
            ]);
            return "Sorry, something went wrong. Please try again later.";
        }
    }
    
    private function isAvailabilityFollowUp($outputContexts)
    {
        // Check if the context for checking availability exists
        foreach ($outputContexts as $context) {
            if (strpos($context['name'], 'checkavailabilityintent_dialog_context') !== false) {
                return true;
            }
        }
        return false;
    }
    
    private function handleAvailabilityFollowUp($userMessage, $outputContexts)
    {
        try {
            // Extract the date from the context
            $date = $this->getContextParameter($outputContexts, 'checkavailabilityintent_dialog_context', 'date');
    
            // Parse the time from the user's message
            $time = date('H:i:s', strtotime($userMessage));
    
            // Check for available slots
            $availableSlots = $this->getAvailableSlots($date, $time);
    
            if ($availableSlots) {
                return "Yes, there are available slots on $date at $time.";
            } else {
                return "Sorry, there are no available slots on $date at $time.";
            }
        } catch (\Exception $e) {
            \Log::error('Availability Follow-Up Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return "Sorry, I couldn't check the availability. Please try again later.";
        }
    }
    
    private function checkAvailability($parameters, $outputContexts)
    {
        try {
            // Extract the date from the parameters
            $date = $parameters['date'] ?? null;
    
            // Validate the date
            if (empty($date)) {
                return "Please provide a valid date to check availability.";
            }
    
            // Check for available slots
            $availableSlots = $this->getAvailableSlots($date);
    
            if ($availableSlots) {
                return "Yes, there are available slots on $date. Do you have a specific time in mind?";
            } else {
                return "Sorry, there are no available slots on $date.";
            }
        } catch (\Exception $e) {
            \Log::error('Availability Check Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return "Sorry, I couldn't check the availability. Please try again later.";
        }
    }
    
    private function getAvailableSlots($date, $time = null)
    {
        // Fetch available slots from the database
        $query = Appointment::where('date', $date)
            ->where('status', 'Pending');
    
        if ($time) {
            $query->where('time', $time);
        }
    
        return $query->exists();
    }
    
    private function getContextParameter($outputContexts, $contextName, $parameterName)
    {
        foreach ($outputContexts as $context) {
            if (strpos($context['name'], $contextName) !== false) {
                return $context['parameters'][$parameterName] ?? null;
            }
        }
        return null;
    }

    private function bookAppointment($parameters, $outputContexts)
    {
        try {
            // Log the parameters for debugging
            \Log::info('Booking Appointment Parameters:', $parameters);
    
            // Extract date and time from parameters
            $date = $parameters['date'][0] ?? null; // Take the first element if it's an array
            $time = $parameters['time'][0] ?? null; // Take the first element if it's an array
    
            // Validate date and time
            if (empty($date) || empty($time)) {
                return "Please provide a valid date and time for the appointment.";
            }
    
            // Extract date part from $date and time part from $time
            $datePart = (new \DateTime($date))->format('Y-m-d');
            $timePart = (new \DateTime($time))->format('H:i:s');
    
            // Combine date and time into a single DateTime string
            $dateTimeString = "$datePart $timePart";
    
            // Parse the combined date and time (assuming the input is in UTC)
            $dateTimeObj = new \DateTime($dateTimeString, new \DateTimeZone('UTC'));
    
            // Convert to the user's time zone (e.g., Asia/Colombo)
            $dateTimeObj->setTimezone(new \DateTimeZone('Asia/Colombo'));
    
            // Format the date and time for display and database storage
            $formattedDate = $dateTimeObj->format('Y-m-d');
            $formattedTime = $dateTimeObj->format('H:i:s');
    
            // Handle consultation_type (convert array to string if necessary)
            $consultationType = $parameters['consultationtype'][0] ?? 'General'; // Take the first element if it's an array
    
            // Extract user details from contexts
            $name = $this->getContextParameter($outputContexts, 'awaiting_name', 'name');
            $email = $this->getContextParameter($outputContexts, 'awaiting_email', 'email');
            $description = $this->getContextParameter($outputContexts, 'awaiting_description', 'description');
    
            // Check for conflicting appointments
            $conflictingAppointment = Appointment::where('date', $formattedDate)
                ->where('time', $formattedTime)
                ->first();
    
            if ($conflictingAppointment) {
                return "Sorry, the selected time slot is already booked. Please choose another time.";
            }
    
            // Save the appointment to the database
            $appointment = Appointment::create([
                'name' => $name ?? 'Customer', // Use provided name or default
                'email' => $email ?? 'customer@example.com', // Use provided email or default
                'date' => $formattedDate,
                'time' => $formattedTime,
                'consultation_type' => $consultationType,
                'description' => $description ?? '', // Use provided description or default
                'status' => 'Scheduled', // Use 'Scheduled' instead of 'Pending'
            ]);
    
            // Return a success message with the correct time
            return "Your appointment has been booked for $formattedDate at $formattedTime. We will contact you shortly.";
        } catch (\Exception $e) {
            \Log::error('Appointment Booking Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return "Sorry, I couldn't book your appointment. Please try again later.";
        }
    }
    private function cancelAppointment($parameters, $outputContexts)
{
    try {
        // Log the parameters for debugging
        \Log::info('Cancellation Parameters:', $parameters);

        // Extract the appointment ID and email from the parameters
        $appointmentID = $parameters['appointmentID'] ?? null;
        $email = $parameters['email'] ?? null; // Fix the typo here

        // Validate the required parameters
        if (empty($appointmentID) || empty($email)) {
            return "Sorry, I couldn't process your request. Please provide both the appointment ID and your email address.";
        }

        // Find the appointment in the database
        $appointment = Appointment::where('id', $appointmentID)
            ->where('email', $email)
            ->first();

        if ($appointment) {
            // Cancel the appointment
            $appointment->update(['status' => 'Cancelled']);
            return "Your appointment (ID: $appointmentID) has been cancelled. Let me know if you need any further assistance.";
        } else {
            return "Sorry, I couldn't find your appointment. Please check the details and try again.";
        }
    } catch (\Exception $e) {
        \Log::error('Cancellation Error:', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return "Sorry, I couldn't cancel your appointment. Please try again later.";
    }
}
private function rescheduleAppointment($parameters, $outputContexts)
{
    try {
        // Log the parameters for debugging
        \Log::info('Rescheduling Parameters:', $parameters);

        // Extract the required parameters
        $email = $parameters['email'] ?? null;
        $newDate = $parameters['newDate'] ?? null;
        $newTime = $parameters['newTime'] ?? null;

        // Validate the required parameter (email)
        if (empty($email)) {
            return "Sorry, I couldn't process your request. Please provide your email address.";
        }

        // Validate that at least one of newDate or newTime is provided
        if (empty($newDate) && empty($newTime)) {
            return "Sorry, I couldn't process your request. Please provide either a new date or a new time.";
        }

        // Find the appointment in the database using the email
        $appointment = Appointment::where('email', $email)
            ->where('status', 'Scheduled') // Ensure the appointment is in a reschedulable state
            ->first();

        if (!$appointment) {
            return "Sorry, I couldn't find your appointment. Please check the details and try again.";
        }

        // Update the appointment with the new date and/or time
        if (!empty($newDate)) {
            $newDateFormatted = (new \DateTime($newDate))->format('Y-m-d');
            $appointment->date = $newDateFormatted;
        }

        if (!empty($newTime)) {
            $newTimeFormatted = (new \DateTime($newTime))->format('H:i:s');
            $appointment->time = $newTimeFormatted;
        }

        // Mark the appointment as rescheduled
        // $appointment->status = 'Rescheduled';
        $appointment->save();

        // Prepare the response message
        $responseMessage = "Your appointment has been rescheduled.";
        if (!empty($newDate)) {
            $responseMessage .= " New date: $newDateFormatted.";
        }
        if (!empty($newTime)) {
            $responseMessage .= " New time: $newTimeFormatted.";
        }
        $responseMessage .= " Let me know if you need any further assistance.";

        return $responseMessage;
    } catch (\Exception $e) {
        \Log::error('Rescheduling Error:', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return "Sorry, I couldn't reschedule your appointment. Please try again later.";
    }
}  

}