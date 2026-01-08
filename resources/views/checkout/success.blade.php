@extends('layouts.app')

@section('title', 'Payment Successful - Toko Keren')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full text-center">
        <!-- Success Animation -->
        <div class="mb-8">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-4 animate-[bounce_1s_ease-in-out_1]">
                <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900">Payment Successful!</h2>
            <p class="mt-2 text-sm text-gray-600">
                Thank you for your purchase. Your order <span class="font-bold text-gray-900">#{{ $order->order_number }}</span> has been confirmed.
            </p>
        </div>

        <!-- Success Card -->
        <div class="bg-white py-8 px-4 shadow-xl rounded-2xl sm:px-10 border border-gray-100">
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">What's Next?</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        We've sent a confirmation email to <span class="font-medium text-gray-900">{{ auth()->user()->email }}</span>. You can track your order status in your account.
                    </p>
                </div>

                <div class="border-t border-gray-100 pt-6 space-y-4">
                    <a href="{{ route('home') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Return to Home Page
                    </a>
                    
                    <a href="{{ route('orders.show', $order) }}" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        View Order Details
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
