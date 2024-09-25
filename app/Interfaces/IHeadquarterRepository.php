<?php

namespace App\Interfaces;

use App\Models\HeadquartersCompany;

interface IHeadquarterRepository
{
    public function create(int $company_id, array $data);
    public function find($id): ?HeadquartersCompany;
    public function addUser($head_id, $user_id, $created_by);
}
