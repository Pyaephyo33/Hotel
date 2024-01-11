<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\{RoomRepositoryInterface, RoomTypeRepositoryInterface};
use App\Repositories\{RoomRepository, RoomTypeRepository};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RoomTypeRepositoryInterface::class, RoomTypeRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
