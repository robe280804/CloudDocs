<?php

namespace App\Repositories;

use App\Exceptions\UserDatabaseException;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImpl implements UserRepository
{
    public function create(RegisterUserRequest $request): User
    {
        try {
            return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
        } catch (QueryException $ex) {
            throw new UserDatabaseException(
                "Impossibile creare l'utente",
                0,
                $ex
            );
        }
    }
}
