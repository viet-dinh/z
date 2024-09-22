<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CreatedUpdatedBy;
    protected $fillable = ['name'];

    public function stories()
    {
        return $this->belongsToMany(Story::class);
    }
}
