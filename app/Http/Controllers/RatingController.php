<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rate(Request $request, Story $story)
    {
        $request->validate([
            'star' => 'required|integer|min:1|max:10',
        ]);

        return Rating::updateOrCreate(
            [
                'story_id' => $story->id,
                'user_id' => Auth::id(),
            ],
            [
                'star' => $request->input('star'),
            ]
        );
    }
}