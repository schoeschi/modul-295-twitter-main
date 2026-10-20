<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/tweets', [TweetController::class, 'index']);
Route::post('/tweets', [TweetController::class, 'store'])->middleware('auth:sanctum');

Route::prefix('/users')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/{id}', 'show');
        Route::get('/{id}/tweets', 'findTweetsByUserId');
    });

Route::post('/login', [LoginController::class, 'login']);
Route::get('/auth', [LoginController::class, 'checkAuth'])->middleware('auth:sanctum');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');
