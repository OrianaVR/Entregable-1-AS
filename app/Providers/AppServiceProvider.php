<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Interfaces\OrderCreation;
use App\Services\OrderCreationService;
use App\Utils\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, ImageLocalStorage::class);
        $this->app->bind(OrderCreation::class, OrderCreationService::class);
    }

    public function boot(): void {}
}
