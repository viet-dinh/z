@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <div>
            <a href="{{ route('stories.index') }}"
                class="inline-block bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700 mb-4">
                Back to Stories
            </a>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">

                Chapters of
                <span class="text-3xl font-extrabold text-blue-600 bg-blue-100 px-2 py-1 rounded-md">
                    {{ $story->title }}
                </span>
            </h1>
            @if (session('success'))
                <span id="success-message" class="bg-green-100 text-green-700 p-4 rounded-md mt-4">
                    {{ session('success') }}
                </span>
            @endif
            <a href="{{ route('chapters.create', $story->id) }}"
                class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                Add Chapter
            </a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-600 text-sm uppercase font-semibold">
                        <th class="py-3 px-4">Chapter</th>
                        <th class="py-3 px-4">Title</th>
                        <th class="py-3 px-4">Created At</th>
                        <th class="py-3 px-4">Updated At</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chapters as $chapter)
                        <tr class="border-t">
                            <td class="py-3 px-4">{{ $chapter->order }}</td>
                            <td class="py-3 px-4">{{ $chapter->title }}</td>
                            <td class="py-3 px-4">{{ $chapter->created_at->format('Y-m-d H:i') }}</td>
                            <td class="py-3 px-4">{{ $chapter->updated_at->format('Y-m-d H:i') }}</td>
                            <td class="py-3 px-4 flex space-x-4 text-center">
                                <a target="_blank"
                                    href="{{ route('chapter.show', ['slug' => $story->slug, 'order' => $chapter->order]) }}"
                                    class="text-blue-600 hover:text-blue-800 cursor-pointer p-1 transition" title="Preview">
                                    <i class="fas fa-eye text-xl"></i>
                                </a>
                                <a href="{{ route('chapters.edit', [$story->id, $chapter->id]) }}"
                                    class="text-yellow-600 hover:text-yellow-800 cursor-pointer p-1 transition"
                                    title="Edit">
                                    <i class="fas fa-edit text-xl"></i>
                                </a>
                                <form action="{{ route('chapters.destroy', [$story->id, $chapter->id]) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 cursor-pointer p-1 transition"
                                        title="Delete">
                                        <i class="fas fa-trash-alt text-xl"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $chapters->links('vendor.pagination.tailwind') }} <!-- Tailwind pagination view -->
        </div>
    </div>
@endsection
