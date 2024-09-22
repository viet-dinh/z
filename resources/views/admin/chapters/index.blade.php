@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Chapters</h1>
        <a href="{{ route('chapters.create') }}" class="btn btn-primary">Add Chapter</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Story</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chapters as $chapter)
                    <tr>
                        <td>{{ $chapter->id }}</td>
                        <td>{{ $chapter->story->title }}</td>
                        <td>{{ $chapter->title }}</td>
                        <td>{{ $chapter->content }}</td>
                        <td>
                            <a href="{{ route('chapters.edit', $chapter) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('chapters.destroy', $chapter) }}" method="POST" style="display:inline;">
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
