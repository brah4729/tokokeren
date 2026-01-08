@extends('layouts.app')

@section('title', 'Add New Product - Toko Keren')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="md:flex md:items-center md:justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Add New Product</h1>
            <a href="{{ route('seller.stock.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Inventory
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <form action="{{ route('admin.products.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Basic Info -->
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm h-12 px-4 border" placeholder="e.g. Wireless Headphones">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm h-12 px-4 border">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Descriptions -->
                <div class="space-y-6">
                    <div>
                        <label for="brief_description" class="block text-sm font-medium text-gray-700">Brief Description</label>
                        <input type="text" name="brief_description" id="brief_description" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm h-12 px-4 border" placeholder="Short summary for product cards">
                        <p class="mt-1 text-xs text-gray-500">Max 255 characters.</p>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Full Description</label>
                        <textarea name="description" id="description" rows="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-4 border" placeholder="Detailed product description..."></textarea>
                    </div>
                </div>

                <!-- Pricing & Stock -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="price" id="price" min="0" step="0.01" required class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md h-12 border" placeholder="0.00">
                        </div>
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Initial Stock</label>
                        <input type="number" name="stock" id="stock" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm h-12 px-4 border" placeholder="0">
                    </div>
                </div>

                <!-- Image -->
                <div>
                     <label for="image" class="block text-sm font-medium text-gray-700">Image URL</label>
                     <input type="url" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm h-12 px-4 border" placeholder="https://example.com/image.jpg">
                     <p class="mt-1 text-xs text-gray-500">Leave blank for default placeholder.</p>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/30">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection