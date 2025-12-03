<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

    public function register(array | RegisterUserRequest $request): User
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
        Log::info("[ALL-USER-INFO] Info for all users");
        return $this->userRepository->getAllUsers();
    }

    public function updateUserName(UpdateUserRequest $request, string $id): bool
    {
        Log::info("[UPDATE-USER-NAME] Update name for user $id");
        return $this->userRepository->updateUserName($request['name'], $id);
    }

    public function deleteUser(string $id): bool
    {
        Log::info("[DELETE] Delete user $id");
        return $this->userRepository->deleteUserById($id);
    }
}
