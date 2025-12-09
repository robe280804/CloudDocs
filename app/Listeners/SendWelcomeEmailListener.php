<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendWelcomeEmailListener
{
    use InteractsWithQueue;

    public $tries = 3;
    public $timeout = 20;
    public $queue = 'emails';
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        SendWelcomeEmailJob::dispatch($event->user)->onQueue($this->queue);

        Log::info("SendWelcomeEmailListener success", [
            'user_email' => $event->user->email ?? null
        ]);
    }

    public function failed(Throwable $ex)
    {
        Log::error('SendWelcomeEmailListener failed', [
            'user_id' => $ex->user->id ?? null,
            'exception' => $ex->getMessage(),
        ]);
    }
}
