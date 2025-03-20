<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComposeController extends Controller
{
    public function index() 
    {
        return view('Email.Compose');
    }
}
