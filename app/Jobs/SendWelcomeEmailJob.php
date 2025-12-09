<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Queueable, SerializesModels;

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
            ->send(new WelcomeMail($this->user));

        Log::error("Welcome email send succesfully", [
            'user_id' => $this->user->id ?? null,
            'email' => $this->user->email ?? null
        ]);
    }

    /**
     * Summary of failed
     * @param Throwable $ex
     * @return void
     */
    public function failed(Throwable $ex)
    {
        Log::error("Welcome email send failed", [
            'user_id' => $this->user->id ?? null,
            'email' => $this->user->email ?? null,
            'ex' => $ex->getMessage()
        ]);
    }
}
