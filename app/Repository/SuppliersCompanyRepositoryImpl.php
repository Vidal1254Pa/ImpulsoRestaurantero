<?php

namespace App\Repository;

use App\Interfaces\ISuppliersCompanyRepository;
use App\Models\SuppliersCompany;

class SuppliersCompanyRepositoryImpl implements ISuppliersCompanyRepository
{
    private SuppliersCompany $_suppliersCompany;

    public function __construct(SuppliersCompany $suppliersCompany)
    {
        $this->_suppliersCompany = $suppliersCompany;
    }

    public function all()
    {
        return $this->_suppliersCompany->all();
    }

    public function find($id)
    {
        return $this->_suppliersCompany->find($id);
    }

    public function create($company_id, $data)
    {
        return $this->_suppliersCompany->create([
            'company_id' => $company_id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'created_by' => $data['created_by']
        ]);
    }

    public function update($id, $data)
    {
        return $this->_suppliersCompany->find($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
    }

    public function delete($id)
    {
        return $this->_suppliersCompany->find($id)->delete();
    }
}
