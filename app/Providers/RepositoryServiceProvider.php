<?php

namespace App\Providers;

use App\Interfaces\IModuleRepository;
use App\Interfaces\IPlanRepository;
use App\Interfaces\IProspectRepository;
use App\Interfaces\IRolRepository;
use App\Interfaces\IUserRepository;
use App\Repository\ModuleRepositoryImpl;
use App\Repository\PlanRepositoryImpl;
use App\Repository\ProspectRepositoryImpl;
use App\Repository\RolRepositoryImpl;
use App\Repository\UserRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public $bindings = [
        IUserRepository::class => UserRepositoryImpl::class,
        IRolRepository::class => RolRepositoryImpl::class,
        IPlanRepository::class => PlanRepositoryImpl::class,
        IModuleRepository::class => ModuleRepositoryImpl::class,
        IProspectRepository::class => ProspectRepositoryImpl::class,
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
