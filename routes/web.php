<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('home.contact');

