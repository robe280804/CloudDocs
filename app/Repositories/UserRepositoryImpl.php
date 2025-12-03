<?php

namespace App\Repositories;

use App\Exceptions\UserDatabaseException;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImpl implements UserRepository
{
    public function create(array | RegisterUserRequest $request): User
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

    public function getUserById(string $userId): ?User
    {
        try {
            return User::find($userId);
        } catch (QueryException $ex) {
            throw new UserDatabaseException(
                "Impossibile ottenere l'utente",
                0,
                $ex
            );
        }
    }

    public function getAllUsers(): Collection
    {
        try {
            return User::all();
        } catch (QueryException $ex) {
            throw new UserDatabaseException(
                "Impossibile ottenere gli utenti",
                0,
                $ex
            );
        }
    }

    public function updateUserName(string $name, string $id): bool
    {
        try {
            return User::where('id', $id)->update(['name' => $name]);
        } catch (QueryException $ex) {
            throw new UserDatabaseException(
                "Impossibile aggiornare il nome dell'utente ",
                0,
                $ex
            );
        }
    }

    public function deleteUserById(string $id): bool
    {
        try {
            return User::where('id', $id)->delete() > 0;
        } catch (QueryException $ex) {
            throw new UserDatabaseException(
                "Impossibile eliminare l'utente ",
                0,
                $ex
            );
        }
    }
}
