<?php

namespace App\Providers;

use App\Interfaces\IRolRepository;
use App\Interfaces\IUserRepository;
use App\Repository\RolRepositoryImpl;
use App\Repository\UserRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public $bindings = [
        IUserRepository::class => UserRepositoryImpl::class,
        IRolRepository::class => RolRepositoryImpl::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
