<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Log;

class ResetPasswordConfirm extends Component
{

    public $token;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->email = request()->query('email');
    }
    public function saveNewPassword()
    {
        $validateData = $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:12',
                'max:64',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
                'confirmed',
            ],
        ]);

        Log::info('ResetPasswordConfirm: attempting reset', [
            'email' => $validateData['email'] ?? null,
            'token' => $validateData['token'] ?? null,
            'password_provided' => isset($validateData['password']) ? true : false,
        ]);

        $status = Password::broker()->reset(
            $validateData,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PasswordReset) {
            $this->addError('reset-password', '');
        }
        session()->flash('password-reset-success', 'Password update with success');
        return redirect()->to(route('login'));
    }

    public function render()
    {
        return view('livewire.reset-password-confirm');
    }
}
