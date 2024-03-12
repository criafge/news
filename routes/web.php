<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\user\GradeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::get('category/{category}', CategoryController::class)->name('category');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'App\Http\Controllers\admin', 'middleware' => 'admin'], function () {
        Route::get('admin', 'IndexController')->name('admin');
        Route::resource('news', 'NewsController')->except('index', 'create');
        Route::get('change/limit/{news}', 'NewsController@changeLimit')->name('change-limit');
        Route::get('block/{user}', [UserController::class, 'block'])->name('block');
        Route::get('news/{news}', 'NewsController@show')->withoutMiddleware([Admin::class]);
    });

    Route::group(['namespace' => 'App\Http\Controllers\user', 'middleware' => 'user'], function () {
        Route::post('create/comment/{news}', 'CommentController')->name('create-comment');
        Route::get('news/{news}/{whichGrade}', [GradeController::class, 'changeGrade'])->name('change-grade');
        Route::post('update/user', [UserController::class, 'updateUser'])->name('update-user');
    });
});
