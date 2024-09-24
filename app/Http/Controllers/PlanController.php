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
        $this->_planService->create($data);
        return response()->json(['message' => 'Plan created successfully'], 201);
    }

    public function index()
    {
        return $this->_planService->all();
    }

    public function addModules(Request $request, $id)
    {
        $data = $request->all();
        $this->_planService->addProducts($id, $data);
        return response()->json(['message' => 'Products added to plan successfully'], 200);
    }

    public function getModulesByPlanId($id)
    {
        return response()->json($this->_planService->getModulesByPlanId($id), 200);
    }

    public function assignPlanToUser(Request $request, $id)
    {
        $data = $request->all();
        return $this->_planService->assignPlanToUser($id, $data);
    }
}
