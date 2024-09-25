<?php

namespace App\Services;

use App\Interfaces\IHeadquarterRepository;
use App\Shared\AuthCredentials;
use App\Shared\OnExecuteServiceAwaitResponse;
use App\Shared\ResponsesGeneral;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HeadquarterService
{
    private IHeadquarterRepository $_headquarterRepository;
    private CompanyService $_companyService;
    private UserService $_userService;

    public function __construct(IHeadquarterRepository $headquarterRepository, CompanyService $companyService, UserService $userService)
    {
        $this->_headquarterRepository = $headquarterRepository;
        $this->_companyService = $companyService;
        $this->_userService = $userService;
    }

    public function create(int $company_id, array $data)
    {
        Validator::make($data, [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ])->validate();
        $this->_companyService->find($company_id);
        $data['created_by'] = AuthCredentials::getCredentialsUserId();
        $instance = $this->_headquarterRepository->create($company_id, $data);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 201,
            dataInjected: ['id' => $instance->id]
        );
    }

    public function find($id)
    {
        $instance = $this->_headquarterRepository->find($id);
        if ($instance === null) {
            throw new NotFoundHttpException('Sede no encontrada', null, 404);
        }
        return $instance;
    }

    public function addUser($head_id, $user_id)
    {
        $this->_userService->find($user_id);
        $this->find($head_id);
        $created_by = AuthCredentials::getCredentialsUserId();
        $instance = $this->_headquarterRepository->addUser($head_id, $user_id, $created_by);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 201,
            dataInjected: ['id' => $instance->id]
        );
    }
}
