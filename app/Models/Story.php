<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Story extends Model
{
    use CreatedUpdatedBy, SoftDeletes;

    protected $fillable = ['title', 'slug', 'thumbnail', 'author_name', 'status', 'description', 'published_at'];
    const STATUS_COMPLETE = 'complete';
    const STATUS_INCOMPLETE = 'incomplete';

    protected $dates = [
        'published_at',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'story_category');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getThumbnailUrl(): string
    {
        return asset('thumbnails/' . $this->thumbnail);
    }

    public function storyViews()
    {
        return $this->hasMany(StoryView::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at');
    }
}
