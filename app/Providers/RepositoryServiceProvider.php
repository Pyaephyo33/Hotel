<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\{FoodRepositoryInterface, GuestRepositoryInterface, RoomRepositoryInterface, RoomTypeRepositoryInterface, UserRepositoryInterface};
use App\Repositories\{FoodRepository, GuestRepository, RoomRepository, RoomTypeRepository, UserRepository};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RoomTypeRepositoryInterface::class, RoomTypeRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(GuestRepositoryInterface::class, GuestRepository::class);
        $this->app->bind(FoodRepositoryInterface::class, FoodRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
