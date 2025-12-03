<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request);
        return response()->json([
            'message' => 'Login succesfully',
            'token' => $data['token'],
            'user' => $data['user']
        ], 200);
    }
}
