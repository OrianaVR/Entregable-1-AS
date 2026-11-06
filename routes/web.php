<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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
$productPath = 'product';
$cartPath = 'cart';
$categoryPath = 'category';
$reviewPath = 'reviews';

Route::get($basePath, [HomeController::class, 'index'])->name('home.index');
Route::get($basePath.$aboutPath, [HomeController::class, 'about'])->name('home.about');
Route::get($basePath.$contactPath, [HomeController::class, 'contact'])->name('home.contact');
Route::get($basePath.$productPath, [ProductController::class, 'index'])->name('product.index');
Route::get($basePath.$productPath.'/{id}', [ProductController::class, 'show'])->whereNumber('id')->name('product.show');

Route::middleware(['guest'])->group(function () use ($basePath, $loginPath, $registerPath): void {
    Route::get($basePath.$loginPath, [AuthController::class, 'showLogin'])->name('login');
    Route::post($basePath.$loginPath, [AuthController::class, 'login'])->name('login.attempt');
    Route::get($basePath.$registerPath, [AuthController::class, 'showRegister'])->name('register');
    Route::post($basePath.$registerPath, [AuthController::class, 'register'])->name('register.attempt');
});

Route::middleware(['auth'])->group(function () use ($basePath, $logoutPath, $profilePath, $orderPath, $productPath, $reviewPath, $cartPath): void {
    Route::post($basePath.$logoutPath, [AuthController::class, 'logout'])->name('logout');

    Route::get($basePath.$profilePath.'/{id}', [UserController::class, 'profile'])->whereNumber('id')->name('user.profile');
    Route::put($basePath.$profilePath.'/update/{id}', [UserController::class, 'profileUpdate'])->whereNumber('id')->name('user.profile.update');

    Route::get($basePath.$orderPath.'/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get($basePath.$orderPath, [OrderController::class, 'index'])->name('order.index');
    Route::get($basePath.$orderPath.'/{id}', [OrderController::class, 'show'])->whereNumber('id')->name('order.show');
    Route::post($basePath.$orderPath, [OrderController::class, 'store'])->name('order.store');
    Route::get($basePath.$orderPath.'/{id}/receipt', [PaymentController::class, 'receipt'])->whereNumber('id')->name('payment.receipt');

    Route::post($basePath.$productPath.'/{id}/reviews', [ReviewController::class, 'store'])->whereNumber('id')->name('review.store');
    Route::delete($basePath.$reviewPath.'/{id}', [ReviewController::class, 'delete'])->whereNumber('id')->name('review.delete');
    Route::post($basePath.$productPath.'/{id}/cart', [CartController::class, 'add'])->whereNumber('id')->name('cart.add');
    Route::delete($basePath.$cartPath.'/{id}', [CartController::class, 'remove'])->whereNumber('id')->name('cart.remove');
});

Route::middleware(['auth', 'admin'])->prefix($adminPath)->group(function () use ($orderPath, $productPath, $categoryPath): void {
    Route::get('/index', [AdminUserController::class, 'index'])->name('admin.user.index');
    Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.create');
    Route::post('/store', [AdminUserController::class, 'save'])->name('admin.user.store');
    Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->whereNumber('id')->name('admin.user.edit');
    Route::put('/update/{id}', [AdminUserController::class, 'update'])->whereNumber('id')->name('admin.user.update');
    Route::delete('/delete/{id}', [AdminUserController::class, 'delete'])->whereNumber('id')->name('admin.user.delete');

    Route::get('/'.$categoryPath, [AdminCategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/'.$categoryPath.'/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/'.$categoryPath.'/store', [AdminCategoryController::class, 'save'])->name('admin.category.store');
    Route::get('/'.$categoryPath.'/edit/{id}', [AdminCategoryController::class, 'edit'])->whereNumber('id')->name('admin.category.edit');
    Route::put('/'.$categoryPath.'/update/{id}', [AdminCategoryController::class, 'update'])->whereNumber('id')->name('admin.category.update');
    Route::delete('/'.$categoryPath.'/delete/{id}', [AdminCategoryController::class, 'delete'])->whereNumber('id')->name('admin.category.delete');

    Route::get('/'.$orderPath, [AdminOrderController::class, 'index'])->name('admin.order.index');
    Route::post('/'.$orderPath.'/{id}/confirm', [AdminPaymentController::class, 'confirm'])->whereNumber('id')->name('payment.confirm');
    Route::post('/'.$orderPath.'/{id}/reject', [AdminPaymentController::class, 'reject'])->whereNumber('id')->name('payment.reject');

    Route::get('/'.$productPath, [AdminProductController::class, 'index'])->name('admin.product.index');
    Route::get('/'.$productPath.'/create', [AdminProductController::class, 'create'])->name('admin.product.create');
    Route::post('/'.$productPath.'/save', [AdminProductController::class, 'save'])->name('admin.product.save');
    Route::get('/'.$productPath.'/edit/{id}', [AdminProductController::class, 'edit'])->whereNumber('id')->name('admin.product.edit');
    Route::put('/'.$productPath.'/update/{id}', [AdminProductController::class, 'update'])->whereNumber('id')->name('admin.product.update');
    Route::delete('/'.$productPath.'/delete/{id}', [AdminProductController::class, 'delete'])->whereNumber('id')->name('admin.product.delete');
});
