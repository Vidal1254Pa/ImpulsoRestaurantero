<?php

namespace App\Http\Controllers;

use App\Services\SuppliersCompanyService;
use Illuminate\Http\Request;

class SuppliersCompanyController extends Controller
{
    private SuppliersCompanyService $_suppliersCompanyService;

    public function __construct(SuppliersCompanyService $suppliersCompanyService)
    {
        $this->_suppliersCompanyService = $suppliersCompanyService;
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        return $this->_suppliersCompanyService->create($id, $data);
    }

    public function index()
    {
        return $this->_suppliersCompanyService->all();
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        return $this->_suppliersCompanyService->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->_suppliersCompanyService->delete($id);
    }
}
