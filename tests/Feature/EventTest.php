<?php

namespace Tests\Feature;

use App\Jobs\SendPasswordResetEmailJob;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\UserHelper;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Auth\Events\PasswordReset;


class EventTest extends TestCase
{
    use RefreshDatabase, UserHelper;

    public function test_registered_event_success()
    {
        Queue::fake();

        $user = $this->createUser();

        event(new Registered($user));

        Queue::assertPushed(SendWelcomeEmailJob::class);
    }

    public function test_reset_password_event_success()
    {
        Queue::fake();


        $user = $this->createUser();

        event(new PasswordReset($user));

        Queue::assertPushed(SendPasswordResetEmailJob::class);
    }
}
