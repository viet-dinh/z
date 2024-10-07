<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\SlugService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private SlugService $slugService)
    {
    }

    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate(perPage: 10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        Category::create([
            ...$request->only('name'),
            'slug' => $this->slugService->createSlug($request->name, new Category)
        ]);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update([
            ...$request->only('name'),
            'slug' => $this->slugService->createSlug($request->name, new Category, $category->id)
        ]);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
