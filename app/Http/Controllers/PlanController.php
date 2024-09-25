<?php

namespace App\Http\Controllers;

use App\Services\PlanService;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private PlanService $_planService;
    public function __construct(PlanService $planService)
    {
        $this->_planService = $planService;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->_planService->create($data);
    }

    public function index()
    {
        return $this->_planService->all();
    }

    public function addModules(Request $request, $id)
    {
        $data = $request->all();
        return $this->_planService->addModules($id, $data);
    }

    public function getModulesByPlanId($id)
    {
        return $this->_planService->getModulesByPlanId($id);
    }

    public function assignPlanToUser(Request $request, $id)
    {
        $data = $request->all();
        return $this->_planService->assignPlanToUser($id, $data);
    }
}
