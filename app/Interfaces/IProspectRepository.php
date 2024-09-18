<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IProspectRepository
{
    public function create(array $prospect);
    public function all(): Collection;
    public function delete(int $id);
}
