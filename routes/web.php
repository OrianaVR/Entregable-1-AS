<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

$basePath = '/';
$aboutPath = 'about';
$contactPath = 'contact';

Route::get($basePath, [HomeController::class, 'index'])->name('home.index');
Route::get($basePath.$aboutPath, [HomeController::class, 'about'])->name('home.about');
Route::get($basePath.$contactPath, [HomeController::class, 'contact'])->name('home.contact');