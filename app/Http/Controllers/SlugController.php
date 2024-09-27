<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SlugController extends Controller
{
    public function showStory(string $slug)
    {
        $story = Story::with('comments.replies.reactions', 'comments.reactions')->where('slug', $slug)->first();

        if (!$story) {
            return Redirect::to('/');
        }

        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('welcome')],
            ['title' => $story->title, 'url' => ''],
        ];

        $authId = Auth::id();

        return view('stories.show', compact('story', 'breadcrumbs', 'authId'));
    }

    public function showChapter(string $slug, int $chapterOrder)
    {
        $story = Story::where('slug', $slug)->first();

        if (!$story) {
            return Redirect::to('/');
        }

        $chapter = Chapter::where('story_id', $story->id)
            ->where('order', $chapterOrder)->first();

        if (!$chapter) {
            return Redirect::to('/');
        }

        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('welcome')],
            ['title' => $story->title, 'url' => route('story.show', $story->slug)],
            ['title' => $chapter->title, 'url' => ''], // Current page has no URL
        ];

        return view('chapters.show', compact('story', 'chapter', 'breadcrumbs'));
    }
}
