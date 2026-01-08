@extends('layouts.app')

@section('title', 'My Account - Toko Keren')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
            <div class="p-2 bg-indigo-100 rounded-lg">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            My Account
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: User Profile Card -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
                    <div class="px-8 pb-8">
                        <div class="relative -mt-16 mb-4">
                            <div class="h-32 w-32 rounded-full border-4 border-white bg-white shadow-lg flex items-center justify-center overflow-hidden">
                                <span class="text-4xl font-bold text-gray-300">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        </div>
                        
                        <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-500 flex items-center gap-2 mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            {{ $user->email }}
                        </p>
                        
                        <div class="mt-6 pt-6 border-t border-gray-100 space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Member Since</span>
                                <span class="font-medium text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Account Status</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            </div>
                            @if($user->email_verified_at)
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Email Verified</span>
                                <span class="text-green-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Yes
                                </span>
                            </div>
                            @endif
                        </div>

                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST" class="mt-8">
                            @csrf
                            <button type="submit" class="w-full bg-gray-100 text-gray-700 font-bold py-3 px-4 rounded-xl hover:bg-red-50 hover:text-red-600 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Activity</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-xl text-center">
                            <div class="text-2xl font-extrabold text-indigo-600">{{ $productsListedCount }}</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wide mt-1">Products Listed</div>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl text-center">
                            <div class="text-2xl font-extrabold text-purple-600">{{ $reviewsCount }}</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wide mt-1">Reviews Given</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Recent Activity/Orders -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Recent Orders -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-900">Recent Orders</h2>
                        <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View All Orders &rarr;</a>
                    </div>
                    
                    @if($recentOrders->isEmpty())
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">No orders yet</h3>
                            <p class="text-gray-500 mt-1 mb-6">Start shopping to see your orders here.</p>
                            <a href="{{ route('home') }}" class="text-indigo-600 font-bold hover:underline">Browse Products</a>
                        </div>
                    @else
                        <div class="divide-y divide-gray-100">
                            @foreach($recentOrders as $order)
                                <div class="p-6 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center gap-3">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium 
                                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                                   ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                            <span class="text-sm text-gray-500">#{{ $order->order_number }}</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between items-end">
                                        <div>
                                            <p class="text-gray-900 font-medium">{{ $order->items_count }} Items</p>
                                            <p class="text-sm text-gray-500 mt-1">Total</p>
                                        </div>
                                        <span class="text-xl font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Seller Actions Quick Links -->
                <div class="bg-indigo-600 rounded-3xl shadow-xl overflow-hidden text-white p-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-white opacity-10 rounded-full"></div>
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold mb-2">Seller Dashboard</h2>
                        <p class="text-indigo-100 mb-6">Manage your products and check your inventory.</p>
                        
                        <div class="flex gap-4">
                            <a href="{{ route('seller.stock.index') }}" class="bg-white text-indigo-600 font-bold py-3 px-6 rounded-xl hover:bg-gray-50 transition-colors">
                                Manage Inventory
                            </a>
                            <a href="{{ route('admin.products.create') }}" class="bg-indigo-700 text-white font-bold py-3 px-6 rounded-xl hover:bg-indigo-800 transition-colors border border-indigo-500">
                                + Add Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
