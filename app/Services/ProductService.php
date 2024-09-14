<?php

namespace App\Services;

use App\Interfaces\IProductRepository;
use App\Shared\AuthCredentials;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductService
{
    private IProductRepository $_productRepository;
    public function __construct(IProductRepository $productRepository)
    {
        $this->_productRepository = $productRepository;
    }

    public function create(array $data)
    {
        if (AuthCredentials::userIsSuperAdmin()) {
            Validator::make($data, [
                'name' => 'required|string',
                'description' => 'required|string',
            ])->validate();
            $this->_productRepository->create($data);
        } else {
            throw new AuthenticationException("No tienes permisos para realizar esta acción");
        }
    }

    public function all()
    {
        return $this->_productRepository->all();
    }

    public function find($id)
    {
        $instance = $this->_productRepository->find($id);
        if ($instance === null) {
            throw new NotFoundHttpException("Producto no encontrado con el id: $id");
        }
        return $instance;
    }
}
