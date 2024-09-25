<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryProductsCompanyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HeadquarterController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\SuppliersCompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);

/* PROSPECT */
Route::post('/prospect', [ProspectController::class, 'store']);

Route::post('/test/user', [UserController::class, 'test_create']);

Route::middleware('auth:api')->group(function () {

    Route::post('/user', [UserController::class, 'store']);
    Route::put('/user/{id:int}/plan', [PlanController::class, 'assignPlanToUser']);

    /* COMPANY */
    Route::post('/company', [CompanyController::class, 'store']);
    Route::get('/company', [CompanyController::class, 'index']);
    Route::put('/company/{id:int}', [CompanyController::class, 'update']);
    Route::delete('/company/{id:int}', [CompanyController::class, 'destroy']);

    /* HEADQUARTER_COMPANY */
    Route::post('/company/{id:int}/headquarter', [HeadquarterController::class, 'store']);
    Route::post('/headquarters/{head_id:int}/user/{user_id:int}', [HeadquarterController::class, 'addUser']);


    /* PLANS */
    Route::post('/plan', [PlanController::class, 'store']);
    Route::get('/plan', [PlanController::class, 'index']);
    Route::post('/plan/{id:int}/modules', [PlanController::class, 'addModules']);
    Route::get('/plan/{id:int}/modules', [PlanController::class, 'getModulesByPlanId']);

    /* MODULES */
    Route::post('/module', [ModuleController::class, 'store']);
    Route::get('/module', [ModuleController::class, 'index']);

    /* PROSPECT */
    Route::post('/prospect', [ProspectController::class, 'store']);
    Route::get('/prospect', [ProspectController::class, 'index']);
    Route::delete('/prospect/{id:int}', [ProspectController::class, 'destroy']);

    /* SUPPLIER */
    Route::post('/company/{id:int}/supplier', [SuppliersCompanyController::class, 'store']);
    Route::get('/supplier', [SuppliersCompanyController::class, 'index']);
    Route::put('/supplier/{id:int}', [SuppliersCompanyController::class, 'update']);
    Route::delete('/supplier/{id:int}', [SuppliersCompanyController::class, 'destroy']);

    /* CATEGORY PRODUCTS COMPANY */
    Route::post('/headquarter/{id:int}/category', [CategoryProductsCompanyController::class, 'store']);
    Route::get('/headquarter/{id:int}/category', [CategoryProductsCompanyController::class, 'index']);
    Route::put('/category/{id:int}', [CategoryProductsCompanyController::class, 'update']);
    Route::delete('/category/{id:int}', [CategoryProductsCompanyController::class, 'destroy']);
});
