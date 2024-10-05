<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/fontawesome.min.js"
        integrity="sha512-NeFv3hB6XGV+0y96NVxoWIkhrs1eC3KXBJ9OJiTFktvbzJ/0Kk7Rmm9hJ2/c2wJjy6wG0a0lIgehHjCTDLRwWw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
