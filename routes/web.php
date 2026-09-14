<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

$basePath = '/';
$aboutPath = 'about';
$contactPath = 'contact';

Route::get($basePath, [HomeController::class, 'index'])->name('home.index');
Route::get($basePath.$aboutPath, [HomeController::class, 'about'])->name('home.about');
Route::get($basePath.$contactPath, [HomeController::class, 'contact'])->name('home.contact');

Route::get('/dev/login/admin', 'App\Http\Controllers\HomeController@devLoginAdmin')->name('dev.login.admin');
Route::get('/dev/login/user', 'App\Http\Controllers\HomeController@devLoginUser')->name('dev.login.user');

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
