<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Reemplaza la regla anterior con esta
        Gate::define('ver-calendario', function ($user) {
        // CORREGIDO: Usamos los nombres exactos de tu tabla de roles
            return $user->hasRole('ADMINISTRADOR') || $user->hasRole('DOCENTE');
        });
    }
}
