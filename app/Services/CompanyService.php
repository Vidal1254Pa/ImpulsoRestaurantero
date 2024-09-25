<?php

namespace App\Services;

use App\Interfaces\ICompanyRepository;
use App\Shared\AuthCredentials;
use App\Shared\OnExecuteServiceAwaitResponse;
use App\Shared\ResponsesGeneral;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyService
{
    private ICompanyRepository $_companyRepository;

    public function __construct(ICompanyRepository $companyRepository)
    {
        $this->_companyRepository = $companyRepository;
    }
    public function all()
    {
        return OnExecuteServiceAwaitResponse::success(
            dataInjected: ['data' => $this->_companyRepository->all()],
            withOutMessage: true,
            code: 200
        );
    }
    //TODO:Consultar si solo podran crear los super admins
    public function create(array $data)
    {
        Validator::make($data, [
            'name' => 'required',
            'website' => 'required',
            'logo' => 'required',
            'email' => 'required',
        ])->validate();
        $data['created_by'] = AuthCredentials::getCredentialsUserId();
        $instance = $this->_companyRepository->create($data);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 201,
            dataInjected: ['id' => $instance->id]
        );
    }

    public function update($id, array $data)
    {
        Validator::make($data, [
            'name' => 'required',
            'website' => 'required',
            'logo' => 'required',
            'email' => 'required',
        ])->validate();
        $this->find($id);
        $this->_companyRepository->update($id, $data);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 200,
        );
    }

    public function find($id)
    {
        $instance = $this->_companyRepository->find($id);
        if ($instance === null) {
            throw new NotFoundHttpException("Compañia no encontrada con el id: $id", null, 404);
        }
        return $instance;
    }

    public function delete($id)
    {
        $this->find($id);
        $this->_companyRepository->delete($id);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 200,
        );
    }
}
