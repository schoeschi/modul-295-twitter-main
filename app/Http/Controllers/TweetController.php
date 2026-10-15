<?php

namespace App\Http\Controllers;

use App\Http\Resources\TweetResource;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::all()->take(100)->sortByDesc('created_at');
        return TweetResource::collection($tweets);
    }
}
