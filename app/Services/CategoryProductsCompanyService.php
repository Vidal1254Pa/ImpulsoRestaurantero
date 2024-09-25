<?php

namespace App\Services;

use App\Interfaces\ICategoryProductsCompanyRepository;
use App\Shared\AuthCredentials;
use App\Shared\OnExecuteServiceAwaitResponse;
use App\Shared\ResponsesGeneral;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryProductsCompanyService
{
    private HeadquarterService $_headquarterService;
    private ICategoryProductsCompanyRepository $_categoryProductsCompanyRepository;
    public function __construct(HeadquarterService $headquarterService, ICategoryProductsCompanyRepository $categoryProductsCompanyRepository)
    {
        $this->_headquarterService = $headquarterService;
        $this->_categoryProductsCompanyRepository = $categoryProductsCompanyRepository;
    }

    public function create($request, $head_id)
    {
        Validator::make($request, [
            'name' => 'required|string',
            'description' => 'required|string',
        ])->validate();
        $this->_headquarterService->find($head_id);
        $request['created_by'] = AuthCredentials::getCredentialsUserId();
        $request['headquarters_company_id'] = $head_id;
        $instance = $this->_categoryProductsCompanyRepository->create($request, $head_id);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 201,
            dataInjected: ['id' => $instance->id]
        );
    }

    public function find($id)
    {
        $instance = $this->_categoryProductsCompanyRepository->find($id);
        if ($instance === null) {
            throw new NotFoundHttpException('Categoría no encontrada', null, 404);
        }
        return $instance;
    }

    public function all($head_id)
    {
        $this->_headquarterService->find($head_id);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 200,
            withOutMessage: true,
            dataInjected: ['data' => $this->_categoryProductsCompanyRepository->all($head_id)]
        );
    }

    public function update($request, $id)
    {
        Validator::make($request, [
            'name' => 'required|string',
            'description' => 'required|string',
        ])->validate();
        $this->find($id);
        $this->_categoryProductsCompanyRepository->update($request, $id);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 200,
        );
    }

    public function delete($id)
    {
        $this->find($id);
        $this->_categoryProductsCompanyRepository->delete($id);
        return OnExecuteServiceAwaitResponse::success(
            message: ResponsesGeneral::SUCCESS,
            code: 200,
        );
    }
}
