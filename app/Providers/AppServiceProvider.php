<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // <--- 1. Importante: Adicione esta linha

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
        // 2. Força o Laravel a usar o HTML simples (estilo Bootstrap)
        // em vez dos SVGs gigantes do Tailwind
        Paginator::useBootstrapFive();
    }
}
