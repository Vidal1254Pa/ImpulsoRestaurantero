<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private UserService $_userService;
    public function __construct(UserService $userService)
    {
        $this->_userService = $userService;
    }
    public function store(Request $request)
    {
        $this->_userService->create($request);
        return response()->json(['message' => 'Admin created']);
    }
}
