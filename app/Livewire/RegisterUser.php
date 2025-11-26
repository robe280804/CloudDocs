<?php

namespace App\Livewire;

use Livewire\Component;

class RegisterUser extends Component
{

    public $name = 'ciao';
    public $email;
    public $password;
    public $confirmPassword;
    public function render()
    {
        return view('livewire.register-user');
    }
}
