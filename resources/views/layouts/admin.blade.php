<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>

<body class="bg-gray-100">

    <div class="flex">
        <nav class="sidebar bg-gray-200 flex-shrink-0 p-4">
            <h5 class="text-gray-600 font-semibold mb-2">Admin Menu</h5>
            <ul class="space-y-2">
                <li>
                    <a class="block text-gray-700 hover:bg-gray-300 rounded p-2" href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a class="block text-gray-700 hover:bg-gray-300 rounded p-2" href="{{ route('categories.index') }}">
                        Categories
                    </a>
                </li>
                <li>
                    <a class="block text-gray-700 hover:bg-gray-300 rounded p-2" href="{{ route('stories.index') }}">
                        Stories
                    </a>
                </li>
            </ul>
        </nav>

        <main class="flex-grow p-6">
            @yield('content')
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const successMessage = $('#success-message');
            if (successMessage.length) {
                setTimeout(() => {
                    successMessage.removeClass('opacity-100').addClass('opacity-0');
                    setTimeout(() => {
                        successMessage
                            .hide();
                    }, 200);
                }, 1000);
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
