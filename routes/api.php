<?php

use App\Http\Controllers\Api\UserControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User API
Route::post("/register", [UserControllerApi::class, 'register']);
/*Route::middleware("auth:sanctum")->group(function () {*/
Route::get('/user/{id}', [UserControllerApi::class, 'userInfo']);
Route::get('/users', [UserControllerApi::class, 'allUserInfo']);
Route::post('/update-profile-name/{id}', [UserControllerApi::class, 'updateUserName']);
Route::post('/change-password', [UserControllerApi::class, 'changePassword']);
Route::delete('/user/{id}', [UserControllerApi::class, 'delete']);
//});
