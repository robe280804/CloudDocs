<?php

namespace App\Providers;

use App\Listeners\SendWelcomeEmailListener;
use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\UserServiceImpl;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryImpl;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendPasswordResetEmailListener;
use App\Services\FinancialDocumentService;
use App\Services\FinancialDocumentServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding for service
        $this->app->bind(
            UserService::class,
            UserServiceImpl::class,
        );

        // Binding for repository
        $this->app->bind(
            UserRepository::class,
            UserRepositoryImpl::class
        );

        $this->app->bind(
            FinancialDocumentService::class,
            FinancialDocumentServiceImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            Registered::class,
            SendWelcomeEmailListener::class
        );

        Event::listen(
            PasswordReset::class,
            SendPasswordResetEmailListener::class
        );
    }
}
