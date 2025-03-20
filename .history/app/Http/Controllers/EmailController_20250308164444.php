<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerNotification;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate the request input
        $request->validate([
            'recipient' => 'required|email', // Ensure recipient is a valid email address
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        try {
            // Send email using Laravel's Mail facade
            Mail::to($request->recipient)->send(new CustomerNotification($request->subject, $request->message));
    
            return response()->json(['message' => 'Email has been sent!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Email failed to send: ' . $e->getMessage()], 500);
        }
    }
    
}
