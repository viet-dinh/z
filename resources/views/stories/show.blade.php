@extends('layouts.main')

@section('content')
    <div class="container mx-auto py-8 px-4">
        @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left side: Thumbnail -->
            <div class="lg:w-1/3 mb-6 lg:mb-0">
                <div class="w-full h-72 lg:h-96 overflow-hidden rounded-lg shadow-lg">
                    <img src="{{ $story->getThumbnailUrl() }}" alt="Story Thumbnail" class="object-cover w-full h-full">
                </div>
            </div>

            <!-- Right side: Story details -->
            <div class="lg:w-2/3 space-y-4">
                <h1 class="text-3xl font-bold">{{ $story->title }}</h1>

                <div class="flex flex-wrap items-center gap-4 text-gray-600">
                    <div class="flex items-center text-yellow-500">
                        <i class="fas fa-star"></i>
                        <span class="ml-2">{{ $story->rating }} / 5</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-eye"></i>
                        <span class="ml-2">{{ $story->views ?? 0 }} lượt xem</span>
                    </div>
                    <div class="flex items-center text-red-500">
                        <i class="fas fa-heart"></i>
                        <span class="ml-2">{{ $story->likes ?? 0 }} lượt thích</span>
                    </div>
                </div>

                <p><strong>Tác giả:</strong> {{ $story->author_name }}</p>
                <p><strong>Người dịch truyện:</strong> {{ $story->translator ?? 'N/A' }}</p>
                <p><strong>Số chương:</strong> {{ $story->chapters->count() }}</p>
                <p><strong>Trạng thái:</strong>
                    @if ($story->status == 'complete')
                        <span class="text-green-500">Hoàn thành</span>
                    @else
                        <span class="text-yellow-500">Chưa hoàn thành</span>
                    @endif
                </p>
                <p class="text-gray-700 leading-relaxed">{{ $story->description }}</p>
            </div>
        </div>

        <!-- Chapters List -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Chương:</h2>
            <div class="space-y-2">
                @foreach ($story->chapters as $chapter)
                    <div
                        class="flex justify-between items-center py-3 px-4 bg-gray-50 rounded-lg shadow hover:bg-gray-100 transition duration-150">
                        <a href="{{ route('chapter.show', [$story->slug, $chapter->order]) }}"
                            class="font-semibold text-blue-600 hover:underline">
                            {{ "Chương $chapter->order: $chapter->title " }}
                        </a>
                        <span class="text-sm text-gray-500">{{ $chapter->created_at->format('d-m-Y') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- React Root -->
        <div id="root" story-id="{{ $story->id }}" auth-user-id="{{ $authId }}"></div>

        @vite(['resources/css/app.css'])
        @viteReactRefresh
        @vite('resources/js/app.jsx')
    </div>
@endsection
