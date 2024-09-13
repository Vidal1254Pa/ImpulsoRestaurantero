<?php

namespace App\Providers;

use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Database\Events\MigrationsStarted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class MigrationForeignKeyServiceProvider extends ServiceProvider
{
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
        Event::listen(MigrationsStarted::class, function () {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        });

        // Habilitar las llaves foráneas al finalizar las migraciones
        Event::listen(MigrationsEnded::class, function () {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }
}
