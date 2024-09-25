<?php

namespace App\Interfaces;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface ICompanyRepository
{
    public function all(): Collection;
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function find($id): ?Company;
}
