@extends('layouts.app')

@section('title', 'Login - Toko Keren')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-indigo-500/30 to-purple-500/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-blue-500/30 to-cyan-500/30 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        <!-- Login Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 px-8 py-10 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl mb-4">
                    <span class="text-3xl">🔐</span>
                </div>
                <h1 class="text-3xl font-bold text-white">Welcome Back</h1>
                <p class="text-indigo-100 mt-2">Sign in to your account</p>
            </div>

            <!-- Form -->
            <div class="px-8 py-10">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Username Field -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-gray-700">
                            Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                required 
                                autofocus
                                class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 text-gray-900 placeholder-gray-400 @error('name') border-red-500 @enderror"
                                placeholder="Enter your username"
                            >
                        </div>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 text-gray-900 placeholder-gray-400"
                                placeholder="Enter your password"
                            >
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember"
                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full py-4 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 transform hover:-translate-y-0.5 transition-all duration-200"
                    >
                        Sign In
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center my-8">
                    <div class="flex-1 border-t border-gray-200"></div>
                    <span class="px-4 text-sm text-gray-400">Don't have an account?</span>
                    <div class="flex-1 border-t border-gray-200"></div>
                </div>

                <!-- Register Link -->
                <a 
                    href="{{ route('register') }}"
                    class="block w-full py-4 px-6 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-center transition-all duration-200"
                >
                    Create an Account
                </a>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-500 text-sm mt-8">
            🛒 Toko Keren - Your Premium Shopping Destination
        </p>
    </div>
</div>
@endsection
