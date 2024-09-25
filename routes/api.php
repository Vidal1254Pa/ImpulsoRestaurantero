<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HeadquarterController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProspectController;
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
    Route::post('/user/{id:int}/headquarters', [HeadquarterController::class, 'addUser']);

    /* COMPANY */
    Route::post('/company', [CompanyController::class, 'store']);
    Route::get('/company', [CompanyController::class, 'index']);
    Route::put('/company/{id:int}', [CompanyController::class, 'update']);
    Route::delete('/company/{id:int}', [CompanyController::class, 'destroy']);


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
});
