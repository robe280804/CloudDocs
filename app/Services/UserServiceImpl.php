<?php

namespace App\Services;

use App\Exceptions\UserDatabaseException;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserServiceImpl implements UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $request)
    {
        Log::info("[REGISTER] Register for {$request['email']}");

        $savedUser = $this->userRepository->create($request);
        $savedUser->assignRole('user');

        Log::info("[REGISTER] Register confirm for user {$savedUser->email}");
        return $savedUser;
    }
}
