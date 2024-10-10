<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Story;

class HomeController extends Controller
{
    public function index()
    {
        $stories = Story::with('categories')
            ->published()
            ->orderBy('updated_at', 'desc')
            ->limit(12)
            ->get();
        $categories = Category::all();
        return view('home', compact('stories'), compact('categories'));
    }
}
