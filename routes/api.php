<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tweets')
    ->controller(TweetController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{tweet}', 'find');
        Route::get('/{tweet}/related', 'related');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::post('/{tweet}/like', 'like')->middleware('auth:sanctum');
    });

Route::prefix('/users')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/top', 'top');
        Route::get('/new', 'new');
        Route::get('/{user}', 'show');
        Route::get('/{user}/tweets', 'findTweetsByUserId');
    });

Route::prefix('/me')
    ->controller(UserController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', 'me');
        Route::put('/', 'updateMe');
        Route::delete('/', 'deleteMe');
    });

Route::post('/login', [LoginController::class, 'login']);
Route::get('/auth', [LoginController::class, 'checkAuth'])->middleware('auth:sanctum');
Route::prefix('/logout')
    ->controller(LoginController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', 'logout');
        Route::post('/', 'logout');
    });
