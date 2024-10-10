@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <div class="hero flex flex-col justify-center items-center h-1/4 w-full bg-cover bg-center text-white text-center"
        style="background-image: url('{{ asset('images/hero.png') }}'); font-family: 'Island Moments', cursive;">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-semibold">Chào mừng đến với thế giới truyệnTV</h1>
    </div>

    <!-- New Stories Slider -->
    <div class="swiper new-stories my-10 mx-auto w-11/12 pb-12">
        <div class="swiper-wrapper">
            @foreach ($stories as $index => $story)
                @include('components.story', ['story' => $story])
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- Optional Banner Section -->
    <div class="bg-cover bg-center text-white text-center min-h-[180px]"
        style="background-image: url('{{ asset('images/banner.png') }}');">
        <!-- Banner content can go here -->
    </div>
    <!-- Popular Stories -->
    <section class="container mx-auto my-10">
        <h2 class="text-3xl text-center font-semibold mb-8">Truyện nổi bật</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 popular-stories">
            @foreach ($stories as $story)
                <a href="{{ route('story.show', $story->slug) }}">
                    <div class="story bg-white shadow-lg rounded-lg overflow-hidden story">
                        <img src="{{ $story->getThumbnailUrl() }}" alt="{{ $story->title }}"
                            class="w-full h-56 object-cover genre-card-img">
                        <div class="p-4">
                            <h3 class="text-xl font-bold story-title">{{ $story->title }}</h3>
                            <p class="text-gray-700 mt-2 story-description">{{ $story->description }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Island+Moments&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <link rel="canonical" href="https://truyentv.vn/" />
@endpush


@push('scripts')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Truyện TV",
        "description": "Nền tảng đọc truyện trực tuyến lớn nhất, nơi bạn có thể khám phá hàng ngàn câu chuyện độc đáo.",
        "url": "https://truyentv.vn/",
        "image": "{{ asset('images/hero.png') }}",
        "author": {
            "@type": "Organization",
            "name": "Truyện TV"
        }
    }
    </script>
    <script>
        $(document).ready(function() {
            var swiper = new Swiper(".new-stories", {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    },
                    1280: {
                        slidesPerView: 5,
                        spaceBetween: 40
                    },
                    1440: {
                        slidesPerView: 6,
                        spaceBetween: 40
                    },
                    1920: {
                        slidesPerView: 7,
                        spaceBetween: 50
                    },
                },
            });
        })
    </script>
@endpush
