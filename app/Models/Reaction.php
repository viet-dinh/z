<?php

namespace App\Models;

use App\Enums\ReactionType;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    public const REACTABLE_TYPES = ['comment', 'reply'];
    protected $fillable = ['reactable_id', 'reactable_type', 'user_id', 'type'];
    protected $casts = ['type' => 'integer'];

    public function reactable()
    {
        return $this->morphTo();
    }

    public function getReactionType(): ReactionType
    {
        return ReactionType::from($this->type);
    }
}