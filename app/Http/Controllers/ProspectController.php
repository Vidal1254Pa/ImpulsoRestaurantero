<?php

namespace App\Http\Controllers;

use App\Services\ProspectService;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    private ProspectService $_prospectRepository;
    public function __construct(ProspectService $prospectRepository)
    {
        $this->_prospectRepository = $prospectRepository;
    }
    public function store(Request $request)
    {
        $this->_prospectRepository->create($request->all());
        return response()->json(['message' => 'Prospect created successfully']);
    }

    public function index()
    {
        return response()->json($this->_prospectRepository->all());
    }

    public function destroy(int $id)
    {
        $this->_prospectRepository->delete($id);
        return response()->json(['message' => 'Prospect deleted successfully']);
    }
}
