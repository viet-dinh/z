<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        // incase hard delete
        // static::deleting(function (self $comment) {
        //     $comment->replies->each(function ($reply) {
        //         $reply->delete();
        //     });

        //     $comment->reactions()->delete();
        // });
    }


    protected $fillable = ['content', 'user_id', 'story_id', 'chapter_order'];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

    public function getReactionEmojis()
    {
        return $this->reactions->map(fn(Reaction $reaction) => $reaction->getReactionType()->getEmoji());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
