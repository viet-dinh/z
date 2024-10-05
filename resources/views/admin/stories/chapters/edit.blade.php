@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6">Edit Chapter for {{ $story->title }}</h1>
        <form action="{{ route('chapters.update', [$story->id, $chapter->id]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                <input type="number" name="order"
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ $chapter->order }}" required>
            </div>

            <div class="space-y-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title"
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ $chapter->title }}" required>
            </div>

            <div class="space-y-2">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content"
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                    rows="20" required>{{ $chapter->content }}</textarea>
            </div>

            <button type="submit"
                class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">Update
                Chapter</button>
        </form>
    </div>
@endsection
