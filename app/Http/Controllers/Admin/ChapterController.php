<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Story;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with('story')->get();
        return view('admin.chapters.index', compact('chapters'));
    }

    public function create()
    {
        $stories = Story::all();
        return view('admin.chapters.create', compact('stories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'story_id' => 'required|exists:stories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Chapter::create($request->only('story_id', 'title', 'content'));

        return redirect()->route('chapters.index')->with('success', 'Chapter created successfully.');
    }

    public function edit(Chapter $chapter)
    {
        $stories = Story::all();
        return view('admin.chapters.edit', compact('chapter', 'stories'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'story_id' => 'required|exists:stories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $chapter->update($request->only('story_id', 'title', 'content'));

        return redirect()->route('chapters.index')->with('success', 'Chapter updated successfully.');
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->route('chapters.index')->with('success', 'Chapter deleted successfully.');
    }
}
