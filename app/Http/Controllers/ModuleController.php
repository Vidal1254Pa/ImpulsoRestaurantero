<?php

namespace App\Http\Controllers;

use App\Services\ModuleService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    private ModuleService $_moduleService;
    public function __construct(ModuleService $moduleService)
    {
        $this->_moduleService = $moduleService;
    }
    public function store(Request $request)
    {
        $data = $request->all();
        return $this->_moduleService->create($data);
    }

    public function index()
    {
        return $this->_moduleService->all();
    }
}
