<?php

namespace App\Repository;

use App\Interfaces\ICompanyRepository;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepositoryImpl implements ICompanyRepository
{
    private Company $_company;

    public function __construct(Company $company)
    {
        $this->_company = $company;
    }

    public function all(): Collection
    {
        return $this->_company->all();
    }

    public function create(array $data)
    {
        return $this->_company->create([
            'name' => $data['name'],
            'website' => $data['website'],
            'logo' => $data['logo'],
            'email' => $data['email'],
            'created_by' => $data['created_by'],
        ]);
    }

    public function update($id, array $data)
    {
        return $this->_company->find($id)->update([
            'name' => $data['name'],
            'website' => $data['website'],
            'logo' => $data['logo'],
            'email' => $data['email'],
        ]);
    }

    public function delete($id)
    {
        return $this->_company->find($id)->delete();
    }

    public function find($id): ?Company
    {
        return $this->_company->find($id);
    }
}
