<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class SlugService
{
    public function createSlug(string $title, Model $model, $existingId = null)
    {
        $slug = Str::slug($title);
        $counter = 1;

        while ($model::where(column: 'slug', operator: $slug)->where('id', '!=', $existingId)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
