<?php

namespace App\Services;

use App\Interfaces\IUserRepository;
use App\Shared\AuthCredentials;

class AuthService
{
    private IUserRepository $_userRepository;
    public function __construct(IUserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function login($request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function respondWithToken($token)
    {
        $instanceUserDetail = [
            'email' => AuthCredentials::getCredentialsEmail(),
            'nombre' => AuthCredentials::getCredentialsUserName(),
            'rol' => $this->_userRepository->getRolByUserId(
                AuthCredentials::getCredentialsUserId()
            )->name,
            'hasCompanies' => $this->_userRepository->hasCompaniesByUserId(
                AuthCredentials::getCredentialsUserId()
            ),
            'hasPlan' => $this->_userRepository->hasPlanByUserId(
                AuthCredentials::getCredentialsUserId()
            ),
            'companies' => $this->_userRepository->getCompaniesByUserId(
                AuthCredentials::getCredentialsUserId()
            ),
            'plan' => $this->_userRepository->getPlanByUserId(
                AuthCredentials::getCredentialsUserId()
            )
        ];
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => [...$instanceUserDetail]
        ]);
    }
}
