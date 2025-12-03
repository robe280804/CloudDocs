<?php

namespace App\Services;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserService
{
    public function register(array | RegisterUserRequest $request): User;
    public function getUser(string $id): User;

    public function getAllUser(): Collection;

    public function updateUserName(UpdateUserRequest $request, string $id): bool;

    public function deleteUser(string $id): bool;
}
