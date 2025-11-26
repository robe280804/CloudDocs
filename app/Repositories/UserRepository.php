<?php

namespace App\Repositories;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;

interface UserRepository
{
    public function create(RegisterUserRequest $request): User;
}
