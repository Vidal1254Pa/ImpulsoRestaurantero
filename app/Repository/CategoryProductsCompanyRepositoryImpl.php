<?php

namespace App\Repository;

use App\Interfaces\ICategoryProductsCompanyRepository;
use App\Models\CategoryProductsCompany;
use Illuminate\Database\Eloquent\Collection;

class CategoryProductsCompanyRepositoryImpl implements ICategoryProductsCompanyRepository
{
    private CategoryProductsCompany $_categoryProductsCompany;

    public function __construct(CategoryProductsCompany $categoryProductsCompany)
    {
        $this->_categoryProductsCompany = $categoryProductsCompany;
    }

    public function create($request, $head_id)
    {
        return $this->_categoryProductsCompany->create([
            'headquarters_company_id' => $head_id,
            'name' => $request['name'],
            'description' => $request['description'],
            'created_by' => $request['created_by'],
        ]);
    }

    public function update($request, $id)
    {
        return $this->_categoryProductsCompany->where('id', $id)->update([
            'name' => $request['name'],
            'description' => $request['description'],
        ]);
    }

    public function delete($id)
    {
        return $this->_categoryProductsCompany->where('id', $id)->delete();
    }

    public function all($head_id): Collection
    {
        return $this->_categoryProductsCompany->where('headquarters_company_id', $head_id)->get();
    }

    public function find($id): ?CategoryProductsCompany
    {
        return $this->_categoryProductsCompany->find($id);
    }
}
