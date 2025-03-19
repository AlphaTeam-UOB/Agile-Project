<?php

namespace App\Http\Controllers\CustomerControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google\Client as Google_Client;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function handleRequest(Request $request)
    {
        \Log::info('Chatbot request received:', $request->all());

        // Get the user's message from the request
        $userMessage = $request->input('message');

        // Send the message to Dialogflow and get the response
        $responseText = $this->sendToDialogflow($userMessage);

        // Return the response as JSON
        return response()->json([
            "fulfillmentText" => $responseText
        ]);
    }

    private function sendToDialogflow($userMessage)
    {
        try {
            // Path to your Dialogflow service account key
            $credentialsPath = storage_path('app/dialogflow-key.json');
            $projectId = env('DIALOGFLOW_PROJECT_ID');
            $sessionId = uniqid();

            // Log service account details
            $credentials = json_decode(file_get_contents($credentialsPath), true);
            \Log::info('Service Account Details:', [
                'client_email' => $credentials['client_email'],
                'project_id' => $credentials['project_id'],
            ]);

            // Log the request payload
            \Log::info('Dialogflow API Request Payload:', [
                'projectId' => $projectId,
                'sessionId' => $sessionId,
                'queryInput' => [
                    'text' => [
                        'text' => $userMessage,
                        'languageCode' => 'en-US',
                    ],
                ],
            ]);

            // Create a Google_Client instance
            $client = new Google_Client();
            $client->setAuthConfig($credentialsPath);
            $client->addScope('https://www.googleapis.com/auth/dialogflow');

            // Log the Google_Client configuration
            \Log::info('Google_Client Configuration:', [
                'auth_config' => $credentialsPath,
                'scopes' => $client->getScopes(),
            ]);

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

            // Get the fulfillment text from the response
            return $responseData['queryResult']['fulfillmentText'];
        } catch (\Exception $e) {
            \Log::error('Dialogflow Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(), // Log the full stack trace
            ]);
            return "Sorry, something went wrong. Please try again later.";
        }
    }
}