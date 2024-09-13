<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{
    public function create($request);
    public function update($request, $id);
    public function delete($id);
    public function all(): Collection;
    public function find($id): ?User;
}
