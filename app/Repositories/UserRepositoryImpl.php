<?php

namespace App\Repositories;

use App\Exceptions\UserDatabaseException;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Database\QueryException;

class UserRepositoryImpl implements UserRepository
{
    public function create(RegisterUserRequest $request): User
    {
        try {
            return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password'],
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
