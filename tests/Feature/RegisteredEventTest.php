<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\UserHelper;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendWelcomeEmailJob;

class RegisteredEventTest extends TestCase
{
    use RefreshDatabase, UserHelper;

    public function test_event_success()
    {
        Queue::fake();

        $user = $this->createUser();

        event(new Registered($user));

        Queue::assertPushed(SendWelcomeEmailJob::class);
    }
}
