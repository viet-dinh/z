@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Story</h1>

        <form action="{{ route('stories.update', $story) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $story->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="thumbnail">Upload Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail"
                    class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if ($story->thumbnail)
                <div class="mb-3">
                    <label>Current Thumbnail:</label><br>
                    <img src="{{ asset('thumbnails/' . $story->thumbnail) }}" alt="Current Thumbnail" class="img-thumbnail"
                        style="max-height: 200px;">
                </div>
            @endif

            <div class="mb-3">
                <label for="categories" class="form-label">Categories</label>
                <select name="categories[]" id="categories" class="form-control @error('categories') is-invalid @enderror"
                    multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $story->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('categories')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="author_name" class="form-label">Author Name</label>
                <input type="text" name="author_name" class="form-control @error('author_name') is-invalid @enderror"
                    value="{{ old('author_name', $story->author_name) }}" required>
                @error('author_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
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
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $story->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Story</button>
        </form>
    </div>
@endsection
