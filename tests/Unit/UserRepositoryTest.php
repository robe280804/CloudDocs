<?php

namespace Tests\Unit;

use App\Exceptions\UserDatabaseException;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;


class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new UserRepositoryImpl();
    }

    public function test_create_user_success()
    {
        $data = new RegisterUserRequest([
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'password' => 'password*123'
        ]);

        $user = $this->userRepository->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Mario Rossi', $user->name);
        $this->assertEquals('mario@example.com', $user->email);
        $this->assertDatabaseHas('users', [
            'email' => 'mario@example.com'
        ]);
    }

    public function test_create_user_exception()
    {
        $this->expectException(UserDatabaseException::class);

        $data = new RegisterUserRequest([
            'name' => null,
            'email' => 'luigi@example.com',
            'password' => 'password*123'
        ]);


        $this->userRepository->create($data);
    }

    public function test_create_user_with_same_email()
    {
        $this->expectException(UserDatabaseException::class);

        $existingUser = User::factory()->create([
            'name' => 'Robe',
            'email' => 'robe@gmail.com',
            'password' => Hash::make('robe*04')
        ]);

        $this->userRepository->create(new RegisterUserRequest([
            'name' => 'Robe',
            'email' => 'robe@gmail.com',
            'password' => 'robe*04'
        ]));
    }

    public function test_get_user_success()
    {
        $existingUser = User::factory()->create([
            'id' => Str::uuid(),
            'name' => 'Mario',
            'email' => 'mario@example.com',
            'password' => Hash::make('password*123')
        ]);

        $userById = User::find($existingUser->id);

        $this->assertInstanceOf(User::class, $userById);
        $this->assertEquals($existingUser->name, $userById->name);
        $this->assertEquals($existingUser->email, $userById->email);

        $this->assertDatabaseHas('users', [
            'email' => $userById->email
        ]);
    }
}
