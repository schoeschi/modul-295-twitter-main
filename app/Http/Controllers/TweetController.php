<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweetRequest;
use App\Http\Resources\TweetResource;
use App\Models\Tag;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with('user')
            ->take(100)
            ->latest()
            ->get();
        return TweetResource::collection($tweets);
    }

    public function find(Tweet $tweet)
    {
        return TweetResource::make($tweet);
    }

    public function related(Tweet $tweet)
    {
        return TweetResource::collection(Tweet::whereUserId($tweet->user_id)
            ->take(20)
            ->get());
    }

    public function store(StoreTweetRequest $request)
    {
        $tweet = new Tweet();
        $tweet->text = $request->text;
        $tweet->user_id = $request->user()->id;
        $tweet->save();

        preg_match_all('/#([^\s#]+)/u', $tweet->text, $matches);
        $matches = array_unique($matches[1]);
        foreach ($matches as $tag) {
            $tweet->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
        }

        return TweetResource::make($tweet);
    }

    public function like(Tweet $tweet, Request $request)
    {
        if ($tweet->user_id == $request->user()->id) return ["message" => "Cannot like own post."];
        $request->user()->likedTweets()->toggle($tweet->id);
        return TweetResource::make($tweet);
    }
}
