<?php

namespace App\Http\Controllers;

use App\Http\Resources\TweetResource;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function show(int $id)
    {
        return UserResource::make(User::whereId($id)->firstOrFail());
    }

    public function findTweetsByUserId(int $id)
    {
        $tweetsByUser = User::findOrFail($id)->tweets()->latest()->limit(10)->get();
        return TweetResource::collection($tweetsByUser);
    }
}
