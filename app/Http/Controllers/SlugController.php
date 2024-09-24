<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SlugController extends Controller
{
    public function index(string $slug)
    {
        $story = Story::where('slug', $slug)->first();

        if (!$story) {
            return Redirect::to('/');
        }

        return view('stories.show', compact('story'));
    }
}
