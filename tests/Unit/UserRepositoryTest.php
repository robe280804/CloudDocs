<?php

namespace Tests\Unit;

use App\Exceptions\UserDatabaseException;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;


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
            'password' => 'robe*04'
        ]);

        $this->userRepository->create(new RegisterUserRequest([
            'name' => 'Robe',
            'email' => 'robe@gmail.com',
            'password' => 'robe*04'
        ]));
    }
}
