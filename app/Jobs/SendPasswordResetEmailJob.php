<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\PasswordResetEmail;
use Throwable;

class SendPasswordResetEmailJob implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    public $timeout = 20;

    public User $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)
            ->send(new PasswordResetEmail($this->user));

        Log::info("Welcome email send succesfully", [
            'user_id' => $this->user->id ?? null,
            'email' => $this->user->email ?? null
        ]);
    }

    public function failed(Throwable $ex)
    {
        Log::error("Welcome email send failed", [
            'user_id' => $this->user->id ?? null,
            'email' => $this->user->email ?? null,
            'ex' => $ex->getMessage()
        ]);
    }
}
