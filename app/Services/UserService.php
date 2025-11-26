<?php

namespace App\Services;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;

interface UserService
{
    public function register(RegisterUserRequest $request): User;
    public function getUser(string $id): User;
}
