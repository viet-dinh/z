@extends('layouts.main')

@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <div class="container mx-auto py-8">
        <div class="flex flex-wrap lg:flex-nowrap gap-6">
            {{ $chapter->content }}
        </div>
    </div>

    <div id="root" story-id="{{ $chapter->story_id }}" auth-user-id="{{ $authId }}"></div>
    @vite(['resources/css/app.css'])
    @viteReactRefresh
    @vite('resources/js/app.jsx')
@endsection
