<?php

namespace App\Services;

use App\Interfaces\IHeadquarterRepository;

class HeadquarterService
{
    private IHeadquarterRepository $_headquarterRepository;
    
    public function __construct(IHeadquarterRepository $headquarterRepository)
    {
        $this->_headquarterRepository = $headquarterRepository;
    }
    public function create(int $company_id, array $data)
    {
        return $company_id;
    }

    public function addUser()
    {
        return 'addUser';
    }
}
