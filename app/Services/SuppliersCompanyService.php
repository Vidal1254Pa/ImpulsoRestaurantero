<?php

namespace App\Services;

use App\Interfaces\ISuppliersCompanyRepository;
use App\Shared\AuthCredentials;
use App\Shared\OnExecuteServiceAwaitResponse;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SuppliersCompanyService
{
    private ISuppliersCompanyRepository $_suppliersCompanyRepository;
    private CompanyService $_companyService;
    public function __construct(ISuppliersCompanyRepository $suppliersCompanyRepository, CompanyService $companyService)
    {
        $this->_suppliersCompanyRepository = $suppliersCompanyRepository;
        $this->_companyService = $companyService;
    }

    public function all()
    {
        return OnExecuteServiceAwaitResponse::success(
            withOutMessage: true,
            code: 200,
            dataInjected: ['data' => $this->_suppliersCompanyRepository->all()]
        );
    }

    public function create($company_id, array $data)
    {
        Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ])->validate();
        $this->_companyService->find($company_id);
        $data['created_by'] = AuthCredentials::getCredentialsUserId();
        $instance = $this->_suppliersCompanyRepository->create($company_id, $data);
        return OnExecuteServiceAwaitResponse::success(
            code: 201,
            dataInjected: ['id' => $instance->id]
        );
    }

    public function find($id)
    {
        $instance = $this->_suppliersCompanyRepository->find($id);
        if ($instance === null) {
            throw new NotFoundHttpException('Proveedor no encontrado', null, 404);
        }
        return $instance;
    }

    public function update($id, array $data)
    {
        Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ])->validate();
        $this->find($id);
        $this->_suppliersCompanyRepository->update($id, $data);
        return OnExecuteServiceAwaitResponse::success(
            code: 200
        );
    }

    public function delete($id)
    {
        $this->find($id);
        $this->_suppliersCompanyRepository->delete($id);
        return OnExecuteServiceAwaitResponse::success(
            code: 200
        );
    }
}
