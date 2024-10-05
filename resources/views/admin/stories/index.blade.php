@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6">Stories</h1>

        <div>
            <a href="{{ route('stories.create') }}"
                class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 mb-4">Add
                Story</a>

            @if (session('success'))
                <span id="success-message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
                    {{ session('success') }}
                </span>
            @endif
        </div>


        <div class="mb-4">
            <form method="GET" action="{{ route('stories.index') }}">
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
                        <td class="border px-4 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <a target="_blank" href="{{ route('story.show', $story->slug) }}"
                                    class="inline-block px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">Preview</a>
                                <a href="{{ route('chapters.index', $story->id) }}"
                                    class="inline-block px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Chapters</a>
                                <a href="{{ route('stories.edit', $story) }}"
                                    class="inline-block px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('stories.destroy', $story) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
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
