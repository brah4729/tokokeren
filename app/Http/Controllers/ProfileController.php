<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        
        // Eager load recent orders with item count
        $recentOrders = Order::where('user_id', $user->id)
            ->withCount('items')
            ->latest()
            ->take(5)
            ->get();
            
        $reviewsCount = $user->reviews()->count();
        $productsListedCount = $user->products()->count();

        return view('profile.show', compact('user', 'recentOrders', 'reviewsCount', 'productsListedCount'));
    }
}
