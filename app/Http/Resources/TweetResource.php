<?php

namespace App\Http\Resources;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Tweet
 */
class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "text" => $this->text,
            "likes" => $this->likes,
            "created_at" => $this->created_at->format('c'),
            "user" => UserResource::make($this->user),
        ];
    }
}
