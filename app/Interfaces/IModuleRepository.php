<?php

namespace App\Interfaces;

use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;

interface IModuleRepository
{
    public function all(): Collection;
    public function find($id): ?Module;
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
