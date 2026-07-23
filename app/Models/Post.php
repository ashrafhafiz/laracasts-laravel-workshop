<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['profile_id', 'parent_id', 'repost_of_id', 'content'])]
class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function reposts(): HasMany
    {
        return $this->hasMany(Post::class, 'repost_of_id');
    }

    public function repostOf(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'repost_of_id');
    }

    public function isRepost(): bool
    {
        return $this->repost_of_id !== null;
    }

    public static function publish(Profile $profile, string $content): self
    {
        return static::create([
            'profile_id' => $profile->id,
            'content' => $content,
            'parent_id' => null,
            'repost_of_id' => null
        ]);
    }

    public static function reply(Profile $replier, Post $originalPost, string $content): self
    {
        return static::create([
            'profile_id' => $replier->id,
            'content' => $content,
            'parent_id' => $originalPost->id,
            'repost_of_id' => null
        ]);
    }

    public static function repost(Profile $reposter, Post $originalPost, string $content = null): self
    {
        return static::firstOrCreate([
            'profile_id' => $reposter->id,
            'content' => $content,
            'parent_id' => null,
            'repost_of_id' => $originalPost->id,
        ]);
    }

    public static function removeRepost(Post $originalPost, Profile $reposter)
    {
        return static::where('profile_id', $reposter->id)
            ->where('repost_of_id', $originalPost->id)
            ->delete() > 0;
    }
}