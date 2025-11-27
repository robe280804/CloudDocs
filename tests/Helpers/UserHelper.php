<?php

namespace Tests\Helpers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

trait UserHelper
{
    protected function createUser(array $overrides = []): User
    {
        return User::factory()->create(array_merge([
            'id' => Str::uuid(),
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'password' => Hash::make('password*123'),
        ], $overrides));
    }

    protected function createRegisterUserRequest(array $overrides = []): RegisterUserRequest
    {
        return new RegisterUserRequest(array_merge([
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'password' => 'password*123',
        ], $overrides));
    }
}
