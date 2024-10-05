<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Story;
use App\Services\SlugService;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function __construct(private SlugService $slugService)
    {
    }

    public function index(Request $request)
    {
        $query = Story::withTrashed()->with('categories');

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $stories = $query->orderByDesc('id')->paginate(10);

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

        $slug = $this->slugService->createSlug($request->title, new Story);

        $image = $request->file('thumbnail');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('thumbnails'), $imageName);

        $story = Story::create([...$request->only('title', 'author_name', 'status', 'description'), 'thumbnail' => $imageName, 'slug' => $slug]);
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
        $updateFiedls['slug'] = $this->slugService->createSlug($request->title, new Story, $story->id);

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

        return $this->redirectTo('Story is deleted successfully.');
    }

    public function restore($id)
    {
        $story = Story::withTrashed()->findOrFail($id);
        $story->restore();

        return $this->redirectTo('Story is restored successfully.');
    }

    public function unpublish(Story $story)
    {
        $story->update(['published_at' => null]);
        return $this->redirectTo('Story is un-published successfully.');
    }

    public function publish($id)
    {
        $story = Story::withTrashed()->findOrFail($id);
        $story->update(['published_at' => now()]);

        return $this->redirectTo('Story is published successfully.');
    }

    private function redirectTo(string $message)
    {
        $page = request('page');
        $search = request('search');

        return redirect()->route('stories.index', ['page' => $page, 'search' => $search])
            ->with('success', $message);
    }
}
