@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add Chapter</h1>
        <form action="{{ route('chapters.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="story_id" class="form-label">Select Story</label>
                <select name="story_id" id="story_id" class="form-select" required>
                    <option value="" disabled selected>Select a story</option>
                    @foreach ($stories as $story)
                        <option value="{{ $story->id }}">{{ $story->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="number" name="order" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Chapter</button>
        </form>
    </div>
@endsection
