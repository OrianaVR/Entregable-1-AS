<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Providers;

use App\Interfaces\ExternalProductProvider;
use App\Interfaces\ImageStorage;
use App\Interfaces\OrderReport;
use App\Utils\ExcelOrderReport;
use App\Utils\ImageLocalStorage;
use App\Utils\PdfOrderReport;
use App\Utils\Team7ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, ImageLocalStorage::class);
        $this->app->bind(ExternalProductProvider::class, Team7ProductService::class);

        $this->app->bind(OrderReport::class, function (): OrderReport {
            if (request()->query('format') === 'excel') {
                return new ExcelOrderReport;
            }

            return new PdfOrderReport;
        });
    }

    public function boot(): void {}
}
