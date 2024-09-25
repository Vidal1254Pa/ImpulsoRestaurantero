<?php

namespace App\Interfaces;

interface IHeadquarterRepository
{
    public function create(int $company_id, array $data);
    public function addUser();
}
