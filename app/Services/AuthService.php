<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Exceptions\BadCredentialException;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ])) {
            throw new BadCredentialException("Bad credentials", 0,);
        }

        $authUser = Auth::user();
        $token = $authUser->createToken('api-token')->plainTextToken;

        return [
            'user' => $authUser,
            'token' => $token
        ];
    }
}
