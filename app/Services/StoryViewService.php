<?php

namespace App\Services;

use App\Models\StoryView;

class StoryViewService
{
    public function incrementViewCount(int $storyId, int $chapterId = null): StoryView
    {
        $storyView = StoryView::firstOrCreate(
            ['story_id' => $storyId, 'chapter_id' => $chapterId],
            ['count' => 0]
        );

        $storyView->increment('count');
        return $storyView;
    }

    public function totalCount(int $storyId): int
    {
        return StoryView::where('story_id', $storyId)
            ->sum('count') ?? 0;
    }
}
