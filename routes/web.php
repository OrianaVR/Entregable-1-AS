<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
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
$productPath = 'product';
$cartPath = 'cart';
$categoryPath = 'category';
$reviewPath = 'reviews';




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

Route::get($basePath.$adminPath.'/'.$categoryPath, [CategoryController::class, 'index'])->middleware('role:admin')->name('admin.category.index');
Route::get($basePath.$adminPath.'/'.$categoryPath.'/create', [CategoryController::class, 'create'])->middleware('role:admin')->name('admin.category.create');
Route::post($basePath.$adminPath.'/'.$categoryPath.'/store', [CategoryController::class, 'save'])->middleware('role:admin')->name('admin.category.store');
Route::get($basePath.$adminPath.'/'.$categoryPath.'/edit/{id}', [CategoryController::class, 'edit'])->whereNumber('id')->middleware('role:admin')->name('admin.category.edit');
Route::put($basePath.$adminPath.'/'.$categoryPath.'/update/{id}', [CategoryController::class, 'update'])->whereNumber('id')->middleware('role:admin')->name('admin.category.update');
Route::delete($basePath.$adminPath.'/'.$categoryPath.'/delete/{id}', [CategoryController::class, 'delete'])->whereNumber('id')->middleware('role:admin')->name('admin.category.delete');

Route::get($basePath.$adminPath.'/'.$orderPath, [OrderController::class, 'adminIndex'])->middleware('role:admin')->name('admin.order.index');
Route::get($basePath.$orderPath.'/checkout', [OrderController::class, 'checkout'])->middleware('role:user,admin')->name('order.checkout');
Route::get($basePath.$orderPath, [OrderController::class, 'index'])->middleware('role:user,admin')->name('order.index');
Route::get($basePath.$orderPath.'/{id}', [OrderController::class, 'show'])->whereNumber('id')->middleware('role:user,admin')->name('order.show');
Route::post($basePath.$orderPath, [OrderController::class, 'store'])->middleware('role:user,admin')->name('order.store');
Route::get($basePath.$orderPath.'/{id}/receipt', [PaymentController::class, 'receipt'])->whereNumber('id')->middleware('role:user,admin')->name('payment.receipt');
Route::post($basePath.$orderPath.'/{id}/confirm', [PaymentController::class, 'confirm'])->whereNumber('id')->middleware('role:admin')->name('payment.confirm');
Route::post($basePath.$orderPath.'/{id}/reject', [PaymentController::class, 'reject'])->whereNumber('id')->middleware('role:admin')->name('payment.reject');

Route::get($basePath.$productPath, [ProductController::class, 'index'])->name('product.index');
Route::get($basePath.$productPath.'/{id}', [ProductController::class, 'show'])->whereNumber('id')->name('product.show');
Route::post($basePath.$productPath.'/{id}/reviews', [ReviewController::class, 'store'])->whereNumber('id')->middleware('auth')->name('review.store');
Route::delete($basePath.$reviewPath.'/{id}', [ReviewController::class, 'delete'])->whereNumber('id')->middleware('auth')->name('review.delete');
Route::post($basePath.$productPath.'/{id}/cart', [CartController::class, 'add'])->whereNumber('id')->middleware('auth')->name('cart.add');
Route::get($basePath.$adminPath.'/'.$productPath, [ProductController::class, 'adminIndex'])->middleware('role:admin')->name('admin.product.index');
Route::get($basePath.$adminPath.'/'.$productPath.'/create', [ProductController::class, 'create'])->middleware('role:admin')->name('product.create');
Route::post($basePath.$adminPath.'/'.$productPath.'/save', [ProductController::class, 'save'])->middleware('role:admin')->name('product.save');
Route::get($basePath.$adminPath.'/'.$productPath.'/edit/{id}', [ProductController::class, 'edit'])->whereNumber('id')->middleware('role:admin')->name('product.edit');
Route::put($basePath.$adminPath.'/'.$productPath.'/update/{id}', [ProductController::class, 'update'])->whereNumber('id')->middleware('role:admin')->name('product.update');
Route::delete($basePath.$adminPath.'/'.$productPath.'/delete/{id}', [ProductController::class, 'delete'])->whereNumber('id')->middleware('role:admin')->name('product.delete');

Route::delete($basePath.$cartPath.'/{id}', [CartController::class, 'remove'])->whereNumber('id')->middleware('auth')->name('cart.remove');
Route::post($basePath.$productPath.'/{id}',[ReviewController::class, 'store'])->name('review.store');