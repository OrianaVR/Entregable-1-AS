<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$basePath = '/';
$aboutPath = 'about';
$contactPath = 'contact';
$loginPath = 'login';
$registerPath = 'register';
$logoutPath = 'logout';
$profilePath = 'profile';
$adminPath = 'admin';
$orderPath = 'order';

Route::get($basePath, [HomeController::class, 'index'])->name('home.index');
Route::get($basePath.$aboutPath, [HomeController::class, 'about'])->name('home.about');
Route::get($basePath.$contactPath, [HomeController::class, 'contact'])->name('home.contact');

Route::get($basePath.$loginPath, [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post($basePath.$loginPath, [AuthController::class, 'login'])->middleware('guest')->name('login.attempt');
Route::get($basePath.$registerPath, [AuthController::class, 'showRegister'])->middleware('guest')->name('register');
Route::post($basePath.$registerPath, [AuthController::class, 'register'])->middleware('guest')->name('register.attempt');
Route::post($basePath.$logoutPath, [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get($basePath.$profilePath.'/{id}', [UserController::class, 'profile'])->whereNumber('id')->middleware('role:user,admin')->name('user.profile');
Route::put($basePath.$profilePath.'/update/{id}', [UserController::class, 'profileUpdate'])->whereNumber('id')->middleware('role:user,admin')->name('user.profile.update');

Route::get($basePath.$adminPath.'/index', [UserController::class, 'index'])->middleware('role:admin')->name('admin.user.index');
Route::get($basePath.$adminPath.'/create', [UserController::class, 'create'])->middleware('role:admin')->name('admin.user.create');
Route::post($basePath.$adminPath.'/store', [UserController::class, 'save'])->middleware('role:admin')->name('admin.user.store');
Route::get($basePath.$adminPath.'/edit/{id}', [UserController::class, 'edit'])->whereNumber('id')->middleware('role:admin')->name('admin.user.edit');
Route::put($basePath.$adminPath.'/update/{id}', [UserController::class, 'update'])->whereNumber('id')->middleware('role:admin')->name('admin.user.update');
Route::delete($basePath.$adminPath.'/delete/{id}', [UserController::class, 'delete'])->whereNumber('id')->middleware('role:admin')->name('admin.user.delete');

Route::get($basePath.$orderPath, [OrderController::class, 'index'])->middleware('role:user,admin')->name('order.index');
Route::get($basePath.$orderPath.'/{id}', [OrderController::class, 'show'])->whereNumber('id')->middleware('role:user,admin')->name('order.show');
Route::post($basePath.$orderPath, [OrderController::class, 'store'])->middleware('role:user,admin')->name('order.store');
