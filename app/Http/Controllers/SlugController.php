<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Story;
use App\Services\StoryViewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SlugController extends Controller
{
    public function __construct(private readonly StoryViewService $storyViewService)
    {
    }

    public function showStory(string $slug)
    {
        $story = Story::with('comments.replies.reactions', 'comments.reactions')->where('slug', $slug)->first();

        if (!$story) {
            return Redirect::to('/');
        }

        $this->storyViewService->incrementViewCount($story->id);
        $viewCount =  $this->storyViewService->totalCount($story->id);

        $breadcrumbs = [
            ['title' => 'Trang chủ', 'url' => route('welcome')],
            ['title' => $story->title, 'url' => ''],
        ];

        $authId = Auth::id();

        return view('stories.show', compact('story', 'breadcrumbs', 'authId', 'viewCount'));
    }

    public function showChapter(string $slug, int $chapterOrder)
    {
        $story = Story::where('slug', $slug)->first();
        $totalChapter = $story->chapters()->count();

        if (!$story) {
            return Redirect::to('/');
        }
        $chapter = Chapter::where('story_id', $story->id)
            ->where('order', $chapterOrder)->first();

        if (!$chapter) {
            return Redirect::to('/');
        }

        $viewCount = $this->storyViewService->incrementViewCount($story->id, $chapter->id)->count;

        $breadcrumbs = [
            ['title' => 'Trang chủ', 'url' => route('welcome')],
            ['title' => $story->title, 'url' => route('story.show', $story->slug)],
            ['title' => $chapter->title, 'url' => ''], // Current page has no URL
        ];

        $authId = Auth::id();

        return view('chapters.show', compact('story', 'chapter', 'breadcrumbs', 'authId', 'totalChapter', 'viewCount'));
    }
}
