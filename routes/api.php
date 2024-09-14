<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::post('/user/admin', [AdminController::class, 'store']);


    /* PLANS */
    Route::post('/plan', [PlanController::class, 'store']);
    Route::get('/plan', [PlanController::class, 'index']);
    Route::post('/plan/{id:int}/products', [PlanController::class, 'addProducts']);
    Route::get('/plan/{id:int}/products', [PlanController::class, 'getProductsByPlanId']);

    /* PRODUCTS */
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/product', [ProductController::class, 'index']);
});
