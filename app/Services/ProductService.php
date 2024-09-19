<?php

namespace App\Services;

use App\Interfaces\IProductRepository;
use App\Shared\AuthCredentials;
use App\Shared\OnExecuteServiceAwaitResponse;
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
            $data['user_id'] = AuthCredentials::getCredentialsUserId();
            $instace = $this->_productRepository->create($data);
            if ($instace === null) {
                return OnExecuteServiceAwaitResponse::error(
                    message: "Error al crear el producto",
                    code: 500,
                    error: 'Internal Server Error'
                );
            } else {
                return OnExecuteServiceAwaitResponse::success(
                    message: "Producto creado correctamente",
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
            dataInjected: ['data' => $this->_productRepository->all()],
            withOutMessage: true,
            code: 200
        );
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
