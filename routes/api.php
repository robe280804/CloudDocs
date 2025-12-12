<?php

use App\Http\Controllers\Api\UserControllerApi;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User API
Route::middleware(['throttle:api'])->group(function () {

    // With jwt token
    Route::middleware("auth:sanctum")->group(function () {

        //User
        Route::get('/user/{id}', [UserControllerApi::class, 'userInfo']);
        Route::post('/update-profile-name/{id}', [UserControllerApi::class, 'updateUserName']);
        Route::post('/change-password', [UserControllerApi::class, 'changePassword']);
        Route::middleware('admin')->group(function () {
            Route::get('/users', [UserControllerApi::class, 'allUserInfo']);
            Route::delete('/user/{id}', [UserControllerApi::class, 'delete']);
        });

        // Financial documents
    });
    // Auth && Register
    Route::post("/register", [UserControllerApi::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


Route::prefix('finance-documents')->group(function () {
    Route::post('/', [FinancilDocumentController::class]);
    Route::get('/', [FinancilDocumentController::class]);
});
