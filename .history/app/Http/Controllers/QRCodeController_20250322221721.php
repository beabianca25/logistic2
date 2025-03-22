<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function generate()
    {
        // Generate the URL for the supplier create page
        $url = route('supplier.create'); 
    
        // Generate the QR code with the correct URL
        $qrCode = QrCode::size(200)->generate($url);
    
        return view('QrCode', compact('qrCode'));
    }

    public function saveQrCode()
    {
        // Generate the correct URL for supplier creation
        $url = route('supplier.create');
    
        // Define the file path to store the QR code
        $path = public_path('qrcodes/qrcode.png');
    
        // Generate and save the QR code
        QrCode::format('png')->size(300)->generate($url, $path);
    
        // Return the QR code as a downloadable file
        return response()->download($path);
    }
    

}
