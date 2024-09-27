<?php

namespace App\Models;

use App\Enums\ReactionType;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
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
