<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', 'TestController@index');
Route::resource('/category', 'CategoryController')->middleware('auth');
Route::resource('/food', 'FoodController')->middleware('auth');
Route::get('/', 'FoodController@listFood')->middleware('auth');
Route::get('/view/{id}', 'FoodController@viewFood')->name('food.view')->middleware('auth');
Route::get('/deleteImage/{id}', 'FoodController@deleteImage')->name('food.deleteImage')->middleware('auth');
