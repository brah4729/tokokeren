@extends('layouts.app')

@section('title', 'Shopping Cart - Toko Keren')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Your Shopping Cart
        </h1>

        @if($cart && $cart->items->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items List -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart->items as $item)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col sm:flex-row items-center gap-6 transition-transform hover:scale-[1.01] duration-200">
                            <!-- Product Image -->
                            <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden">
                                <img src="{{ $item->product->image ?? 'https://via.placeholder.com/150' }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-full h-full object-cover">
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="font-bold text-gray-900 text-lg">
                                    <a href="{{ route('products.show', $item->product) }}" class="hover:text-indigo-600 transition-colors">
                                        {{ $item->product->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $item->product->brief_description }}</p>
                                <p class="text-indigo-600 font-bold mt-2">${{ number_format($item->price, 2) }}</p>
                            </div>

                            <!-- Quantity Controls -->
                            <div class="flex items-center gap-3">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center bg-gray-100 rounded-lg p-1">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-white hover:shadow-sm rounded-md transition-all {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                </form>
                                
                                <span class="font-semibold text-gray-900 w-8 text-center">{{ $item->quantity }}</span>

                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center bg-gray-100 rounded-lg p-1">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-white hover:shadow-sm rounded-md transition-all">+</button>
                                </form>
                            </div>

                            <!-- Subtotal -->
                            <div class="font-bold text-gray-900 w-24 text-right">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </div>

                            <!-- Remove Button -->
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-colors" title="Remove item">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 sticky top-4">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>${{ number_format($cart->total(), 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax (10%)</span>
                                <span>${{ number_format($cart->total() * 0.1, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="text-green-600">Free</span>
                            </div>
                            <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                                    ${{ number_format($cart->total() * 1.1, 2) }}
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}" class="block w-full text-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 transform hover:-translate-y-0.5 transition-all duration-200">
                            Proceed to Checkout
                        </a>
                        
                        <div class="mt-6 text-center">
                            <a href="{{ route('home') }}" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="bg-white rounded-3xl shadow-xl p-12 text-center max-w-2xl mx-auto border border-gray-100">
                <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center bg-indigo-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/30">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
