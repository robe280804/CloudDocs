<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class LoginUser extends Component
{

    public $email;
    public $password;

    public $remember = false;


    public function login()
    {
        $credentials = $this->validate([
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:12',
                'max:64',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
        ]);

        if (!Auth::attempt($credentials, $this->remember)) {
            throw ValidationException::withMessages([
                'login' => 'Bad credentials'
            ]);
        }

        return redirect()->to('dashboard');
    }

    public function render()
    {
        return view('livewire.login-user');
    }
}
