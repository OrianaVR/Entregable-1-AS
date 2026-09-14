<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('home.contact');

$profilePath = '/profile';
$adminPath = '/admin';
$orderPath = '/order';

Route::get($profilePath.'/{id}', 'App\Http\Controllers\UserController@profile')->middleware('role:user,admin')->name('user.profile')->whereNumber('id');
Route::put($profilePath.'/update/{id}', 'App\Http\Controllers\UserController@profileUpdate')->middleware('role:user,admin')->name('user.profile.update')->whereNumber('id');

Route::get($adminPath.'/index', 'App\Http\Controllers\UserController@index')->middleware('role:admin')->name('admin.user.index');
Route::get($adminPath.'/create', 'App\Http\Controllers\UserController@create')->middleware('role:admin')->name('admin.user.create');
Route::post($adminPath.'/store', 'App\Http\Controllers\UserController@save')->middleware('role:admin')->name('admin.user.store');
Route::get($adminPath.'/edit/{id}', 'App\Http\Controllers\UserController@edit')->middleware('role:admin')->name('admin.user.edit')->whereNumber('id');
Route::put($adminPath.'/update/{id}', 'App\Http\Controllers\UserController@update')->middleware('role:admin')->name('admin.user.update')->whereNumber('id');
Route::delete($adminPath.'/delete/{id}', 'App\Http\Controllers\UserController@delete')->middleware('role:admin')->name('admin.user.delete')->whereNumber('id');

Route::get($orderPath, 'App\Http\Controllers\OrderController@index')->middleware('role:user,admin')->name('order.index');
Route::get($orderPath.'/{id}', 'App\Http\Controllers\OrderController@show')->middleware('role:user,admin')->name('order.show')->whereNumber('id');
Route::post($orderPath, 'App\Http\Controllers\OrderController@store')->middleware('role:user,admin')->name('order.store');
