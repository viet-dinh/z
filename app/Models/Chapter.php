<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use CreatedUpdatedBy;

    protected $fillable = ['story_id', 'order', 'title', 'content'];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function storyView()
    {
        return $this->hasOne(StoryView::class);
    }
}
