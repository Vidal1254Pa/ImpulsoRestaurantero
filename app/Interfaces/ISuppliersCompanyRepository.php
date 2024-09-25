<?php

namespace App\Interfaces;

interface ISuppliersCompanyRepository
{
    public function all();
    public function find($id);
    public function create($company_id, $data);
    public function update($id, $data);
    public function delete($id);
}
