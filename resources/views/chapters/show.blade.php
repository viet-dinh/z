@extends('layouts.main')

@section('content')
    <div class="container mx-auto py-8 px-4">
        @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="container mx-auto py-8 px-4">
            <div class="flex flex-col items-center">
                <h1 class="text-3xl font-bold mb-6 text-center">{{ $chapter->title }}</h1>
                <div id="chapter-content" class="max-w-full mb-8 whitespace-pre-line break-words">{!! $chapter->content !!}
                </div>
            </div>

            <div class="flex justify-between items-center py-4 border-t border-gray-200">
                @if ($chapter->order != 1)
                    <a href="{{ route('chapter.show', [$story->slug, $chapter->order - 1]) }}"
                        class="text-blue-600 hover:underline">
                        &larr; Chương trước
                    </a>
                @else
                    <span class="text-gray-400">&larr;</span>
                @endif

                @if ($chapter->order != $totalChapter)
                    <a href="{{ route('chapter.show', [$story->slug, $chapter->order + 1]) }}"
                        class="text-blue-600 hover:underline">
                        Chương tiếp theo &rarr;
                    </a>
                @else
                    <span class="text-gray-400">Chưa ra &rarr;</span>
                @endif
            </div>
        </div>

        <button id="settings-button" class="fixed p-3 rounded-full shadow-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="24px"
                width="24px" version="1.1" id="Capa_1" viewBox="0 0 54 54" xml:space="preserve">
                <g>
                    <path
                        d="M51.22,21h-5.052c-0.812,0-1.481-0.447-1.792-1.197s-0.153-1.54,0.42-2.114l3.572-3.571   c0.525-0.525,0.814-1.224,0.814-1.966c0-0.743-0.289-1.441-0.814-1.967l-4.553-4.553c-1.05-1.05-2.881-1.052-3.933,0l-3.571,3.571   c-0.574,0.573-1.366,0.733-2.114,0.421C33.447,9.313,33,8.644,33,7.832V2.78C33,1.247,31.753,0,30.22,0H23.78   C22.247,0,21,1.247,21,2.78v5.052c0,0.812-0.447,1.481-1.197,1.792c-0.748,0.313-1.54,0.152-2.114-0.421l-3.571-3.571   c-1.052-1.052-2.883-1.05-3.933,0l-4.553,4.553c-0.525,0.525-0.814,1.224-0.814,1.967c0,0.742,0.289,1.44,0.814,1.966l3.572,3.571   c0.573,0.574,0.73,1.364,0.42,2.114S8.644,21,7.832,21H2.78C1.247,21,0,22.247,0,23.78v6.439C0,31.753,1.247,33,2.78,33h5.052   c0.812,0,1.481,0.447,1.792,1.197s0.153,1.54-0.42,2.114l-3.572,3.571c-0.525,0.525-0.814,1.224-0.814,1.966   c0,0.743,0.289,1.441,0.814,1.967l4.553,4.553c1.051,1.051,2.881,1.053,3.933,0l3.571-3.572c0.574-0.573,1.363-0.731,2.114-0.42   c0.75,0.311,1.197,0.98,1.197,1.792v5.052c0,1.533,1.247,2.78,2.78,2.78h6.439c1.533,0,2.78-1.247,2.78-2.78v-5.052   c0-0.812,0.447-1.481,1.197-1.792c0.751-0.312,1.54-0.153,2.114,0.42l3.571,3.572c1.052,1.052,2.883,1.05,3.933,0l4.553-4.553   c0.525-0.525,0.814-1.224,0.814-1.967c0-0.742-0.289-1.44-0.814-1.966l-3.572-3.571c-0.573-0.574-0.73-1.364-0.42-2.114   S45.356,33,46.168,33h5.052c1.533,0,2.78-1.247,2.78-2.78V23.78C54,22.247,52.753,21,51.22,21z M52,30.22   C52,30.65,51.65,31,51.22,31h-5.052c-1.624,0-3.019,0.932-3.64,2.432c-0.622,1.5-0.295,3.146,0.854,4.294l3.572,3.571   c0.305,0.305,0.305,0.8,0,1.104l-4.553,4.553c-0.304,0.304-0.799,0.306-1.104,0l-3.571-3.572c-1.149-1.149-2.794-1.474-4.294-0.854   c-1.5,0.621-2.432,2.016-2.432,3.64v5.052C31,51.65,30.65,52,30.22,52H23.78C23.35,52,23,51.65,23,51.22v-5.052   c0-1.624-0.932-3.019-2.432-3.64c-0.503-0.209-1.021-0.311-1.533-0.311c-1.014,0-1.997,0.4-2.761,1.164l-3.571,3.572   c-0.306,0.306-0.801,0.304-1.104,0l-4.553-4.553c-0.305-0.305-0.305-0.8,0-1.104l3.572-3.571c1.148-1.148,1.476-2.794,0.854-4.294   C10.851,31.932,9.456,31,7.832,31H2.78C2.35,31,2,30.65,2,30.22V23.78C2,23.35,2.35,23,2.78,23h5.052   c1.624,0,3.019-0.932,3.64-2.432c0.622-1.5,0.295-3.146-0.854-4.294l-3.572-3.571c-0.305-0.305-0.305-0.8,0-1.104l4.553-4.553   c0.304-0.305,0.799-0.305,1.104,0l3.571,3.571c1.147,1.147,2.792,1.476,4.294,0.854C22.068,10.851,23,9.456,23,7.832V2.78   C23,2.35,23.35,2,23.78,2h6.439C30.65,2,31,2.35,31,2.78v5.052c0,1.624,0.932,3.019,2.432,3.64   c1.502,0.622,3.146,0.294,4.294-0.854l3.571-3.571c0.306-0.305,0.801-0.305,1.104,0l4.553,4.553c0.305,0.305,0.305,0.8,0,1.104   l-3.572,3.571c-1.148,1.148-1.476,2.794-0.854,4.294c0.621,1.5,2.016,2.432,3.64,2.432h5.052C51.65,23,52,23.35,52,23.78V30.22z" />
                    <path
                        d="M27,18c-4.963,0-9,4.037-9,9s4.037,9,9,9s9-4.037,9-9S31.963,18,27,18z M27,34c-3.859,0-7-3.141-7-7s3.141-7,7-7   s7,3.141,7,7S30.859,34,27,34z" />
                </g>
            </svg>
        </button>

        <div id="toolbar"
            class="fixed bottom-24 right-6 p-4 shadow-lg rounded-lg space-y-4 z-50 hidden bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
            <div class="p-6 rounded-lg shadow-lg w-80 space-y-6">
                <button id="toggle-dark-mode"
                    class="w-full py-2 px-4 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Light Mode
                </button>

                <div class="flex justify-center items-center space-x-4">
                    <button id="decrease-font"
                        class="py-2 px-3 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        -
                    </button>
                    <span class="text-sm">Cỡ chữ</span>
                    <button id="increase-font"
                        class="py-2 px-3 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        +
                    </button>
                </div>

                <div class="flex justify-center items-center space-x-4">
                    <button id="decrease-width"
                        class="py-2 px-3 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        -
                    </button>
                    <span class="text-sm">Độ rộng</span>
                    <button id="increase-width"
                        class="py-2 px-3 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        +
                    </button>
                </div>
            </div>
        </div>


        <div id="root" story-id="{{ $chapter->story_id }}" auth-user-id="{{ $authId }}"></div>
        @vite(['resources/css/app.css'])
        @viteReactRefresh
        @vite('resources/js/app.jsx')
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const body = $('body');
            const toolbar = $('#toolbar');
            const chapterContent = $('#chapter-content');
            const settingsButton = $('#settings-button');
            const toggleDarkModeButton = $('#toggle-dark-mode');

            const savedDarkMode = localStorage.getItem('darkMode');
            const savedFontSize = localStorage.getItem('fontSize');
            const savedWidth = localStorage.getItem('contentWidth');

            if (savedDarkMode === 'true') {
                body.addClass('dark');
                toggleDarkModeButton.text('Light Mode');
            } else {
                toggleDarkModeButton.text('Dark Mode');
            }

            if (savedFontSize) {
                chapterContent.css('font-size', savedFontSize + 'px');
            }

            if (savedWidth) {
                chapterContent.css('width', savedWidth + '%');
            }

            settingsButton.on('click', function() {
                toolbar.toggleClass('hidden');
            });

            toggleDarkModeButton.on('click', function() {
                body.toggleClass('dark');
                const isDarkMode = body.hasClass('dark');
                localStorage.setItem('darkMode', isDarkMode);
                toggleDarkModeButton.text(isDarkMode ? 'Light Mode' : 'Dark Mode');
            });

            let fontSize = savedFontSize ? parseInt(savedFontSize) : 16;
            $('#increase-font').on('click', function() {
                fontSize += 1;
                chapterContent.css('font-size', fontSize + 'px');
                localStorage.setItem('fontSize', fontSize);
            });
            $('#decrease-font').on('click', function() {
                fontSize = Math.max(10, fontSize - 1);
                chapterContent.css('font-size', fontSize + 'px');
                localStorage.setItem('fontSize', fontSize);
            });

            let contentWidth = savedWidth ? parseInt(savedWidth) : 70;
            $('#increase-width').on('click', function() {
                contentWidth = Math.min(100, contentWidth + 3);
                chapterContent.css('width', contentWidth + '%');
                localStorage.setItem('contentWidth', contentWidth);
            });
            $('#decrease-width').on('click', function() {
                contentWidth = Math.max(50, contentWidth - 3);
                chapterContent.css('width', contentWidth + '%');
                localStorage.setItem('contentWidth', contentWidth);
            });
        });
    </script>
@endpush
