<?php

namespace App\Http\Controllers;

use App\Services\CategoryProductsCompanyService;
use Illuminate\Http\Request;

class CategoryProductsCompanyController extends Controller
{
    private CategoryProductsCompanyService $_categoryProductsCompanyService;

    public function __construct(CategoryProductsCompanyService $categoryProductsCompanyService)
    {
        $this->_categoryProductsCompanyService = $categoryProductsCompanyService;
    }


    public function store(Request $request, $id)
    {
        $data = $request->all();
        return $this->_categoryProductsCompanyService->create($data, $id);
    }

    public function index($head_id)
    {
        return $this->_categoryProductsCompanyService->all($head_id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        return $this->_categoryProductsCompanyService->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->_categoryProductsCompanyService->delete($id);
    }
}
