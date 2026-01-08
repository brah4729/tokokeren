@extends('layouts.app')

@section('title', 'Checkout - Toko Keren')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
            <div class="p-2 bg-indigo-100 rounded-lg">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </div>
            Secure Checkout
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Order Summary</h2>
                    <div class="space-y-4">
                        @foreach($cart->items as $item)
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $item->product->image ?? 'https://via.placeholder.com/80' }}" class="w-full h-full object-cover" alt="{{ $item->product->name }}">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} x ${{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="font-bold text-gray-900">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t border-gray-100 mt-6 pt-4 space-y-2">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>${{ number_format($cart->total(), 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax (10%)</span>
                            <span>${{ number_format($cart->total() * 0.1, 2) }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg text-gray-900 pt-2 border-t border-gray-100 mt-2">
                            <span>Total</span>
                            <span class="text-indigo-600">${{ number_format($cart->total() * 1.1, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Options -->
            <div class="space-y-6">
                <!-- Option 1: Mock Payment (For Testing) -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-sm border border-green-100 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Test Payment</h3>
                            <p class="text-sm text-gray-500">Simulate a successful payment instantly.</p>
                        </div>
                    </div>
                    
                    <form action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_method" value="mock">
                        <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-6 rounded-xl hover:bg-green-700 transition-colors shadow-lg shadow-green-500/30 flex items-center justify-center gap-2">
                            <span>Pay ${{ number_format($cart->total() * 1.1, 2) }} (Test Mode)</span>
                        </button>
                    </form>
                </div>

                <!-- Option 2: Stripe (Requires Keys) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 opacity-75">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-gray-100 rounded-lg">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Credit Card (Stripe)</h3>
                            <p class="text-sm text-gray-500">Requires valid API keys to work.</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 text-center text-gray-500 text-sm">
                            Stripe form would appear here if keys were configured.
                        </div>
                        <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-3 px-6 rounded-xl cursor-not-allowed">
                            Pay with Card (Disabled)
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
