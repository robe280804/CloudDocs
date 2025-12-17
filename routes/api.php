<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FinancialDocumentController;
use App\Services\FinancialAgentService;
use FinancialAgentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User API
Route::middleware(['throttle:api'])->group(function () {

    // With jwt token
    Route::middleware("auth:sanctum")->group(function () {

        //User
        Route::get('/user/{id}', [UserController::class, 'userInfo']);
        Route::post('/update-profile-name/{id}', [UserController::class, 'updateUserName']);
        Route::post('/change-password', [UserController::class, 'changePassword']);
        Route::middleware('admin')->group(function () {
            Route::get('/users', [UserController::class, 'allUserInfo']);
            Route::delete('/user/{id}', [UserController::class, 'delete']);
        });

        // Financial documents
        Route::prefix('finance-documents')->group(function () {
            Route::post('/store', [FinancialDocumentController::class, 'store']);
            Route::get('/', [FinancialDocumentController::class]);
        });

        Route::post("agent/question", [FinancialAgentController::class, 'makeQuestion']);
    });
    // Auth && Register
    Route::post("/register", [UserController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


// Tests Neuron AI 
Route::post("/insert-rag", [FinancialAgentService::class, 'testStringDataLoaderIntoRag']);
