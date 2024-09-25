<?php

namespace App\Repository;

use App\Interfaces\IHeadquarterRepository;
use App\Models\HeadquartersCompany;
use App\Models\UserHeadquarters;

class HeadquarterRepositoryImpl implements IHeadquarterRepository
{
    private UserHeadquarters $_user_headquarter;
    private HeadquartersCompany $_headquarter_company;
    public function __construct(UserHeadquarters $user_headquarter, HeadquartersCompany $headquarter_company)
    {
        $this->_user_headquarter = $user_headquarter;
        $this->_headquarter_company = $headquarter_company;
    }

    public function create(int $company_id, array $data)
    {
        return $this->_headquarter_company->create([
            'name' => $data['name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'company_id' => $company_id,
            'created_by' => $data['user_id'],
        ]);
    }

    public function addUser() {}
}
