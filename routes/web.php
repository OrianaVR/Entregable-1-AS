<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

$basePath = '/';
$aboutPath = 'about';
$contactPath = 'contact';
$productPath = 'product';

Route::get($basePath, [HomeController::class, 'index'])->name('home.index');
Route::get($basePath.$aboutPath, [HomeController::class, 'about'])->name('home.about');
Route::get($basePath.$contactPath, [HomeController::class, 'contact'])->name('home.contact');

Route::get($basePath.$productPath, [ProductController::class, 'index'])->name('product.index');
Route::get($basePath.$productPath.'/create', [ProductController::class, 'create'])->name('product.create');
Route::post($basePath.$productPath.'/save', [ProductController::class, 'save'])->name('product.save');
Route::delete($basePath.$productPath.'/delete/{id}', [ProductController::class, 'delete'])->whereNumber('id')->name('product.delete');
Route::get($basePath.$productPath.'/{id}', [ProductController::class, 'show'])->whereNumber('id')->name('product.show');
