<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);

/* PROSPECT */
Route::post('/prospect', [ProspectController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    
    Route::post('/user', [UserController::class, 'store']);
    Route::put('/user/{id:int}/plan', [PlanController::class, 'assignPlanToUser']);


    /* PLANS */
    Route::post('/plan', [PlanController::class, 'store']);
    Route::get('/plan', [PlanController::class, 'index']);
    Route::post('/plan/{id:int}/products', [PlanController::class, 'addProducts']);
    Route::get('/plan/{id:int}/products', [PlanController::class, 'getProductsByPlanId']);

    /* PRODUCTS */
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/product', [ProductController::class, 'index']);

    /* PROSPECT */
    Route::get('/prospect', [ProspectController::class, 'index']);
    Route::delete('/prospect/{id:int}', [ProspectController::class, 'destroy']);
});
