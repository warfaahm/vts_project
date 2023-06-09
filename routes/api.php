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
        Route::get('/profile', [\App\Http\Controllers\AuthUserController::class, 'profile']);
        Route::patch('/profile/update', [\App\Http\Controllers\AuthUserController::class, 'updateProfile']);

        Route::post('/county', [\App\Http\Controllers\CountyController::class, 'addCounty']);
        Route::get('/county/{id}', [\App\Http\Controllers\CountyController::class, 'viewCounty']);
        Route::get('/county', [\App\Http\Controllers\CountyController::class, 'index']);

        Route::get('/dependent', [\App\Http\Controllers\DependentController::class, 'index']);
        Route::post('/dependent', [\App\Http\Controllers\DependentController::class, 'store']);
        Route::get('/dependent/{dependent}', [\App\Http\Controllers\DependentController::class, 'show']);
        Route::patch('/dependent/{dependent}', [\App\Http\Controllers\DependentController::class, 'update']);

        Route::get('/appointment', [\App\Http\Controllers\AppointmentController::class, 'indexForUser']);
        Route::post('/appointment', [\App\Http\Controllers\AppointmentController::class, 'store']);
        Route::get('/appointment/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'showUser']);
        Route::patch('/appointment/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'updateUser']);

        Route::get('/dependent/record', [\App\Http\Controllers\RecordController::class, 'indexForDependent']);
        Route::get('/record', [\App\Http\Controllers\RecordController::class, 'indexForPatient']);
        Route::get('/dependent/{dependent}/record/{record}', [\App\Http\Controllers\RecordController::class, 'showForDependent']);
        Route::get('/record/{record}', [\App\Http\Controllers\RecordController::class, 'showForPatient']);

    });
});

// Admin API Routes
Route::prefix('/admin')->group(function (){
    Route::post('/login', [\App\Http\Controllers\AuthAdminController::class, 'login']);
    // Route::post('/register', [\App\Http\Controllers\AuthAdminController::class, 'register']);

    Route::middleware(['auth:sanctum', 'auth.admin'])->group(function (){

        Route::post('/logout', [\App\Http\Controllers\AuthAdminController::class, 'logout']);

        Route::post('/hospital', [\App\Http\Controllers\HospitalController::class, 'store']);
        Route::get('/hospital', [\App\Http\Controllers\HospitalController::class, 'index']);
        Route::get('/hospital/{hospital}', [\App\Http\Controllers\HospitalController::class, 'show']);
        Route::patch('/hospital/{hospital}', [\App\Http\Controllers\HospitalController::class, 'update']);

        Route::post('/disease', [\App\Http\Controllers\DiseaseController::class, 'store']);
        Route::get('/disease', [\App\Http\Controllers\DiseaseController::class, 'index']);
        Route::get('/disease/{disease}', [\App\Http\Controllers\DiseaseController::class, 'show']);
        Route::patch('/disease/{disease}', [\App\Http\Controllers\DiseaseController::class, 'update']);

        Route::post('/vaccine', [\App\Http\Controllers\VaccineController::class, 'store']);
        Route::get('/vaccine', [\App\Http\Controllers\VaccineController::class, 'index']);
        Route::get('/vaccine/{vaccine}', [\App\Http\Controllers\VaccineController::class, 'show']);
        Route::patch('/vaccine/{vaccine}', [\App\Http\Controllers\VaccineController::class, 'update']);

        Route::post('/register', [\App\Http\Controllers\AuthAdminController::class, 'register']);
        Route::get('/admin', [\App\Http\Controllers\AuthAdminController::class, 'index']);
        Route::get('/admin/{id}', [\App\Http\Controllers\AuthAdminController::class, 'show']);
        Route::delete('/admin/{admin}', [\App\Http\Controllers\AuthAdminController::class, 'destroy']);

        Route::post('/provider', [\App\Http\Controllers\AuthProviderController::class, 'register']);
        Route::get('/provider', [\App\Http\Controllers\AuthProviderController::class, 'index']);
        Route::get('/provider/{provider}', [\App\Http\Controllers\AuthProviderController::class, 'show']);


    });
});

// Healthcare Provider API Routes
Route::prefix('/staff')->group(function (){
    Route::post('/login', [\App\Http\Controllers\AuthProviderController::class, 'login']);

    Route::middleware(['auth:sanctum', 'auth.provider'])->group(function (){

        Route::post('/logout', [\App\Http\Controllers\AuthProviderController::class, 'logout']);
        Route::post('/provider', [\App\Http\Controllers\AuthProviderController::class, 'registerProvider']);
        Route::get('/provider', [\App\Http\Controllers\AuthProviderController::class, 'indexProvider']);
        Route::get('/provider/{provider}', [\App\Http\Controllers\AuthProviderController::class, 'showProvider']);
        Route::delete('/provider/{provider}', [\App\Http\Controllers\AuthProviderController::class, 'destroy']);

        Route::post('/record', [\App\Http\Controllers\RecordController::class, 'store']);
        Route::patch('/record/{record}', [\App\Http\Controllers\RecordController::class, 'update']);
        Route::get('/record/{record}', [\App\Http\Controllers\RecordController::class, 'show']);

        Route::get('/appointment', [\App\Http\Controllers\AppointmentController::class, 'index']);
        Route::get('/appointment/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'show']);
        Route::patch('/appointment/{appointment}', [\App\Http\Controllers\AppointmentController::class, 'update']);

    });
});
