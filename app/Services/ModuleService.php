<?php

namespace App\Services;

use App\Interfaces\IModuleRepository;
use App\Interfaces\IProductRepository;
use App\Shared\AuthCredentials;
use App\Shared\OnExecuteServiceAwaitResponse;
use App\Shared\ResponsesGeneral;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ModuleService
{
    private IModuleRepository $_moduleRepository;
    public function __construct(IModuleRepository $moduleRepository)
    {
        $this->_moduleRepository = $moduleRepository;
    }

    public function create(array $data)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            Validator::make($data, [
                'name' => 'required|string',
                'description' => 'required|string',
            ])->validate();
            $data['user_id'] = AuthCredentials::getCredentialsUserId();
            $instace = $this->_moduleRepository->create($data);
            if ($instace === null) {
                return OnExecuteServiceAwaitResponse::error(
                    message: "Error al crear el modulo",
                    code: 500,
                    error: 'Internal Server Error'
                );
            } else {
                return OnExecuteServiceAwaitResponse::success(
                    message: ResponsesGeneral::SUCCESS,
                    code: 201,
                    dataInjected: ['id' => $instace->id]
                );
            }
        } else {
            return OnExecuteServiceAwaitResponse::error(
                message: "No tienes permisos para realizar esta acción",
                code: 403,
                error: 'Forbidden'
            );
        }
    }

    public function all()
    {
        return OnExecuteServiceAwaitResponse::success(
            dataInjected: ['data' => $this->_moduleRepository->all()],
            withOutMessage: true,
            code: 200
        );
    }

    public function find($id)
    {
        $instance = $this->_moduleRepository->find($id);
        if ($instance === null) {
            throw new NotFoundHttpException("Modulo no encontrado con el id: $id");
        }
        return $instance;
    }
}
