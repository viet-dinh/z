@extends('layouts.main')

@section('content')
    <div class="container mx-auto py-8 px-4">
        @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="container mx-auto py-8 px-4">
            <!-- Chapter Title -->
            <h1 class="text-3xl font-bold mb-6">{{ $chapter->title }}</h1>

            <!-- Chapter Content -->
            <div class="prose lg:prose-lg max-w-full mb-8">
                {!! $chapter->content !!}
            </div>

            <!-- Previous and Next Chapter Navigation -->
            <div class="flex justify-between items-center py-4 border-t border-gray-200">
                @if ($chapter->order != 1)
                    <a href="{{ route('chapter.show', [$story->slug, $chapter->order - 1]) }}"
                        class="text-blue-600 hover:underline">
                        &larr; Chương trước
                    </a>
                @else
                    <span class="text-gray-400">&larr;</span>
                @endif

                @if ($chapter->order != $totalChapter)
                    <a href="{{ route('chapter.show', [$story->slug, $chapter->order + 1]) }}"
                        class="text-blue-600 hover:underline">
                        Chương tiếp theo &rarr;
                    </a>
                @else
                    <span class="text-gray-400">Chưa ra &rarr;</span>
                @endif
            </div>
        </div>

        <div id="root" story-id="{{ $chapter->story_id }}" auth-user-id="{{ $authId }}"></div>
        @vite(['resources/css/app.css'])
        @viteReactRefresh
        @vite('resources/js/app.jsx')
    </div>
@endsection
