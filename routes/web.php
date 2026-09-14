<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('home.contact');

$loginPath = 'login';
$registerPath = 'register';
$logoutPath = 'logout';

Route::get($loginPath, [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post($loginPath, [AuthController::class, 'login'])->middleware('guest')->name('login.attempt');
Route::get($registerPath, [AuthController::class, 'showRegister'])->middleware('guest')->name('register');
Route::post($registerPath, [AuthController::class, 'register'])->middleware('guest')->name('register.attempt');
Route::post($logoutPath, [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/profile/{id}', 'App\Http\Controllers\UserController@profile')->middleware('role:user,admin')->name('user.profile');
Route::put('/profile/update/{id}', 'App\Http\Controllers\UserController@profileUpdate')->middleware('role:user,admin')->name('user.profile.update');

Route::get('/admin/index', 'App\Http\Controllers\UserController@index')->middleware('role:admin')->name('admin.user.index');
Route::get('/admin/create', 'App\Http\Controllers\UserController@create')->middleware('role:admin')->name('admin.user.create');
Route::post('/admin/store', 'App\Http\Controllers\UserController@save')->middleware('role:admin')->name('admin.user.store');
Route::get('/admin/edit/{id}', 'App\Http\Controllers\UserController@edit')->middleware('role:admin')->name('admin.user.edit');
Route::put('/admin/update/{id}', 'App\Http\Controllers\UserController@update')->middleware('role:admin')->name('admin.user.update');
Route::get('/admin/delete/{id}', 'App\Http\Controllers\UserController@delete')->middleware('role:admin')->name('admin.user.delete');

Route::get('/order', 'App\Http\Controllers\OrderController@index')->middleware('role:user,admin')->name('order.index');
Route::get('/order/{id}', 'App\Http\Controllers\OrderController@show')->middleware('role:user,admin')->name('order.show');
Route::post('/order', 'App\Http\Controllers\OrderController@store')->middleware('role:user,admin')->name('order.store');
