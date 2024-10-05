<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Story;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(Story $story)
    {
        $chapters = $story->chapters()->orderByDesc('id')->paginate(10);
        return view('admin.stories.chapters.index', compact('chapters', 'story'));
    }

    public function create(Story $story)
    {
        return view('admin.stories.chapters.create', compact('story'));
    }

    public function store(Story $story, Request $request)
    {
        $validatedData = $request->validate([
            'order' => 'required|numeric',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $story->chapters()->create($validatedData);

        return redirect()->route('chapters.index', $story->id)->with('success', 'Chapter created successfully.');
    }

    public function edit(Story $story, Chapter $chapter)
    {
        return view('admin.stories.chapters.edit', compact('chapter', 'story'));
    }

    public function update(Request $request, Story $story, Chapter $chapter)
    {
        $validatedData = $request->validate([
            'order' => 'required|numeric',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $chapter->update($validatedData);

        return redirect()->route('chapters.index', $story->id)->with('success', 'Chapter updated successfully.');
    }

    public function destroy(Story $story, Chapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('chapters.index', $story->id)->with('success', 'Chapter deleted successfully.');
    }
}
