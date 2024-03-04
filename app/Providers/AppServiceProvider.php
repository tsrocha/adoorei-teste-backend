<?php

namespace App\Providers;

use App\Repositories\ProductEloquentORM;
use App\Repositories\ProductsRepositoryInterface;
use App\Repositories\ProductsSaleEloquentORM;
use App\Repositories\ProductsSaleRepositotyInterface;
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

        $this->app->bind(
            ProductsRepositoryInterface::class,
            ProductEloquentORM::class
        );

        $this->app->bind(
            ProductsSaleRepositotyInterface::class,
            ProductsSaleEloquentORM::class
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
