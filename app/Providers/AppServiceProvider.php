<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\UserServiceImpl;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryImpl;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
