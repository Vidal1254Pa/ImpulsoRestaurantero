<?php

namespace App\Http\Controllers;

use App\Services\HeadquarterService;
use Illuminate\Http\Request;

class HeadquarterController extends Controller
{
    private HeadquarterService $_headquarterService;

    public function __construct(HeadquarterService $headquarterService)
    {
        $this->_headquarterService = $headquarterService;
    }

    public function addUser($head_id, $user_id)
    {
        return $this->_headquarterService->addUser($head_id, $user_id);
    }
    
    public function store(Request $request, $id)
    {
        $data = $request->all();
        return $this->_headquarterService->create($id, $data);
    }
}
