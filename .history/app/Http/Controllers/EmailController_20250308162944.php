<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerNotification;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $toEmail = "customer@example.com"; // Change to actual recipient
        $subject = "Your Booking Confirmation";
        $messageBody = "Thank you for booking with us. Your reservation has been confirmed.";

        Mail::to($toEmail)->send(new CustomerNotification($subject, $messageBody));

        return "Email sent successfully!";
    }
}
