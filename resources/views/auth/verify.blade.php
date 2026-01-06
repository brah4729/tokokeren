@extends('layouts.app')

@section('title', 'Verify Email - Toko Keren')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-cyan-500/30 to-blue-500/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-emerald-500/30 to-teal-500/30 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        <!-- Verification Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-600 px-8 py-10 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl mb-4">
                    <span class="text-3xl">📧</span>
                </div>
                <h1 class="text-3xl font-bold text-white">Verify Your Email</h1>
                <p class="text-cyan-100 mt-2">We sent a code to {{ Auth::user()->email }}</p>
            </div>

            <!-- Form -->
            <div class="px-8 py-10">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('info'))
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-blue-700 text-sm">{{ session('info') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.verify') }}" class="space-y-6">
                    @csrf

                    <!-- Code Field -->
                    <div class="space-y-2">
                        <label for="code" class="block text-sm font-semibold text-gray-700 text-center">
                            Enter 6-Digit Verification Code
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="code" 
                                name="code" 
                                maxlength="6"
                                required 
                                autofocus
                                class="w-full py-5 px-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200 text-gray-900 text-center text-3xl tracking-[0.5em] font-mono @error('code') border-red-500 @enderror"
                                placeholder="••••••"
                                pattern="[0-9]{6}"
                                inputmode="numeric"
                            >
                        </div>
                        @error('code')
                            <p class="text-red-500 text-sm text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Timer/Info -->
                    <div class="text-center">
                        <p class="text-gray-500 text-sm">
                            ⏰ Code expires in <span class="font-semibold text-gray-700">15 minutes</span>
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full py-4 px-6 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-cyan-500/30 hover:shadow-xl hover:shadow-cyan-500/40 transform hover:-translate-y-0.5 transition-all duration-200"
                    >
                        Verify Email
                    </button>
                </form>

                <!-- Resend Code -->
                <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                    <p class="text-gray-500 text-sm mb-4">Didn't receive the code?</p>
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button 
                            type="submit"
                            class="inline-flex items-center gap-2 py-3 px-6 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-200"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Resend Code
                        </button>
                    </form>
                </div>

                <!-- Logout option -->
                <div class="mt-6 text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-gray-600 text-sm underline transition-colors">
                            Sign in with a different account
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-500 text-sm mt-8">
            🛒 Toko Keren - Your Premium Shopping Destination
        </p>
    </div>
</div>
@endsection
