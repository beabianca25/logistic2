<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerNotification;
use Log;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $toEmail = $request->input('email');  // Get email from input form
        $subject = $request->input('subject'); // Get subject from input form
        $messageBody = $request->input('message'); // Get message from input form

        try {
            Mail::to($toEmail)->send(new CustomerNotification($subject, $messageBody));
            Log::info("Email sent to: $toEmail with subject: $subject");
            return response()->json(['success' => 'Email sent successfully!']);
        } catch (\Exception $e) {
            Log::error("Email failed: " . $e->getMessage());
            return response()->json(['error' => 'Failed to send email.']);
        }
    }
}
