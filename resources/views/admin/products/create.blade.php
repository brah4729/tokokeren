@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Add New Product</h1>

    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl">
        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Product Name</label>
                <input type="text" name="name" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Brief Description</label>
                <input type="text" name="brief_description" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Full Description</label>
                <textarea name="description" rows="4" class="w-full px-3 py-2 border rounded" required></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Price</label>
                    <input type="number" step="0.01" name="price" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Stock</label>
                    <input type="number" name="stock" class="w-full px-3 py-2 border rounded" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Category</label>
                <select name="category_id" class="w-full px-3 py-2 border rounded" required>
                    <option value="">Select Category</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Image URL</label>
                <input type="url" name="image" class="w-full px-3 py-2 border rounded" 
                       placeholder="https://example.com/image.jpg">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" checked class="mr-2">
                    <span class="text-gray-700">Active (visible to customers)</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Add Product
                </button>
                <a href="{{ route('home') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection