<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerNotification;
use Log;

class EmailController extends Controller
{

    public function sendEmail()
    {
        $toEmail = "beabiancaalmirez1125@gmail.com"; 
        $subject = "Your Application Confirmation";
        $messageBody = "Thank you for booking with us. Your reservation has been confirmed.";
    
        try {
            Mail::to($toEmail)->send(new CustomerNotification($subject, $messageBody));
            Log::info("Email sent to: $toEmail");
        } catch (\Exception $e) {
            Log::error("Email failed: " . $e->getMessage());
        }
    
        return "Email function executed!";
    }
    
}
