<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Tests\Helpers\UserHelper;
use Illuminate\Support\Str;

class UserControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        foreach (['user', 'admin'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }
    }

    use RefreshDatabase, UserHelper;

    public function test_registration_success()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Mario Rossi',
            'email' => 'mario@gmail.com',
            'password' => 'Password*123',
            'password_confirmation' => 'Password*123',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => $response->json('user.email')
        ]);
    }

    public function test_get_user_info_success()
    {
        $id = Str::uuid();
        $this->createUser(['id' => $id]);

        $response = $this->getJson("/api/user/{$id}");

        $response->assertStatus(200);
    }
}
