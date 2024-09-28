@extends('layouts.main')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])

    <div class="container mx-auto py-8">
        <div class="flex flex-col lg:flex-row">
            <!-- Left side: Thumbnail -->
            <div class="lg:w-1/3 mb-6 lg:mb-0">
                <img src="{{ $story->getThumnailUrl() }}" alt="Story Thumbnail" class="rounded-lg shadow-lg w-full">
            </div>

            <!-- Right side: Story details -->
            <div class="lg:w-2/3 pl-6">
                <h1 class="text-3xl font-bold mb-4">{{ $story->title }}</h1>

                <div class="flex items-center mb-4">
                    <div class="mr-4 text-yellow-500">
                        <i class="fas fa-star"></i> {{ $story->rating }} / 5
                    </div>
                    <div class="mr-4 text-gray-500">
                        <i class="fas fa-eye"></i> {{ $story->views }} views
                    </div>
                    <div class="text-red-500">
                        <i class="fas fa-heart"></i> {{ $story->likes }} likes
                    </div>
                </div>

                <p class="mb-2"><strong>Author:</strong> {{ $story->author }}</p>
                <p class="mb-2"><strong>Translator:</strong> {{ $story->translator ?? 'N/A' }}</p>
                <p class="mb-2"><strong>Chapters:</strong> {{ $story->current_chapter }} out of
                    {{ $story->total_chapters }}</p>
                <p class="mb-2"><strong>Status:</strong>
                    @if ($story->status == 'complete')
                        <span class="text-green-500">Complete</span>
                    @else
                        <span class="text-yellow-500">Incomplete</span>
                    @endif
                </p>
                <p class="mb-4"><strong>Description:</strong> {{ $story->description }}</p>
            </div>
        </div>

        <!-- Chapters List -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold">Chapters</h2>
            <div class="list-group">
                @foreach ($story->chapters as $chapter)
                    <div
                        class="flex justify-between items-center py-2 px-4 bg-gray-100 rounded-lg mb-2 shadow hover:bg-gray-200 transition duration-200">
                        <a href="{{ route('chapter.show', [$story->slug, $chapter->order]) }}"
                            class="font-semibold text-blue-600 hover:underline">{{ $chapter->title }}</a>
                        <span class="text-gray-500">{{ $chapter->created_at->format('M d, Y') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="root" story-id="{{ $story->id }}" auth-user-id="{{ $authId }}"></div>
        @vite(['resources/css/app.css'])
        @viteReactRefresh
        @vite('resources/js/app.jsx')
    @endsection
