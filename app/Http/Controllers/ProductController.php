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
        return $this->_productService->create($data);
    }

    public function index()
    {
        return $this->_productService->all();
    }
}
