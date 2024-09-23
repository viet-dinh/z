<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Story;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Query the latest 10 stories by `updated_at`
        $stories = Story::with('categories')
            ->orderBy('updated_at', 'desc')
            ->limit(12)
            ->get();
        $categories = Category::all();
        return view('welcome', compact('stories'), compact('categories'));
    }
}
