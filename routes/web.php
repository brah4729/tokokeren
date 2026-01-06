<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerStockController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;  // ← Give it a different name
use Illuminate\Support\Facades\Route;

// =====================
// Authentication Routes
// =====================

// Guest routes (only accessible when not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Email verification routes (must be logged in)
Route::middleware('auth')->group(function () {
    Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('verification.notice');
    Route::post('/verify', [AuthController::class, 'verify'])->name('verification.verify');
    Route::post('/verify/resend', [AuthController::class, 'resendCode'])->name('verification.resend');
});

// Logout (must be logged in)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// =====================
// Public Routes
// =====================

// Home page
Route::get('/', [ProductController::class, 'index'])->name('home');

// Product routes
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
});

// Protected routes (require login)
Route::middleware('auth')->group(function () {
    // Checkout & Payment
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    
    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Admin routes (require login)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);  // ← Use the alias
});

// Seller routes (require login AND seller role)
Route::middleware('auth')->prefix('seller')->name('seller.')->group(function () {
    Route::get('/stock', [SellerStockController::class, 'index'])->name('stock.index');
    Route::post('/stock/{product}/resupply', [SellerStockController::class, 'resupply'])->name('stock.resupply');
});