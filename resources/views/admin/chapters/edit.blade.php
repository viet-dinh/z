@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Chapter</h1>
        <form action="{{ route('chapters.update', $chapter) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="story_id" class="form-label">Select Story</label>
                <select name="story_id" id="story_id" class="form-select" required>
                    @foreach ($stories as $story)
                        <option value="{{ $story->id }}" {{ $story->id == $chapter->story_id ? 'selected' : '' }}>
                            {{ $story->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="number" name="order" class="form-control" value="{{ $chapter->order }}" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $chapter->title }}" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" required>{{ $chapter->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Chapter</button>
        </form>
    </div>
@endsection
