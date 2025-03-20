<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerNotification;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:32768' // 32MB file size limit
        ]);

        $toEmail = $request->input('email');
        $subject = $request->input('subject');
        $messageBody = $request->input('message');
        $attachment = $request->file('attachment');

        try {
            // Pass attachment to Mailable if exists
            Mail::to($toEmail)->send(new CustomerNotification($subject, $messageBody, $attachment));

            Log::info("Email sent to: $toEmail with subject: $subject");
            return response()->json(['success' => 'Email sent successfully!']);
        } catch (\Exception $e) {
            Log::error("Email failed: " . $e->getMessage());
            return response()->json(['error' => 'Failed to send email.']);
        }
    }
}
