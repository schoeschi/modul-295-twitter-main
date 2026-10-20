<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $text
 * @property int|null $likes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TweetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tweet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tweet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tweet query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tweet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tweet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tweet whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tweet whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tweet whereUpdatedAt($value)
 * @property int $user_id
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tweet whereUserId($value)
 * @mixin \Eloquent
 */
class Tweet extends Model
{
    /** @use HasFactory<\Database\Factories\TweetFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likers(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
