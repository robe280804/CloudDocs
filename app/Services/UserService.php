<?php

namespace App\Services;

use App\Http\Requests\RegisterUserRequest;

interface UserService
{
    public function register(RegisterUserRequest $request);
}
