<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadquarterController extends Controller
{
    
    public function addUser()
    {
        return response()->json(['message' => 'Welcome to the Headquarter']);
    }
}
