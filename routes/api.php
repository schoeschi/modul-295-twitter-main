<?php

use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

Route::get('/tweets', [TweetController::class, 'index']);
