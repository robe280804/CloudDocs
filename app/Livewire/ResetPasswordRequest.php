<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

class ResetPasswordRequest extends Component
{

    public $email;
    public $successMessage;

    public function resetPasswordRequest()
    {
        $validateEmail = $this->validate([
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
            ],
        ]);

        try {
            $status = Password::sendResetLink(
                $validateEmail
            );

            if ($status === Password::RESET_LINK_SENT) {
                $this->successMessage = 'If your email exists, you will recive it';
            } else {

                Log::warning('Password reset error', [
                    'email' => $validateEmail['email'],
                    'message' => 'This email is not register'
                ]);
                $this->successMessage = 'If your email exists, you will recive it';
            }
        } catch (Exception $ex) {

            Log::error('Password reset error', [
                'email' => $validateEmail['email'],
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString()
            ]);
            $this->addError('reset-password', 'Internal server error. Try later');
        }
    }

    public function render()
    {
        return view('livewire.reset-password-request');
    }
}
