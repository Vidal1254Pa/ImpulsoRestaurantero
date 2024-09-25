<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyService $_companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->_companyService = $companyService;
    }

    public function index()
    {
        return $this->_companyService->all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->_companyService->create($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        return $this->_companyService->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->_companyService->delete($id);
    }
}
