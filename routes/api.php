<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Users - Patients API Routes
Route::prefix('/user')->group(function (){
    Route::post('/register', [\App\Http\Controllers\AuthUserController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\AuthUserController::class, 'login']);

    Route::middleware(['auth:sanctum', 'auth.user'])->group(function (){
        Route::post('/logout', [\App\Http\Controllers\AuthUserController::class, 'logout']);

        Route::post('/county', [\App\Http\Controllers\CountyController::class, 'addCounty']);
        Route::get('/county/{id}', [\App\Http\Controllers\CountyController::class, 'viewCounty']);
        Route::get('/county', [\App\Http\Controllers\CountyController::class, 'index']);

        Route::get('/dependent', [\App\Http\Controllers\DependentController::class, 'index']);
        Route::post('/dependent', [\App\Http\Controllers\DependentController::class, 'store']);
        Route::get('/dependent/{dependent}', [\App\Http\Controllers\DependentController::class, 'show']);
        Route::patch('/dependent/{dependent}', [\App\Http\Controllers\DependentController::class, 'update']);
    });
});

// Admin API Routes
Route::prefix('/admin')->group(function (){
    Route::post('/login', [\App\Http\Controllers\AuthAdminController::class, 'login']);

    Route::middleware(['auth:sanctum', 'auth.admin'])->group(function (){

    });
});

// Healthcare Provider API Routes
Route::prefix('/staff')->group(function (){
    Route::post('/login', [\App\Http\Controllers\AuthProviderController::class, 'login']);

    Route::middleware(['auth:sanctum', 'auth.provider'])->group(function (){

    });
});
