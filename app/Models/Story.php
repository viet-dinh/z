<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use CreatedUpdatedBy;

    protected $fillable = ['title', 'slug', 'thumbnail', 'author_name', 'status', 'description'];
    const STATUS_COMPLETE = 'complete';
    const STATUS_INCOMPLETE = 'incomplete';

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'story_category');
    }
}
