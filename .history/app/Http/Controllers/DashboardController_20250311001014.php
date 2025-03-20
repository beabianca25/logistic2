<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{

    public function index()
    {
        $users = User::latest()->take(8)->get(); // Get the latest 8 users
        return view('dashboard', compact('users'));
    }
    

}
