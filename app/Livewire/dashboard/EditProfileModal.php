<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;
use Log;

class EditProfileModal extends Component
{

    public $showModal = false;
    public User $user;

    #[On('open-edit-profile-modal')]
    public function open($data)
    {
        Log::info("ciao")
        $this->user = User::findOrFail($data['user_id']);
        $this->showModal = true;
    }


    public function render()
    {
        return view('components.dashboard.edit-profile-modal');
    }
}
