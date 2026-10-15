<?php

use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/tweets', [TweetController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
