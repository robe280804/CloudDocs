<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

// TODO: FIx edit() method with view
class EditProfileModal extends Component
{
    public User $user;

    public $name;
    public $email;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->to('login');
        }
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function edit()
    {
        Log::info("ciao");
        /*
        $credentials = $this->validate([
            'name' => [
                'required_without:email',
                'string',
                'min:2',
                'max:50',
                'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\'\s]+$/u'
            ],
            'email' => [
                'required_without:name',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users,email,' . $this->user->id
            ],
        ]);

        $updateData = array_filter([
            'name' => $credentials['name'] ?? null,
            'email' => $credentials['email'] ?? null,
        ], fn($value) => !empty($value));

        if (empty($updateData)) {
            $this->addError('form', 'You must fill at least one field (name or email).');
            return;
        }

        $this->user->update($updateData);
        */
        $this->modal()->close();
    }

    public function render()
    {
        return view('livewire.dashboard.edit-profile-modal');
    }
}
