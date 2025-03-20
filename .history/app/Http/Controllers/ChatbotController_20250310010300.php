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
        // Basic chatbot logic (Modify this as needed)
        $responses = [
            'hi' => 'Hi there! How can I assist you?',
            'how are you' => 'I am just a bot, but I am doing great! 😊',
            'bye' => 'Goodbye! Have a great day!',
            'default' => 'I am not sure how to respond to that. Can you rephrase?'
        ];

        $message = strtolower(trim($message));

        return $responses[$message] ?? $responses['default'];
    }
}
