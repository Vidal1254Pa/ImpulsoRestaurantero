<?php

namespace App\Services;

use App\Interfaces\IPlanRepository;
use App\Shared\AuthCredentials;
use App\Shared\OnExecuteServiceAwaitResponse;
use App\Shared\ResponsesGeneral;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlanService
{
    private IPlanRepository $_planRepository;
    private ModuleService $_moduleService;
    private UserService $_userService;
    public function __construct(IPlanRepository $planRepository, ModuleService $moduleService, UserService $userService)
    {
        $this->_planRepository = $planRepository;
        $this->_moduleService = $moduleService;
        $this->_userService = $userService;
    }

    public function create(array $data)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            Validator::make($data, [
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric',
            ])->validate();
            $data['user_id'] = AuthCredentials::getCredentialsUserId();
            $instance = $this->_planRepository->create($data);
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

    public function all()
    {
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 200,
            withOutMessage: true,
            dataInjected: ['data' => $this->_planRepository->all()]
        );
    }
    public function addModules($id, array $data)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            DB::beginTransaction();
            try {
                $this->find($id);
                Validator::make($data, [
                    'modules' => 'required|array',
                    'modules.*' => 'required|integer',
                ])->validate();
                $this->_planRepository->removeModulesByPlanId($id);
                $uniqueIds = array_unique($data['modules']);
                foreach ($uniqueIds as $productId) {
                    $this->_moduleService->find($productId);
                }
                $this->_planRepository->addModules($id, $uniqueIds, AuthCredentials::getCredentialsUserId());
            } catch (Exception $e) {
                DB::rollBack();
                if ($e instanceof NotFoundHttpException) {
                    throw $e;
                }
                throw new Exception('Error al agregar modulo al plan');
            }
            DB::commit();
            return OnExecuteServiceAwaitResponse::success(
                message: ResponsesGeneral::SUCCESS,
                code: 200,
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
        $instance = $this->_planRepository->find($id);
        if ($instance == null) {
            throw new NotFoundHttpException("El plan no existe");
        }
        return $instance;
    }
    public function getModulesByPlanId($id)
    {
        $this->find($id);
        $instance = $this->_planRepository->getModulesByPlanId($id);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 200,
            withOutMessage: true,
            dataInjected: ['data' => $instance]
        );
    }

    public function assignPlanToUser($id, array $data)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            Validator::make($data, [
                'plan_id' => 'required|integer',
            ])->validate();
            $this->find($data['plan_id']);
            $this->_userService->assignPlan($id, $data['plan_id']);
            return OnExecuteServiceAwaitResponse::success(
                message: ResponsesGeneral::SUCCESS,
                code: 200,
            );
        } else {
            return OnExecuteServiceAwaitResponse::error(
                message: "No tienes permisos para realizar esta acción",
                code: 403,
                error: 'Forbidden'
            );
        }
    }
}
