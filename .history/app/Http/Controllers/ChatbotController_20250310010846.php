<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');

        // Simple chatbot logic (You can replace this with AI API like OpenAI or Gemini)
        $botReply = $this->getBotResponse($userMessage);

        return response()->json(['reply' => $botReply]);
    }

    private function getBotResponse($message)
    {
        // Normalize user input (lowercase, trim spaces)
        $message = strtolower(trim($message));
    
        // Travel and Tour Management chatbot responses
        $responses = [
            'hi' => 'Hi there! Welcome to JVD Event and Travel Management. How can I assist you today?',
            'hello' => 'Hello! How can I help you with your travel and event needs?',
            'how are you' => 'I am just a bot, but I am here to assist you! 😊',
    
            // Booking inquiries
            'book vehicle' => 'To book a vehicle, visit our Vehicle Reservation section and select an available vehicle.',
            'cancel booking' => 'You can cancel your booking through the reservation page or by contacting our support team.',
            'modify reservation' => 'Yes, you can modify your reservation by logging into your account and selecting "Modify Booking".',
    
            // Travel-related queries
            'airport transfer' => 'Yes, we offer airport transfers for individuals and groups. Please check our transport options.',
            'travel packages' => 'We offer customized travel packages, including local tours, corporate trips, and international vacations.',
            'request travel quote' => 'You can request a travel quote through our Vendor Portal or by submitting a Travel Request Form.',
    
            // Vendor & Supplier inquiries
            'register as vendor' => 'To register as a vendor, visit our Vendor Portal and submit your details along with your services.',
            'supplier request' => 'Supplier requests can be submitted through the Supplier Request Submission section in the system.',
            'subcontractor requirements' => 'Subcontractors must provide project scope details, cost estimates, and timeline projections.',
    
            // Auction-related inquiries
            'vehicle auction' => 'Yes, we have vehicle auctions where you can bid on available units. Check our Auction Management section.',
            'participate auction' => 'You can participate in an auction by registering in our auction portal and placing your bid.',
    
            // Document tracking
            'track travel documents' => 'You can track your travel documents through the Document Tracking system under the Admin section.',
            'upload documents' => 'You can upload necessary documents in your profile or during the booking process.',
    
            // Fleet and vehicle management
            'check vehicle availability' => 'You can check vehicle availability in the Vehicle Reservation System under the Logistics section.',
            'assigned driver' => 'You can view your assigned driver details in your booking confirmation email or dashboard.',
            'report vehicle issue' => 'Vehicle issues can be reported in the Fleet Management section under "Report a Problem".',
    
            // Closing responses
            'thank you' => 'You’re welcome! Let me know if you need anything else.',
            'bye' => 'Goodbye! Have a safe and wonderful journey!',
        ];
    
        // **Improved Matching Logic**: Find best response based on keywords
        foreach ($responses as $key => $reply) {
            if (strpos($message, $key) !== false) {
                return $reply;
            }
        }
    
        // Default response if no match is found
        return 'I am not sure how to respond to that. Can you rephrase your question regarding travel and tours?';
    }
    
}
