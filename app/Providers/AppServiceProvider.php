<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Utils\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, ImageLocalStorage::class);
    }

    public function boot(): void {}
}