<?php

namespace App\Services;

use App\Interfaces\IRolRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RolService
{
    private IRolRepository $_rolRepository;
    public function __construct(IRolRepository $rolRepository)
    {
        $this->_rolRepository = $rolRepository;
    }
    public function all()
    {
        return $this->_rolRepository->all();
    }
    public function find($id)
    {
        $instance = $this->_rolRepository->find($id);
        if ($instance == null) {
            throw new NotFoundHttpException("Rol no encontrado con el id: $id", null, 404);
        }
        return $instance;
    }
}
