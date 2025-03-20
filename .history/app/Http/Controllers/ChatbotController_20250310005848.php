<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');

        // Call OpenAI API (example)
        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer YOUR_OPENAI_API_KEY',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4',
                'messages' => [['role' => 'user', 'content' => $message]],
            ],
        ]);

        $result = json_decode($response->getBody(), true);
        return response()->json(['reply' => $result['choices'][0]['message']['content']]);
    }
}
