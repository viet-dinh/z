@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="container">
            <h1>{{ $story->title }}</h1>
            <div>
                <p>{{ $story->content }}</p> <!-- Display story content -->
            </div>
        </div>
    </div>
@endsection
