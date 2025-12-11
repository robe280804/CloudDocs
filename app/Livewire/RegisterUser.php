<?php

namespace App\Livewire;

use App\Http\Requests\RegisterUserRequest;
use Livewire\Component;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class RegisterUser extends Component
{
    protected $userService;
    public $name;
    public $email;
    public $password;

    public $showPassword = false;

    public function boot(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function register()
    {
        // I take only the rules by the instance
        $request = new RegisterUserRequest();

        $validatedData = $this->validate($request->rules());

        $savedUser = $this->userService->register($validatedData);

        Auth::login($savedUser);

        return redirect()->to('dashboard');
    }


    public function render()
    {
        return view('livewire.register-user');
    }
}
