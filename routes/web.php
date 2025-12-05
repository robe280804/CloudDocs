<?php

use App\Livewire\LoginUser;
use App\Livewire\RegisterUser;
use App\Livewire\ResetPasswordConfirm;
use App\Livewire\ResetPasswordRequest;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// If you are logged in, you can't see this
Route::middleware('guest')->group(function () {
    Route::get("/register", RegisterUser::class)->name("register");
    Route::get("/login", LoginUser::class)->name("login");
    Route::get("/forgot-password", ResetPasswordRequest::class)->name("forgot.password");
    Route::get("/reset-password/{token}", ResetPasswordConfirm::class)->name('password.reset');
});
