<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <header class="p-3 border-bottom">
        <div class="container">
            <nav class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    Storyland
                </a>
                <div class="d-flex flex-row navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- <div class="nav-item dropdown hover-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button"
                            aria-expanded="false">
                            Thể loại
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item"
                                        href="{{ route('welcome', $category->id) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div> --}}
                    <div class="w-100">
                        <form class="col-12" action="{{ route('welcome') }}" method="GET">
                            <input type="search" class="form-control custom-input" placeholder="Tìm kiếm truyện..."
                                aria-label="Search" name="query" value="{{ request()->input('query') }}">
                        </form>
                    </div>
                </div>


                <div class="dropdown text-end">
                    @auth
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
                                    out</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    @else
                        <a href="{{ route('login') }}" class="d-block link-dark text-decoration-none">Login</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main class="flex-fill p-4">
        @yield('content')
    </main>

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
    $(document).ready(function() {})
</script>
