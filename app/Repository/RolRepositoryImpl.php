<?php

namespace App\Repository;

use App\Interfaces\IRolRepository;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Collection;

class RolRepositoryImpl implements IRolRepository
{
    private Rol $_rolDb;
    public function __construct(Rol $rolDb)
    {
        $this->_rolDb = $rolDb;
    }
    public function all(): Collection
    {
        return $this->_rolDb->all();
    }

    public function find($id): ?Rol
    {
        return $this->_rolDb->find($id);
    }
}
