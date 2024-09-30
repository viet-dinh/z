<nav aria-label="breadcrumb" class="mb-2">
    <ol class="flex space-x-2 text-gray-500">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$loop->last)
                <li>
                    <a href="{{ $breadcrumb['url'] }}" class="text-blue-600 hover:underline">
                        {{ $breadcrumb['title'] }}
                    </a>
                    <span>/</span>
                </li>
            @else
                <li aria-current="page" class="font-semibold text-gray-900">
                    {{ $breadcrumb['title'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
