<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Tag;

/**
 * @mixin Tag
 */
class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::withCount('tweets')
            ->orderByDesc('tweets_count')
            ->take(3)
            ->get());
    }
}
