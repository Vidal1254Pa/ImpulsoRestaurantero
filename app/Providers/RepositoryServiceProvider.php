<?php

namespace App\Providers;

use App\Interfaces\ICategoryProductsCompanyRepository;
use App\Interfaces\ICompanyRepository;
use App\Interfaces\IHeadquarterRepository;
use App\Interfaces\IModuleRepository;
use App\Interfaces\IPlanRepository;
use App\Interfaces\IProspectRepository;
use App\Interfaces\IRolRepository;
use App\Interfaces\ISuppliersCompanyRepository;
use App\Interfaces\IUserRepository;
use App\Repository\CategoryProductsCompanyRepositoryImpl;
use App\Repository\CompanyRepositoryImpl;
use App\Repository\HeadquarterRepositoryImpl;
use App\Repository\ModuleRepositoryImpl;
use App\Repository\PlanRepositoryImpl;
use App\Repository\ProspectRepositoryImpl;
use App\Repository\RolRepositoryImpl;
use App\Repository\SuppliersCompanyRepositoryImpl;
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
        IHeadquarterRepository::class => HeadquarterRepositoryImpl::class,
        ICompanyRepository::class => CompanyRepositoryImpl::class,
        ISuppliersCompanyRepository::class => SuppliersCompanyRepositoryImpl::class,
        ICategoryProductsCompanyRepository::class => CategoryProductsCompanyRepositoryImpl::class,
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
