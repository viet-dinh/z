@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Categories</h1>

            @if (session('success'))
                <span id="success-message" class="bg-green-100 border border-green-400 text-green-700 rounded relative">
                    {{ session('success') }}
                </span>
            @endif
            <a href="{{ route('categories.create') }}"
                class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 mb-4">Add Category</a>
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
                            <td class="py-3 px-4 flex space-x-4 text-center">
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="text-yellow-600 hover:text-yellow-800 cursor-pointer p-1 transition"
                                    title="Edit">
                                    <i class="fas fa-edit text-xl"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 cursor-pointer p-1 transition"
                                        title="Delete">
                                        <i class="fas fa-trash-alt text-xl"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $categories->links('vendor.pagination.tailwind') }} <!-- Tailwind pagination view -->
        </div>
    </div>
@endsection
