<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tweets')->group(function () {
    Route::get('/', [TweetController::class, 'index']);
    Route::post('/', [TweetController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/{tweet}/like', [TweetController::class, 'like'])->middleware('auth:sanctum');
});

Route::prefix('/users')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/{user}', 'show');
        Route::get('/{user}/tweets', 'findTweetsByUserId');
    });

Route::post('/login', [LoginController::class, 'login']);
Route::get('/auth', [LoginController::class, 'checkAuth'])->middleware('auth:sanctum');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::put('/me', [UserController::class, 'updateMe'])->middleware('auth:sanctum');
Route::delete('/me', [UserController::class, 'deleteMe'])->middleware('auth:sanctum');
