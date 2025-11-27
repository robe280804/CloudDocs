<?php

namespace App\Repositories;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepository
{
    public function create(RegisterUserRequest $request): User;
    public function getUserById(string $userId): ?User;

    public function getAllUsers(): Collection;
}
