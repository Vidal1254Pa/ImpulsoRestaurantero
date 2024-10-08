<?php

namespace App\Services;

use App\Interfaces\IUserRepository;
use App\Shared\AuthCredentials;
use App\Shared\OnExecuteServiceAwaitResponse;
use App\Shared\ResponsesGeneral;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    private IUserRepository $_userRepository;
    private RolService $_rolService;
    public function __construct(IUserRepository $userRepository, RolService $rolService)
    {
        $this->_userRepository = $userRepository;
        $this->_rolService = $rolService;
    }

    public function test_create($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required'
        ])->validate();
        $this->_rolService->find($request->role_id);
        $request->created_by = 1;
        $this->_userRepository->create($request);
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
            $request->created_by = AuthCredentials::getCredentialsUserId();
            $instance = $this->_userRepository->create($request);
            return OnExecuteServiceAwaitResponse::success(
                message: ResponsesGeneral::SUCCESS,
                code: 201,
                dataInjected: ['id' => $instance->id]
            );
        } else {
            return OnExecuteServiceAwaitResponse::error(
                message: "No tienes permisos para realizar esta acción",
                code: 403,
                error: 'Forbidden'
            );
        }
    }
    public function find($id)
    {
        $instace = $this->_userRepository->find($id);
        if ($instace === null) {
            throw new NotFoundHttpException("Usuario no encontrado",null,404);
        }
        return $instace;
    }
    public function assignPlan($userId, $planId)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            $this->find($userId);
            $this->_userRepository->assignPlanToUser($userId, $planId);
        } else {
            throw new AuthenticationException("No tienes permisos para realizar esta acción");
        }
    }
}
