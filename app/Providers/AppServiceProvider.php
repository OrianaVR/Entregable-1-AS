<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Interfaces\OrderCreation;
use App\Interfaces\ReviewCreation;
use App\Services\OrderCreationService;
use App\Services\ReviewCreationService;
use App\Utils\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, ImageLocalStorage::class);
        $this->app->bind(OrderCreation::class, OrderCreationService::class);
        $this->app->bind(ReviewCreation::class, ReviewCreationService::class);
    }

    public function boot(): void {}
}