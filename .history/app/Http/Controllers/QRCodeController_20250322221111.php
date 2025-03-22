<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function generate()
    {
        $qrCode = QrCode::size(200)->generate('Supplier.Supplier.create');
        return view('QrCode', compact('qrCode'));
    }

    public function saveQrCode()
{
    $path = public_path('qrcodes/qrcode.png');
    QrCode::format('png')->size(300)->generate('Supplier.Supplier.create', $path);
    
    return response()->download($path);
}

}
