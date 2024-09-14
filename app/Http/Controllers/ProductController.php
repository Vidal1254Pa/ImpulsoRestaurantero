<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $_productService;
    public function __construct(ProductService $productService)
    {
        $this->_productService = $productService;
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $this->_productService->create($data);
        return response()->json(['message' => 'Product created successfully'], 201);
    }

    public function index()
    {
        return response()->json($this->_productService->all(), 200);
    }
}
