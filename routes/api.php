<?php

use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/tweets', [TweetController::class, 'index']);
Route::prefix('/users')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/{id}', 'show');
        Route::get('/{id}/tweets', 'findTweetsByUserId');
    });
