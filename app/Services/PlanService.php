<?php

namespace App\Services;

use App\Interfaces\IPlanRepository;
use App\Shared\AuthCredentials;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlanService
{
    private IPlanRepository $_planRepository;
    private ProductService $_productService;
    public function __construct(IPlanRepository $planRepository, ProductService $productService)
    {
        $this->_planRepository = $planRepository;
        $this->_productService = $productService;
    }

    public function create(array $data)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            Validator::make($data, [
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric',
            ])->validate();
            $this->_planRepository->create($data);
        } else {
            throw new AuthenticationException("No tienes permisos para realizar esta acción");
        }
    }

    public function all()
    {
        return $this->_planRepository->all();
    }
    public function addProducts($id, array $data)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            DB::beginTransaction();
            try {
                $this->find($id);
                Validator::make($data, [
                    'products' => 'required|array',
                    'products.*' => 'required|integer',
                ])->validate();
                $this->_planRepository->removeProductsByPlanId($id);
                $uniqueIds = array_unique($data['products']);
                foreach ($uniqueIds as $productId) {
                    $this->_productService->find($productId);
                }
                $this->_planRepository->addProducts($id, $uniqueIds);
            } catch (Exception $e) {
                DB::rollBack();
                if ($e instanceof NotFoundHttpException) {
                    throw $e;
                }
                throw new Exception('Error al agregar productos al plan');
            }
            DB::commit();
        } else {
            throw new AuthenticationException("No tienes permisos para realizar esta acción");
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
    public function getProductsByPlanId($id)
    {
        $this->find($id);
        return $this->_planRepository->getProductsByPlanId($id);
    }
}
