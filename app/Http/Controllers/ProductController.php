<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->paginate(12);
        
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'seller', 'reviews.user']);
        return view('products.show', compact('product'));
    }
}
?>
