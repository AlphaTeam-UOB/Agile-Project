<?php

namespace App\Http\Controllers\CustomerControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google\Client as Google_Client;
use Illuminate\Support\Facades\Log;
use App\Models\Appointment; // Import the Appointment model

class ChatbotController extends Controller
{public function handleRequest(Request $request)
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
            $outputContexts = $responseData['queryResult']['outputContexts'];
    
            // Check if the follow-up message is related to checking availability
            if ($intentName === 'Fallback Intent' && $this->isAvailabilityFollowUp($outputContexts)) {
                return $this->handleAvailabilityFollowUp($userMessage, $outputContexts);
            }
    
            switch ($intentName) {
                case 'CheckAvailabilityIntent':
                    return $this->checkAvailability($parameters, $outputContexts);
                case 'BookAppointmnetIntent':
                    return $this->bookAppointment($parameters, $outputContexts);
                case 'show_free_slots':
                    return $this->showFreeSlots($parameters);
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
            // Extract parameters from the request
            $dateTime = $parameters['date-time']['date_time'];
    
            // Handle consultation_type (convert array to string if necessary)
            $consultationType = $parameters['consultationtype'] ?? 'General'; // Default to 'General' if not provided
            if (is_array($consultationType)) {
                $consultationType = $consultationType[0] ?? 'General'; // Take the first element if it's an array
            }
    
            // Extract user details from contexts
            $name = $this->getContextParameter($outputContexts, 'awaiting_name', 'name');
            $email = $this->getContextParameter($outputContexts, 'awaiting_email', 'email');
            $description = $this->getContextParameter($outputContexts, 'awaiting_description', 'description');
    
            // Validate the date and time
            if (empty($dateTime)) {
                return "Please provide a valid date and time for the appointment.";
            }
    
            // Parse the date and time
            $dateTimeObj = new \DateTime($dateTime, new \DateTimeZone('UTC')); // Assume UTC for consistency
            $dateTimeObj->setTimezone(new \DateTimeZone('Asia/Colombo')); // Convert to your desired timezone
    
            // Format the date and time
            $date = $dateTimeObj->format('Y-m-d');
            $time = $dateTimeObj->format('H:i:s');
    
            // Check for conflicting appointments
            $conflictingAppointment = Appointment::where('date', $date)
                ->where('time', $time)
                ->first();
    
            if ($conflictingAppointment) {
                return "Sorry, the selected time slot is already booked. Please choose another time.";
            }
    
            // Save the appointment to the database
            $appointment = Appointment::create([
                'name' => $name ?? 'Customer', // Use provided name or default
                'email' => $email ?? 'customer@example.com', // Use provided email or default
                'date' => $date,
                'time' => $time,
                'consultation_type' => $consultationType,
                'description' => $description ?? '', // Use provided description or default
                'status' => 'Pending', // Default status
            ]);
    
            // Return a success message
            return "Your appointment has been booked for $date at $time. We will contact you shortly.";
        } catch (\Exception $e) {
            \Log::error('Appointment Booking Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return "Sorry, I couldn't book your appointment. Please try again later.";
        }
    }
    
}