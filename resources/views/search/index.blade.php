@extends('layouts.main')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-semibold mb-4">Kết quả tìm kiếm của: "{{ $query }}"</h1>

        @if ($stories->isEmpty())
            <p>Không tìm thấy kết quả</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($stories as $story)
                    <div class="p-4 border rounded-md shadow-md">
                        <a href="{{ route('story.show', $story->slug) }}" class="hover:underline">
                            <img src="{{ $story->getThumbnailUrl() }}" alt="{{ $story->title }}"
                                class="w-full h-32 object-cover mb-2 rounded-md">
                            <h2 class="text-lg font-semibold">{{ $story->title }}</h2>
                        </a>
                        <p class="text-sm text-gray-600">Tác giả: {{ $story->author_name }}</p>
                        <p class="text-gray-700 mt-1">{{ Str::limit($story->description, 100) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
