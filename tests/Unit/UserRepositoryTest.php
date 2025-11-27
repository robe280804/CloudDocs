<?php

namespace Tests\Unit;

use App\Exceptions\UserDatabaseException;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryImpl;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Tests\Helpers\UserHelper;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase, UserHelper;

    protected UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new UserRepositoryImpl();
    }

    public function test_create_user_success()
    {
        $savedUser = $this->userRepository->create(
            $this->createRegisterUserRequest()
        );

        // Check if is equals to $newUser
        $this->assertInstanceOf(User::class, $savedUser);
        $this->assertDatabaseHas('users', [
            'email' => $savedUser->email
        ]);
    }

    public function test_create_user_exception()
    {
        $this->expectException(UserDatabaseException::class);

        // User with name = null
        // Check if fails 
        $this->userRepository->create(
            $this->createRegisterUserRequest(['name' => null])
        );
    }

    public function test_create_user_with_same_email()
    {
        $this->expectException(UserDatabaseException::class);

        $this->createUser(['email' => 'robe@gmail.com']);

        // Insert new user with same email
        $this->userRepository->create(
            $this->createRegisterUserRequest(['email' => 'robe@gmail.com'])
        );
    }

    public function test_get_user_success()
    {

        $newUser = $this->createUser();

        $savedUser = $this->userRepository->getUserById($newUser->id);

        // Check if is equal to $newUser
        $this->assertInstanceOf(User::class, $savedUser);
        $this->assertEquals($newUser->name, $savedUser->name);
        $this->assertEquals($newUser->email, $savedUser->email);

        $this->assertDatabaseHas('users', [
            'email' => $savedUser->email
        ]);
    }

    public function test_get_user_null()
    {
        $this->createUser();

        // Find user by non-existent id
        $nullUser = $this->userRepository->getUserById(Str::uuid());

        // Check if is null
        $this->assertNull($nullUser);
    }

    public function test_get_all_users_success()
    {
        User::factory()->createMany([
            [
                'name' => 'Luca',
                'email' => 'luca@example.com',
                'password' => Hash::make('password*123')
            ],
            [
                'name' => 'Luigi',
                'email' => 'luigi@example.com',
                'password' => Hash::make('password*123')
            ]
        ]);

        $listUsers = $this->userRepository->getAllUsers();

        // Check if is a Collection
        $this->assertInstanceOf(Collection::class, $listUsers);
    }
}
