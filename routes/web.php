<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('home.contact');

Route::get('/dev/login/admin', 'App\Http\Controllers\HomeController@devLoginAdmin')->name('dev.login.admin');
Route::get('/dev/login/client', 'App\Http\Controllers\HomeController@devLoginClient')->name('dev.login.client');

Route::get('/profile/{id}', 'App\Http\Controllers\ClientController@profile')->middleware('role:client,admin')->name('client.profile');
Route::put('/profile/update/{id}', 'App\Http\Controllers\ClientController@profileUpdate')->middleware('role:client,admin')->name('client.profile.update');

Route::get('/admin/index', 'App\Http\Controllers\ClientController@index')->middleware('role:admin')->name('admin.client.index');
Route::get('/admin/create', 'App\Http\Controllers\ClientController@create')->middleware('role:admin')->name('admin.client.create');
Route::post('/admin/store', 'App\Http\Controllers\ClientController@save')->middleware('role:admin')->name('admin.client.store');
Route::get('/admin/edit/{id}', 'App\Http\Controllers\ClientController@edit')->middleware('role:admin')->name('admin.client.edit');
Route::put('/admin/update/{id}', 'App\Http\Controllers\ClientController@update')->middleware('role:admin')->name('admin.client.update');
Route::get('/admin/delete/{id}', 'App\Http\Controllers\ClientController@delete')->middleware('role:admin')->name('admin.client.delete');