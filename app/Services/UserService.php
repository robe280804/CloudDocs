<?php

namespace App\Services;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserService
{
    public function register(RegisterUserRequest $request): User;
    public function getUser(string $id): User;

    public function getAllUser(): Collection;
}
