<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Collection;

class UserServiceImpl implements UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $request): User
    {
        Log::info("[REGISTER] Register for {$request['email']}");

        $savedUser = $this->userRepository->create($request);
        $savedUser->assignRole('user');

        Log::info("[REGISTER] Register confirm for user {$savedUser->email}");
        return $savedUser;
    }

    public function getUser(string $userId): User
    {
        Log::info("[USER-INFO] Info for user $userId");
        $savedUser = $this->userRepository->getUserById($userId);

        if (!$savedUser) {
            throw new UserNotFoundException("User with ID: $userId not found");
        }
        return $savedUser;
    }

    public function getAllUser(): Collection
    {
        Log::info("");
        return $this->userRepository->getAllUsers();
    }
}
