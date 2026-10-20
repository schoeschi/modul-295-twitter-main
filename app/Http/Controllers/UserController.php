<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\NewUserResource;
use App\Http\Resources\TopUserResource;
use App\Http\Resources\TweetResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return UserResource::make($user);
    }

    public function findTweetsByUserId(User $user)
    {
        $tweetsByUser = $user->tweets()->with('user')->latest()->limit(10)->get();
        return TweetResource::collection($tweetsByUser);
    }

    public function me(Request $request)
    {
        return UserResource::make($request->user());
    }

    public function updateMe(UpdateUserRequest $request)
    {
        $user = $request->user();

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return UserResource::make($user);
    }

    public function deleteMe(Request $request)
    {
        $request->user()->delete();
        return ["message" => "User deleted"];
    }

    public function top()
    {
        return TopUserResource::collection(User::withCount('tweets')
            ->orderByDesc('tweets_count')
            ->take(3)
            ->get());
    }

    public function new()
    {
        return NewUserResource::collection(User::take(3)->get());
    }
}
