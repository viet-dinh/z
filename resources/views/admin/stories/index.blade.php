@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Stories</h1>

            @if (session('success'))
                <span id="success-message" class="bg-green-100 border border-green-400 text-green-700 rounded relative">
                    {{ session('success') }}
                </span>
            @endif
            <a href="{{ route('stories.create') }}"
                class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Add
                Story</a>
        </div>

        <div class="mb-4">
            <form method="GET" action="{{ route('stories.index') }}" class="flex space-x-4">
                <input type="text" name="search" placeholder="Search stories..." class="px-4 py-2 border rounded-md"
                    value="{{ request('search') }}">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Search</button>
            </form>
        </div>

        <table class="table-auto w-full text-left border-collapse mt-6 bg-white">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Thumbnail</th>
                    <th class="px-4 py-2 border">Title</th>
                    <th class="px-4 py-2 border">Categories</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Created At</th>
                    <th class="px-4 py-2 border">Updated At</th>
                    <th class="px-4 py-2 border">Published</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stories as $story)
                    <tr>
                        <td class="border px-4 py-2">{{ $story->id }}</td>
                        <td class="border px-4 py-2">
                            <img src="{{ asset('thumbnails/' . $story->thumbnail) }}" alt="Thumbnail"
                                class="h-16 w-16 object-cover rounded-md">
                        </td>
                        <td class="border px-4 py-2">{{ $story->title }}</td>
                        <td class="border px-4 py-2">
                            @if ($story->categories->isNotEmpty())
                                <ul>
                                    @foreach ($story->categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span>No Categories</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $story->status }}</td>
                        <td class="border px-4 py-2">{{ $story->created_at->format('Y-m-d H:i') }}</td>
                        <td class="border px-4 py-2">{{ $story->updated_at->format('Y-m-d H:i') }}</td>

                        <td class="border px-4 py-2">
                            <form
                                action="{{ $story->published_at ? route('stories.unpublish', $story) : route('stories.publish', $story) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="page" value="{{ request()->get('page') }}">
                                <input type="hidden" name="search" value="{{ request()->get('search') }}">
                                <label class="inline-flex relative items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" onclick="this.form.submit()"
                                        {{ $story->published_at ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:bg-green-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all">
                                    </div>
                                </label>
                            </form>
                        </td>


                        <td class="border px-4 py-2 text-center">
                            <div class="flex justify-center space-x-4">

                                @if ($story->deleted_at)
                                    <form action="{{ route('stories.restore', $story) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        <input type="hidden" name="page" value="{{ request()->get('page') }}">
                                        <input type="hidden" name="search" value="{{ request()->get('search') }}">
                                        <button type="submit"
                                            class="text-green-600 hover:text-green-800 cursor-pointer p-1 transition"
                                            title="Restore">
                                            <i class="fas fa-undo text-xl"></i>
                                        </button>
                                    </form>
                                @else
                                    @if ($story->published_at)
                                        <a target="_blank" href="{{ route('story.show', $story->slug) }}"
                                            class="text-blue-600 hover:text-blue-800 cursor-pointer p-1 transition"
                                            title="Preview">
                                            <i class="fas fa-eye text-xl"></i>
                                        </a>
                                    @else
                                        <span class="text-blue-600 opacity-50 cursor-not-allowed p-1 transition"
                                            title="Preview">
                                            <i class="fas fa-eye text-xl"></i>
                                        </span>
                                    @endif
                                    <a href="{{ route('chapters.index', $story->id) }}"
                                        class="text-blue-600 hover:text-blue-800 cursor-pointer p-1 transition"
                                        title="View all chapters">
                                        <i class="fas fa-book text-xl"></i>
                                    </a>
                                    <a href="{{ route('stories.edit', $story) }}"
                                        class="text-yellow-600 hover:text-yellow-800 cursor-pointer p-1 transition"
                                        title="Edit">
                                        <i class="fas fa-edit text-xl"></i>
                                    </a>

                                    <form action="{{ route('stories.destroy', $story) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="page" value="{{ request()->get('page') }}">
                                        <input type="hidden" name="search" value="{{ request()->get('search') }}">
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 cursor-pointer p-1 transition"
                                            title="Delete" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash-alt text-xl"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <!-- Pagination Links -->
            {{ $stories->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
