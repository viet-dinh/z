<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Landing Page</title>
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
                <div class="flex-grow mx-8">
                    <form action="{{ route('welcome') }}" method="GET" class="w-full">
                        <input type="search"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Tìm kiếm truyện..." aria-label="Search" name="query"
                            value="{{ request()->input('query') }}">
                    </form>
                </div>

                <!-- User Profile / Auth Links -->
                <div class="relative">
                    @auth
                        <button class="text-gray-900 font-medium flex items-center space-x-2 focus:outline-none"
                            id="dropdownUser1">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ul class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden" id="userDropdown">
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    href="{{ route('profile.edit') }}">Trang cá nhân</a>
                            </li>
                            <li>
                                <hr class="border-gray-200 my-2">
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                                    xuất</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @else
                        <a href="{{ route('login') }}" class="text-indigo-500 font-medium" id="login-link">
                            Login
                        </a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-footer-bg py-4">
        <div class="container mx-auto text-center text-sm text-footer-text">
            © 2024 StoryLand. All rights reserved.
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            const currentUrl = window.location.pathname + window.location.search;
            const redirectUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;
            $('#login-link').attr('href', redirectUrl);

            // Dropdown toggle
            $('#dropdownUser1').on('click', function() {
                $('#userDropdown').toggleClass('hidden');
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
