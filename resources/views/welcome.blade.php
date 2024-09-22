<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Landing Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Island+Moments&display=swap" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">StoryLand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Genres</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Latest</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero d-flex flex-column justify-content-center align-items-center">
        <h1>Chào mừng đến với thế giới truyện</h1>
        {{-- <p class="lead">Where Every Story Finds Its Voice</p> --}}
    </div>
    <div class="d-flex justify-content-center">
        <div id="new-stories-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($stories->chunk(3) as $index => $chunk)
                    <div data-bs-target="#new-stories-carousel" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}"></div>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($stories->chunk(3) as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="5000">
                        <div class="row">
                            @foreach ($chunk as $story)
                                <div class="story col-md-4 d-flex flex-column align-items-center">
                                    <img src="{{ asset('thumbnails/' . $story->thumbnail) }}" class="img-fluid"
                                        alt="{{ $story->title }}"
                                        style="width: 200px; height: 300px; object-fit: cover;">
                                    <h5 class="mt-2 text-center">{{ $story->title }}</h5>
                                    <p class="text-center">{{ $story->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Story -->
    <section class="featured-story text-center">
        <div class="container">
            <h2>Featured Story</h2>
            <p class="lead">"A Journey Through the Stars" - A captivating sci-fi tale that takes you beyond the
                cosmos.</p>
            <a href="#" class="btn btn-success">Read Now</a>
        </div>
    </section>

    <!-- Popular Stories -->
    <section class="container my-5 popular-stories">
        <h2 class="text-center mb-4">Popular Stories</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card story">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Story 1">
                    <div class="card-body">
                        <h5 class="card-title">The Silent Whisper</h5>
                        <p class="card-text">A mystery that unravels in the dead of night.</p>
                        <a href="#" class="btn btn-outline-secondary">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card story">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Story 2">
                    <div class="card-body">
                        <h5 class="card-title">Ember of Time</h5>
                        <p class="card-text">An epic fantasy adventure across realms.</p>
                        <a href="#" class="btn btn-outline-secondary">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card story">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Story 3">
                    <div class="card-body">
                        <h5 class="card-title">Romance in the Rain</h5>
                        <p class="card-text">A heartfelt love story set in a quaint town.</p>
                        <a href="#" class="btn btn-outline-secondary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2024 StoryLand. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        const myCarouselElement = document.querySelector('#new-stories-carousel')
        const carousel = new bootstrap.Carousel(myCarouselElement, {
            interval: 5000,
        })
    })
</script>
