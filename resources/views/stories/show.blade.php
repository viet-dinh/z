@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="container mx-auto py-8 px-4">
        @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left side: Thumbnail -->
            <div class="mb-4 lg:mb-0">
                <div class="w-[240px] aspect-[2/3] overflow-hidden rounded-lg shadow-lg">
                    <img src="{{ $story->getThumbnailUrl() }}" alt="Story Thumbnail" class="object-cover w-full h-full">
                </div>
            </div>


            <!-- Right side: Story details -->
            <div class="space-y-4">
                <h1 class="text-3xl font-bold">{{ $story->title }}</h1>

                <div class="mt-8">
                    <div id="rating-stars" class="flex space-x-1 text-yellow-500 items-baseline">
                        <!-- Stars will be generated dynamically using jQuery -->
                        @for ($i = 1; $i <= 10; $i++)
                            <i class="fa-regular fa-star cursor-pointer hover:text-yellow-400"
                                data-value="{{ $i }}"></i>
                        @endfor
                        <p class="ml-2 text-gray-600">
                            <span id="average-rating">{{ $averageStar }}</span>
                            ({{ $starCount }} đánh giá)
                        </p>
                    </div>
                    <div id="rating-message" class="mt-2 text-green-600 hidden">Cảm ơn bạn đã đánh giá!</div>
                </div>
                @if ($star !== null)
                    <div class="mt-2 text-gray-600 flex items-center">
                        <p>Đánh giá của bạn:</p>
                        <span class="ml-1 text-yellow-500">
                            {{ $star }} <i class="fa-solid fa-star"></i>
                        </span>
                    </div>
                @endif

                <div class="flex flex-wrap items-center gap-4 text-gray-600">
                    <div class="flex items-center">
                        <span>{{ number_format($viewCount) }} lượt xem</span>
                    </div>
                </div>

                <p><strong>Tác giả:</strong> {{ $story->author_name }}</p>
                {{-- <p><strong>Người dịch truyện:</strong> {{ $story->translator ?? 'N/A' }}</p> --}}
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


        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-4 lg:order-2 order-1 mt-4">
                <h2 class="text-xl font-semibold">Truyện được đề xuất</h2>

                <div class="max-w-xs mx-auto  flex flex-col gap-4 mt-4"> <!-- Parent div for maximum width -->
                    @foreach ($recommendStories as $recommendStory)
                        @include('components.story', ['story' => $recommendStory])
                    @endforeach
                </div>
            </div>
            <div id="root" story-id="{{ $story->id }}" auth-user-id="{{ $authId }}"
                class="col-span-12 lg:col-span-8 lg:order-1 order-2"></div>
        </div>

        @vite(['resources/css/app.css'])
        @viteReactRefresh
        @vite('resources/js/app.jsx')
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/fontawesome.min.js"
        integrity="sha512-NeFv3hB6XGV+0y96NVxoWIkhrs1eC3KXBJ9OJiTFktvbzJ/0Kk7Rmm9hJ2/c2wJjy6wG0a0lIgehHjCTDLRwWw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            let averageRating = {{ $averageStar }};
            let personalRating = 0; // Store the user's personal rating

            $('#rating-stars i').each(function(index) {
                let starValue = index + 1;
                if (starValue <= Math.floor(averageRating)) {
                    $(this).removeClass('fa-regular').addClass('fa-solid fa-star');
                } else if (starValue === Math.ceil(averageRating) && averageRating % 1 >= 0.5) {
                    $(this).removeClass('fa-regular').addClass('fa-solid fa-star-half-alt');
                } else {
                    $(this).removeClass('fa-solid fa-star fa-star-half-alt').addClass('fa-regular fa-star');
                }
            });

            $('#rating-stars i').hover(function() {
                let starValue = $(this).data('value');
                $('#rating-stars i').each(function(index) {
                    let currentStar = index + 1;
                    if (currentStar <= starValue) {
                        $(this).removeClass('fa-regular').addClass('fa-solid fa-star');
                    } else {
                        $(this).removeClass('fa-solid fa-star fa-star-half-alt').addClass(
                            'fa-regular fa-star');
                    }
                });
            }, function() {
                $('#rating-stars i').each(function(index) {
                    let starValue = index + 1;
                    if (starValue <= personalRating || starValue <= Math.floor(averageRating)) {
                        $(this).removeClass('fa-regular').addClass('fa-solid fa-star');
                    } else if (starValue === Math.ceil(averageRating) && averageRating % 1 >= 0.5) {
                        $(this).removeClass('fa-regular').addClass('fa-solid fa-star-half-alt');
                    } else {
                        $(this).removeClass('fa-solid fa-star fa-star-half-alt').addClass(
                            'fa-regular fa-star');
                    }
                });
            });

            $('#rating-stars i').click(function() {
                personalRating = $(this).data('value');
                $.ajax({
                    url: 'api/v1/stories/{{ $story->id }}/ratings',
                    method: 'POST',
                    data: {
                        star: personalRating,
                    },
                    success: function(response) {
                        $('#rating-message').removeClass('hidden');
                        setTimeout(function() {
                            $('#rating-message').addClass('hidden');
                            location.reload();
                        }, 200);
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 401) {
                            const currentUrl = window.location.pathname + window.location
                            .search;
                            window.location.href =
                                `/login?redirect=${encodeURIComponent(currentUrl)}`;
                            return;
                        }
                        alert('Error submitting rating. Please try again.');
                    }
                });
            });
        });
    </script>
@endpush
