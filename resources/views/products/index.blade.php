@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Our Products</h1>

    @if($products->isEmpty())
        <p class="text-center text-gray-600">No products available yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow group">
                    <a href="{{ route('products.show', $product) }}" class="block relative">
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                        
                        <!-- Hover description -->
                        <div class="absolute inset-0 bg-black bg-opacity-90 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-4">
                            <p class="text-white text-sm text-center">{{ $product->brief_description }}</p>
                        </div>
                    </a>

                    <div class="p-4">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <h3 class="font-semibold text-lg mb-2 hover:text-indigo-600 transition-colors">{{ $product->name }}</h3>
                        </a>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                            <span class="text-sm text-gray-500">Stock: {{ $product->stock }}</span>
                        </div>

                        @if($product->stock > 0)
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                       class="w-full px-3 py-2 border rounded mb-2">
                                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-400 text-white py-2 rounded cursor-not-allowed">
                                Out of Stock
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection