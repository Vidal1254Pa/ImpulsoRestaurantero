<?php

namespace App\Interfaces;

use App\Models\Rol;
use Illuminate\Database\Eloquent\Collection;

interface IRolRepository
{
    public function all(): Collection;
    public function find($id): ?Rol;
}
