<?php

namespace App\Models;

use App\Enums\ReactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reply extends Model
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        // incase hard delete
        // static::deleting(function (self $reply) {
        //     $reply->reactions()->delete();
        // });
    }

    protected $fillable = [
        'content',
        'user_id',
        'comment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

    public function getReactionEmojis()
    {
        return $this->reactions->map(function ($reaction) {
            return ReactionType::from($reaction->type)->getEmoji();
        });
    }
}
