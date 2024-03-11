<?php

use App\Http\Controllers\IndexController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['namespace' => 'App\Http\Controllers\admin', 'middleware' => 'admin'], function () {
    Route::get('admin', 'IndexController')->name('admin');
    Route::resource('news', 'NewsController')->except('index', 'create');
});
Route::get('news/{news}', 'NewsController@show')->withoutMiddleware([Admin::class]);
