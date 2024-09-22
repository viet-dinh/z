<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Landing Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .hero {
            background-image: url('https://via.placeholder.com/1920x600');
            /* Replace with your image */
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
        }

        .genre-card img {
            height: 200px;
            object-fit: cover;
        }

        .featured-story {
            background-color: #f8f9fa;
            padding: 50px;
        }

        .popular-stories .story {
            margin-bottom: 30px;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        body {
            font-family: 'Open Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            /* Bold for headings */
        }

        p,
        a,
        button {
            font-weight: 400;
            /* Normal weight for body text */
        }

        .hero h1 {
            font-weight: 600;
            /* Slightly bold for the hero heading */
        }
    </style>
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
        <h1>Welcome to StoryLand</h1>
        <p class="lead">Where Every Story Finds Its Voice</p>
        <a href="#" class="btn btn-primary btn-lg">Explore Stories</a>
    </div>

    <!-- Genre Section -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Explore by Genre</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card genre-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Fiction">
                    <div class="card-body">
                        <h5 class="card-title">Fiction</h5>
                        <a href="#" class="btn btn-outline-primary">Discover</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card genre-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Fantasy">
                    <div class="card-body">
                        <h5 class="card-title">Fantasy</h5>
                        <a href="#" class="btn btn-outline-primary">Discover</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card genre-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Mystery">
                    <div class="card-body">
                        <h5 class="card-title">Mystery</h5>
                        <a href="#" class="btn btn-outline-primary">Discover</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
