@extends('layouts.app')

@section('title', $product->name . ' - Toko Keren')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-gray-500">{{ $product->category->name ?? 'Product' }}</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 font-medium text-gray-800">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Main Section -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- Image Column -->
                <div class="relative bg-gray-100 h-96 lg:h-auto min-h-[500px] flex items-center justify-center overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 to-purple-50/50"></div>
                    <img 
                        src="{{ $product->image ?? 'https://via.placeholder.com/800x800' }}" 
                        alt="{{ $product->name }}" 
                        class="relative w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    >
                    @if($product->stock <= 0)
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center backdrop-blur-sm">
                            <span class="bg-red-500 text-white px-6 py-2 rounded-full text-lg font-bold tracking-wider transform -rotate-12 shadow-lg">OUT OF STOCK</span>
                        </div>
                    @endif
                </div>

                <!-- Details Column -->
                <div class="p-8 lg:p-12 flex flex-col justify-center bg-white/80 backdrop-blur-md">
                    <div class="space-y-6">
                        <!-- Category Badge -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 shadow-sm">
                            {{ $product->category->name ?? 'General' }}
                        </span>

                        <!-- Title & Price -->
                        <div>
                            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">{{ $product->name }}</h1>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                                <!-- Rating Stars (Static average for now or dynamic) -->
                                <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-lg">
                                    <div class="flex text-yellow-400">
                                        @php
                                            $avgRating = $product->reviews->avg('rating') ?? 0;
                                            $fullStars = floor($avgRating);
                                            $halfStar = $avgRating - $fullStars >= 0.5;
                                        @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $fullStars)
                                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            @elseif($halfStar && $i == $fullStars + 1)
                                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><defs><linearGradient id="half_{{$i}}"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="transparent" stop-opacity="1" /></linearGradient></defs><path fill="url(#half_{{$i}})" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/><path fill="none" class="text-gray-300" stroke="currentColor" stroke-width="0" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-sm font-medium text-yellow-700">{{ number_format($avgRating, 1) }} ({{ $product->reviews->count() }} reviews)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="prose prose-indigo text-gray-600 leading-relaxed">
                            <p>{{ $product->description }}</p>
                        </div>

                        <!-- Seller Info -->
                        @if($product->seller)
                            <div class="flex items-center p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 flex items-center justify-center text-white font-bold">
                                    {{ substr($product->seller->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Sold by</p>
                                    <p class="text-sm text-gray-600">{{ $product->seller->name }}</p>
                                </div>
                                <button class="ml-auto text-sm text-indigo-600 font-medium hover:text-indigo-800">
                                    View Store
                                </button>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="pt-6 border-t border-gray-100">
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add') }}" method="POST" class="flex gap-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <div class="w-24">
                                        <label for="quantity" class="sr-only">Quantity</label>
                                        <div class="relative rounded-xl border border-gray-300 shadow-sm">
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                                class="block w-full text-center border-none rounded-xl focus:ring-indigo-500 focus:border-indigo-500 py-3 sm:text-sm bg-transparent font-medium"
                                            >
                                        </div>
                                    </div>

                                    <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full bg-gray-200 text-gray-500 font-bold py-4 px-8 rounded-xl cursor-not-allowed">
                                    Sold Out
                                </button>
                            @endif
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-500 flex items-center justify-center gap-1">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    {{ $product->stock }} items left in stock
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Reviews Summary -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 sticky top-4">
                        <div class="text-center mb-6">
                            <div class="text-5xl font-extrabold text-gray-900">{{ number_format($avgRating, 1) }}</div>
                            <div class="flex items-center justify-center mt-2 text-yellow-400">
                                @for($i=1; $i<=5; $i++)
                                   <svg class="w-5 h-5 {{ $i <= round($avgRating) ? 'fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                @endfor
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Based on {{ $product->reviews->count() }} reviews</p>
                        </div>
                        
                        <div class="space-y-3">
                            <!-- Helper for rating bars, assuming we passed distribution or calculate it here -->
                            @foreach([5,4,3,2,1] as $star)
                                @php
                                    $count = $product->reviews->where('rating', $star)->count();
                                    $percent = $product->reviews->count() > 0 ? ($count / $product->reviews->count()) * 100 : 0;
                                @endphp
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-medium text-gray-600 w-3">{{ $star }}</span>
                                    <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-400 w-8 text-right">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <button class="w-full mt-6 py-2 px-4 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            Write a Review
                        </button>
                    </div>
                </div>

                <!-- Reviews List -->
                <div class="md:col-span-2 space-y-6">
                    @forelse($product->reviews as $review)
                        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-bold text-gray-900">{{ $review->user->name }}</p>
                                        <div class="flex items-center text-yellow-400 text-xs mt-0.5">
                                            @for($i=1; $i<=5; $i++)
                                                <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                            @endfor
                                            <span class="ml-2 text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ $review->comment }}
                            </p>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No reviews yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Be the first to share what you think!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
