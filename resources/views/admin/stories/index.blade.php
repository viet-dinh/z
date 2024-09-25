<!-- resources/views/admin/stories/index.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Stories</h1>
        <a href="{{ route('stories.create') }}" class="btn btn-primary">Add Story</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Link</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Categories</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stories as $story)
                    <tr>
                        <td>{{ $story->id }}</td>
                        <td><a target="_blank" href="{{ route('story.show', $story->slug) }}">Preview</a></td>
                        <td>{{ $story->title }}</td>
                        <td><img src="{{ asset('thumbnails/' . $story->thumbnail) }}" alt="Thumbnail" class="img-thumbnail"
                                style="max-height: 100px;"></td>
                        <td>
                            @if ($story->categories->isNotEmpty())
                                <ul>
                                    @foreach ($story->categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                No Categories
                            @endif
                        </td>
                        <td>{{ $story->author_name }}</td>
                        <td>{{ $story->status }}</td>
                        <td>
                            <a href="{{ route('stories.edit', $story) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('stories.destroy', $story) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
