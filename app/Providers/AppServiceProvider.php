<?php

namespace App\Providers;

use App\Repositories\SalesEloquentORM;
use App\Repositories\SalesRepositotyInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SalesRepositotyInterface::class,
            SalesEloquentORM::class
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
