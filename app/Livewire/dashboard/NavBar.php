<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NavBar extends Component
{

    public User $user;

    public function openEditProfileModal()
    {
        Flux::modal('edit-profile-modal')->show();
    }

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->to('login');
        }
        $this->user = Auth::user();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('login');
    }

    public function deleteAccount()
    {
        Log::info("delete account");
    }

    public function render()
    {
        return view('livewire.dashboard.nav-bar');
    }
}
