<?php

namespace App\Interfaces;

use App\Models\CategoryProductsCompany;
use Illuminate\Database\Eloquent\Collection;

interface ICategoryProductsCompanyRepository
{
    public function create($request, $head_id);
    public function update($request, $id);
    public function delete($id);
    public function all($head_id): Collection;
    public function find($id): ?CategoryProductsCompany;
}
