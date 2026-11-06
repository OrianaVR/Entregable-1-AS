<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Support\Facades\Route;

$productPath = 'products';

Route::get($productPath, [ProductApiController::class, 'index'])->name('api.product.index');
