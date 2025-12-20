<?php
// FILE: app/Http/Controllers/SellerStockController.php
// ============================================

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SellerStockController extends Controller
{
    public function index()
    {
        $products = Product::withCount('stockMovements')->paginate(20);
        return view('seller.stock.index', compact('products'));
    }

    public function resupply(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        $product->addStock($request->quantity, $request->notes);

        return back()->with('success', 'Stock updated successfully!');
    }

    public function dashboard()
    {
        $totalProducts = Product::count();
        $lowStock = Product::where('stock', '<', 10)->count();
        $outOfStock = Product::where('stock', 0)->count();
        
        return view('seller.dashboard', compact('totalProducts', 'lowStock', 'outOfStock'));
    }
}
?>