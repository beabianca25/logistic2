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
         // Travel and Tour Management chatbot responses
    $responses = [
        'hi' => 'Hi there! Welcome to JVD Event and Travel Management. How can I assist you today?',
        'hello' => 'Hello! How can I help you with your travel and event needs?',
        'how are you' => 'I am just a bot, but I am here to assist you! 😊',

        // Booking inquiries
        'how do I book a vehicle?' => 'To book a vehicle, visit our Vehicle Reservation section and select an available vehicle.',
        'how do I cancel my booking?' => 'You can cancel your booking through the reservation page or by contacting our support team.',
        'can I modify my reservation?' => 'Yes, you can modify your reservation by logging into your account and selecting "Modify Booking".',

        // Travel-related queries
        'do you provide airport transfers?' => 'Yes, we offer airport transfers for individuals and groups. Please check our transport options.',
        'what travel packages do you offer?' => 'We offer customized travel packages, including local tours, corporate trips, and international vacations.',
        'how can I request a travel quote?' => 'You can request a travel quote through our Vendor Portal or by submitting a Travel Request Form.',

        // Vendor & Supplier inquiries
        'how can I register as a vendor?' => 'To register as a vendor, visit our Vendor Portal and submit your details along with your services.',
        'how do I submit a supplier request?' => 'Supplier requests can be submitted through the Supplier Request Submission section in the system.',
        'what are the requirements for subcontractors?' => 'Subcontractors must provide project scope details, cost estimates, and timeline projections.',

        // Auction-related inquiries
        'do you have vehicle auctions?' => 'Yes, we have vehicle auctions where you can bid on available units. Check our Auction Management section.',
        'how do I participate in an auction?' => 'You can participate in an auction by registering in our auction portal and placing your bid.',

        // Document tracking
        'how can I track my travel documents?' => 'You can track your travel documents through the Document Tracking system under the Admin section.',
        'where can I upload my documents?' => 'You can upload necessary documents in your profile or during the booking process.',

        // Fleet and vehicle management
        'how do I check vehicle availability?' => 'You can check vehicle availability in the Vehicle Reservation System under the Logistics section.',
        'who is my assigned driver?' => 'You can view your assigned driver details in your booking confirmation email or dashboard.',
        'how do I report a vehicle issue?' => 'Vehicle issues can be reported in the Fleet Management section under "Report a Problem".',

        // Closing responses
        'thank you' => 'You’re welcome! Let me know if you need anything else.',
        'bye' => 'Goodbye! Have a safe and wonderful journey!',
        'default' => 'I am not sure how to respond to that. Can you rephrase your question regarding travel and tours?',
    ];

        $message = strtolower(trim($message));

        return $responses[$message] ?? $responses['default'];
    }
}
