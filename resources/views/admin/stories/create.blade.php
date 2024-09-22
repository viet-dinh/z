@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add Story</h1>

        <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="thumbnail">Upload Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail"
                    class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*" required>
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="categories">Select Categories</label>
                <select id="categories" name="categories[]" class="form-control @error('categories') is-invalid @enderror"
                    multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>{{ $category->name }}
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
                    value="{{ old('author_name') }}" required>
                @error('author_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="" disabled selected>Select status</option>
                    <option value="{{ \App\Models\Story::STATUS_COMPLETE }}"
                        {{ old('status') == \App\Models\Story::STATUS_COMPLETE ? 'selected' : '' }}>
                        {{ \App\Models\Story::STATUS_COMPLETE }}
                    </option>
                    <option value="{{ \App\Models\Story::STATUS_INCOMPLETE }}"
                        {{ old('status') == \App\Models\Story::STATUS_INCOMPLETE ? 'selected' : '' }}>
                        {{ \App\Models\Story::STATUS_INCOMPLETE }}
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Story</button>
        </form>
    </div>
@endsection
