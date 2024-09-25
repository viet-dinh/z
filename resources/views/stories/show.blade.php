@extends('layouts.main')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <div class="container mx-auto py-8">
        <div class="flex flex-wrap lg:flex-nowrap gap-6">
            <!-- Left side: Thumbnail -->
            <div class="w-full lg:w-1/3">
                <img src="{{ $story->getThumnailUrl() }}" alt="Story Thumbnail" class="rounded shadow-lg w-full">
            </div>

            <!-- Right side: Story details -->
            <div class="w-full lg:w-2/3">
                <!-- Story Title -->
                <h1 class="text-4xl font-bold mb-4">{{ $story->title }}</h1>

                <!-- Rating, Views, Likes -->
                <div class="flex items-center mb-4">
                    <!-- Rating -->
                    <div class="text-yellow-500 mr-6">
                        <i class="fas fa-star"></i> {{ $story->rating }} / 5
                    </div>

                    <!-- Views -->
                    <div class="text-gray-600 mr-6">
                        <i class="fas fa-eye"></i> {{ $story->views }} views
                    </div>

                    <!-- Likes -->
                    <div class="text-red-500">
                        <i class="fas fa-heart"></i> {{ $story->likes }} likes
                    </div>
                </div>

                <!-- Author and Translator -->
                <div class="text-lg mb-4">
                    <span class="font-semibold">Author:</span> {{ $story->author }}<br>
                    <span class="font-semibold">Translator:</span> {{ $story->translator ?? 'N/A' }}
                </div>

                <!-- Number of Chapters -->
                <div class="text-lg mb-4">
                    <span class="font-semibold">Chapters:</span> {{ $story->current_chapter }} out of
                    {{ $story->total_chapters }}
                </div>

                <!-- Status -->
                <div class="text-lg mb-4">
                    <span class="font-semibold">Status:</span>
                    @if ($story->status == 'complete')
                        <span class="text-green-500">Complete</span>
                    @else
                        <span class="text-orange-500">Incomplete</span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h2 class="text-xl font-bold mb-2">Description</h2>
                    <p>{{ $story->description }}</p>
                </div>
            </div>
        </div>

        <!-- Chapters List -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Chapters</h2>
            <div class="space-y-4">
                @foreach ($story->chapters as $chapter)
                    <div class="flex justify-between items-center bg-white dark:bg-gray-800 p-4 rounded shadow">
                        <a href="{{ route('chapter.show', [$story->slug, $chapter->order]) }}"
                            class="text-lg font-semibold hover:underline">
                            {{ $chapter->title }}
                        </a>
                        <span class="text-gray-500">{{ $chapter->created_at->format('M d, Y') }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
