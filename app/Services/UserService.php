<?php

namespace App\Services;

use App\Interfaces\IUserRepository;
use App\Shared\AuthCredentials;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Validator;

class UserService
{
    private IUserRepository $_userRepository;
    private RolService $_rolService;
    public function __construct(IUserRepository $userRepository, RolService $rolService)
    {
        $this->_userRepository = $userRepository;
        $this->_rolService = $rolService;
    }

    public function create($request)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'role_id' => 'required'
            ])->validate();
            $this->_rolService->find($request->role_id);
            $this->_userRepository->create($request);
        } else {
            throw new AuthenticationException("No tienes permisos para realizar esta acción");
        }
    }
    public function assignPlan($userId, $planId)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            $this->_userRepository->assignPlanToUser($userId, $planId);
        } else {
            throw new AuthenticationException("No tienes permisos para realizar esta acción");
        }
    }
}
