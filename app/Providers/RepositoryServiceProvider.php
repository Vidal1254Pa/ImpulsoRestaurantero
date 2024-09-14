<?php

namespace App\Providers;

use App\Interfaces\IPlanRepository;
use App\Interfaces\IProductRepository;
use App\Interfaces\IRolRepository;
use App\Interfaces\IUserRepository;
use App\Repository\PlanRepositoryImpl;
use App\Repository\ProductRepositoryImpl;
use App\Repository\RolRepositoryImpl;
use App\Repository\UserRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public $bindings = [
        IUserRepository::class => UserRepositoryImpl::class,
        IRolRepository::class => RolRepositoryImpl::class,
        IPlanRepository::class => PlanRepositoryImpl::class,
        IProductRepository::class => ProductRepositoryImpl::class,
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
