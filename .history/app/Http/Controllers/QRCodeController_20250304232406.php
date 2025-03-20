<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function generate()
    {
        $qrCode = QrCode::size(200)->generate('https://example.com');
        return view('qr-code', compact('qrCode'));
    }
}
