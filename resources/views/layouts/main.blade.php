<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Truyện TV | Đọc Truyện Online')</title>

    <meta name="description" content="@yield('description', 'Thư viện truyện online lớn nhất, đọc miễn phí các câu chuyện hay nhất, từ tình cảm đến khoa học viễn tưởng.')">
    
    <meta property="og:title" content="@yield('title', 'Truyện TV | Đọc Truyện Online')">
    <meta property="og:description" content="@yield('description', 'Khám phá những câu chuyện hấp dẫn tại Truyện TV, nền tảng đọc truyện trực tuyến tốt nhất.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('og_image', asset('images/hero.png'))">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>

<body class="flex flex-col min-h-screen font-open">
    <header class="bg-white border-b">
        <div class="container mx-auto py-4">
            <nav class="flex items-center justify-between">
                <!-- Logo -->
                <a href="/" class="text-2xl font-island text-gray-900">
                    Truyện TV
                </a>

                <!-- Search Bar -->
                <div class="flex-grow mx-8 relative">
                    <form action="{{ route('search.show') }}" method="GET" class="w-full">
                        <input type="search"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Tìm kiếm truyện..." aria-label="Search" name="q"
                            value="{{ request()->input('q') }}">
                    </form>
                    <div id="search-results"
                        class="absolute left-0 w-full bg-white shadow-lg mt-2 rounded-md overflow-y-auto max-h-90 z-20 hidden">
                        <!-- Results will be injected here by jQuery -->
                    </div>
                </div>

                <!-- User Profile / Auth Links -->
                <div class="relative" id="user-dropdown">
                    @auth
                        <button id="dropdown-button"
                            class="text-gray-900 font-medium flex items-center space-x-2 focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <ul id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg z-10">
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition-colors duration-150"
                                    href="{{ route('profile.edit') }}">
                                    Trang cá nhân
                                </a>
                            </li>

                            <li>
                                <hr class="border-gray-200 my-2">
                            </li>

                            @if (Auth::user()->isAdmin())
                                <li>
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition-colors duration-150"
                                        href="{{ route('admin.dashboard') }}">
                                        Amin dashboard
                                    </a>
                                </li>

                                <li>
                                    <hr class="border-gray-200 my-2">
                                </li>
                            @endif
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition-colors duration-150 cursor-pointer"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @else
                        <a id="login-link" href="{{ route('login') }}" class="text-indigo-500 font-medium">
                            Login
                        </a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <!-- Alpine.js for dropdown functionality -->

    <main class="flex-grow">
        @yield('content')
    </main>

    <button id="goTopBtn" class="fixed hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="black" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20V4m0 0l-4 4m4-4l4 4" />
        </svg>
    </button>

    <!-- Footer -->
    <footer class="bg-footer-bg py-4">
        <div class="container mx-auto text-center text-sm text-footer-text">
            © 2024 Truyện TV. All rights reserved.
        </div>
    </footer>

    <!-- Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            const currentUrl = window.location.pathname + window.location.search;
            const redirectUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;
            $('#login-link').attr('href', redirectUrl);

            // Dropdown toggle
            // Toggle dropdown visibility on button click
            $('#dropdown-button').on('click', function(event) {
                event.stopPropagation(); // Prevent event bubbling
                $('#dropdown-menu').toggleClass('hidden');
            });

            // Close dropdown if clicked outside
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#user-dropdown').length) {
                    $('#dropdown-menu').addClass('hidden');
                }
            });

            let typingTimer;
            const typingInterval = 500; // Wait for 500ms after typing
            const searchInput = $('input[name="q"]');
            const searchResults = $('#search-results');

            searchInput.on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(performSearch, typingInterval);
            });

            searchInput.on('keydown', function() {
                clearTimeout(typingTimer);
            });

            searchInput.on('input', function() {
                if ($(this).val().length === 0) {
                    searchResults.addClass('hidden');
                }
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('#search-results').length && !$(event.target).is(
                        '#search-input')) {
                    searchResults.addClass('hidden');
                }
            });

            function performSearch() {
                const query = searchInput.val();
                if (query.length > 1) {
                    $.ajax({
                        url: "{{ route('search') }}",
                        method: 'GET',
                        data: {
                            q: query
                        },
                        success: function(data) {
                            displayResults(data);
                        },
                        error: function() {
                            console.error("Failed to fetch stories.");
                        }
                    });
                } else {
                    searchResults.addClass('hidden');
                }
            }

            function displayResults(stories) {
                searchResults.empty().removeClass('hidden');

                if (stories.length > 0) {
                    stories.forEach(story => {
                        searchResults.append(`
                        <a href="{{ route('story.show', '') }}/${story.slug}" class="flex items-center p-2 hover:bg-gray-100">
                            <img src="/thumbnails/${story.thumbnail}" alt="${story.title}" class="w-12 h-12 rounded-md mr-3">
                            <span class="text-gray-800">${story.title}</span>
                        </a>
                    `);
                    });
                } else {
                    searchResults.append('<p class="p-2 text-gray-500">Không tìm thấy truyện</p>');
                }
            }

            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('#goTopBtn').fadeIn();
                } else {
                    $('#goTopBtn').fadeOut();
                }
            });

            $('#goTopBtn').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
