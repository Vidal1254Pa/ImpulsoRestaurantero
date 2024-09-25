<?php

namespace App\Repository;

use App\Interfaces\IRolRepository;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Collection;

class RolRepositoryImpl implements IRolRepository
{
    private Rol $_rol;
    public function __construct(Rol $rol)
    {
        $this->_rol = $rol;
    }
    public function all(): Collection
    {
        return $this->_rol->all();
    }

    public function find($id): ?Rol
    {
        return $this->_rol->find($id);
    }
}
