<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $_userService;
    public function __construct(UserService $userService)
    {
        $this->_userService = $userService;
    }
    public function store(Request $request)
    {
        $this->_userService->create($request);
        return response()->json(['message' => 'user created successfully']);
    }

    public function test_create(Request $request)
    {
        $this->_userService->test_create($request);
        return response()->json(['message' => 'user created successfully']);
    }
}
