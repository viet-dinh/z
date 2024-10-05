@extends('layouts.admin')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Edit Story</h1>

        <form action="{{ route('stories.update', $story) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title"
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 @error('title') border-red-500 @enderror"
                    value="{{ old('title', $story->title) }}" required>
                @error('title')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700">Upload Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail"
                    class="block w-full text-gray-500 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md focus:outline-none focus:ring focus:ring-blue-500 @error('thumbnail') border-red-500 @enderror"
                    accept="image/*">
                @error('thumbnail')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            @if ($story->thumbnail)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Current Thumbnail:</label>
                    <img src="{{ asset('thumbnails/' . $story->thumbnail) }}" alt="Current Thumbnail"
                        class="mt-2 rounded-md max-h-48">
                </div>
            @endif

            <div class="mb-4">
                <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                <div class="relative">
                    <select name="categories[]" id="categories"
                        class="block w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 @error('categories') border-red-500 @enderror"
                        multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $story->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('categories')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-4">
                <label for="author_name" class="block text-sm font-medium text-gray-700">Author Name</label>
                <input type="text" name="author_name"
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 @error('author_name') border-red-500 @enderror"
                    value="{{ old('author_name', $story->author_name) }}" required>
                @error('author_name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 @error('status') border-red-500 @enderror"
                    required>
                    <option value="{{ \App\Models\Story::STATUS_COMPLETE }}"
                        {{ old('status', $story->status) === \App\Models\Story::STATUS_COMPLETE ? 'selected' : '' }}>
                        {{ \App\Models\Story::STATUS_COMPLETE }}
                    </option>
                    <option value="{{ \App\Models\Story::STATUS_INCOMPLETE }}"
                        {{ old('status', $story->status) === \App\Models\Story::STATUS_INCOMPLETE ? 'selected' : '' }}>
                        {{ \App\Models\Story::STATUS_INCOMPLETE }}
                    </option>
                </select>
                @error('status')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description"
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 @error('description') border-red-500 @enderror"
                    required>{{ old('description', $story->description) }}</textarea>
                @error('description')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">Update
                Story</button>
        </form>
    </div>
@endsection


@push('scripts')
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categories').select2({
                width: '100%', // Set width for select2 to match Tailwind
                minimumResultsForSearch: Infinity // Hide search box if not needed
            }).removeClass('border-gray-300 rounded-md'); // Remove Tailwind border and radius to prevent conflicts

            // Add custom classes to Select2 elements after initialization
            $('#categories').on('select2:open', function() {
                $('.select2-container--default .select2-selection--multiple').addClass(
                    'border border-gray-300 rounded-md');
            });
        });
    </script>
@endpush
