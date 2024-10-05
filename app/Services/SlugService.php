<?php

namespace App\Services;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class SlugService
{
    public function createSlug(string $title, Model $model, $existingId = null)
    {
        $orginalSlug = Str::slug($title);
        $counter = 1;

        $getBuilder = fn() => in_array(SoftDeletes::class, class_uses($model)) ? $model::withTrashed() : $model::query();

        $tryingSlug = $orginalSlug;
        while ($getBuilder()->where(column: 'slug', operator: $tryingSlug)->where('id', '!=', $existingId)->exists()) {
            $tryingSlug = $orginalSlug . '-' . $counter;
            $counter++;
        }

        return $tryingSlug;
    }
}
