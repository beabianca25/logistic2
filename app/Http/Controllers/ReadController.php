<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function index() 
    {
        return view('email.read');
    }
}
