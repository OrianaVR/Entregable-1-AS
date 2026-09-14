<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('home.contact');

$profile_path = '/profile';
$admin_path = '/admin';
$order_path = '/order';

Route::get($profile_path . '/{id}', 'App\Http\Controllers\UserController@profile')->middleware('role:user,admin')->name('user.profile');
Route::put($profile_path . '/update/{id}', 'App\Http\Controllers\UserController@profileUpdate')->middleware('role:user,admin')->name('user.profile.update');

Route::get($admin_path . '/index', 'App\Http\Controllers\UserController@index')->middleware('role:admin')->name('admin.user.index');
Route::get($admin_path . '/create', 'App\Http\Controllers\UserController@create')->middleware('role:admin')->name('admin.user.create');
Route::post($admin_path . '/store', 'App\Http\Controllers\UserController@save')->middleware('role:admin')->name('admin.user.store');
Route::get($admin_path . '/edit/{id}', 'App\Http\Controllers\UserController@edit')->middleware('role:admin')->name('admin.user.edit');
Route::put($admin_path . '/update/{id}', 'App\Http\Controllers\UserController@update')->middleware('role:admin')->name('admin.user.update');
Route::delete($admin_path . '/delete/{id}', 'App\Http\Controllers\UserController@delete')->middleware('role:admin')->name('admin.user.delete');

Route::get($order_path, 'App\Http\Controllers\OrderController@index')->middleware('role:user,admin')->name('order.index');
Route::get($order_path . '/{id}', 'App\Http\Controllers\OrderController@show')->middleware('role:user,admin')->name('order.show');
Route::post($order_path, 'App\Http\Controllers\OrderController@store')->middleware('role:user,admin')->name('order.store');