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
        return $this->_prospectRepository->create($request->all());
    }

    public function index()
    {
        return $this->_prospectRepository->all();
    }

    public function destroy(int $id)
    {
        return $this->_prospectRepository->delete($id);
    }
}
