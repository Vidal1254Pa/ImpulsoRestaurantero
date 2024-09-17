<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $_authService;
    public function __construct(AuthService $authService)
    {
        $this->_authService = $authService;
    }
    public function refresh()
    {
        return $this->_authService->refresh();
    }

    public function login(Request $request)
    {
        return $this->_authService->login($request);
    }
}
