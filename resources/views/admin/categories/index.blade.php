@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Categories</h1>
        <div>
            <a href="{{ route('categories.create') }}"
                class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 mb-4">Add Category</a>

            @if (session('success'))
                <span id="success-message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 opacity-100 transition-opacity duration-600">
                    {{ session('success') }}
                </span>
            @endif
        </div>

        <div class="overflow-x-auto mt-3">
            <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
                <thead class="bg-gray-100">
                    <tr class="text-left text-gray-600 text-sm uppercase font-semibold">
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Name</th>
                        <th class="py-3 px-4 border-b">Created At</th>
                        <th class="py-3 px-4 border-b">Updated At</th>
                        <th class="py-3 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-t">
                            <td class="py-3 px-4">{{ $category->id }}</td>
                            <td class="py-3 px-4">{{ $category->name }}</td>
                            <td class="py-3 px-4">{{ $category->created_at->format('Y-m-d H:i') }}</td>
                            <td class="py-3 px-4">{{ $category->updated_at->format('Y-m-d H:i') }}</td>
                            <td class="py-3 px-4 flex space-x-2">
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="inline-block bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white py-1 px-3 rounded-md hover:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
