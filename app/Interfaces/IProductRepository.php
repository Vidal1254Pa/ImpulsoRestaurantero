<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface IProductRepository
{
    public function all(): Collection;
    public function find($id): ?Product;
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
