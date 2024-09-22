<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::with('categories')->get();
        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.stories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_name' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'description' => 'required|string',
            'categories' => 'array',
        ]);

        $image = $request->file('thumbnail');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('thumbnails'), $imageName);

        $story = Story::create([...$request->only('title', 'author_name', 'status', 'description'), 'thumbnail' => $imageName]);
        $story->categories()->attach($request->categories);

        return redirect()->route('stories.index')->with('success', 'Story created successfully.');
    }

    public function edit(Story $story)
    {
        $categories = Category::all();
        return view('admin.stories.edit', compact('story'), compact('categories'));
    }

    public function update(Request $request, Story $story)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_name' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'description' => 'required|string',
            'categories' => 'array',
        ]);

        $updateFiedls = $request->only('title', 'author_name', 'status', 'description');

        if ($request->hasFile('thumbnail')) {
            $oldThumbnailPath = public_path('thumbnails/' . $story->thumbnail);
            if (file_exists($oldThumbnailPath)) {
                unlink($oldThumbnailPath);
            }

            $image = $request->file('thumbnail');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('thumbnails'), $imageName);
            $updateFiedls['thumbnail'] = $imageName;
        }

        $story->update($updateFiedls);
        $story->categories()->sync($request->categories);

        return redirect()->route('stories.index')->with('success', 'Story updated successfully.');
    }

    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route('stories.index')->with('success', 'Story deleted successfully.');
    }
}
