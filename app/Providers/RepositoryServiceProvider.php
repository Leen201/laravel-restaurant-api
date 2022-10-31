<?php

namespace App\Providers;

use App\Interfaces\DishInterface;
use App\Interfaces\OrderInterface;
use App\Repositories\Dish\DishRepository;
use App\Repositories\Order\OrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * You must place Interface first, Repository second.
     */
    public function register(): void
    {
        $this->app->bind(
            DishInterface::class,
            DishRepository::class
        );
        $this->app->bind(
            OrderInterface::class,
            OrderRepository::class
        );

    }
}
