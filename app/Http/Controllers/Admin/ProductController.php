<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'brief_description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|url', // Keeping it simple with URL for now as per previous seeders
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'brief_description' => $request->brief_description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $request->image ?? 'https://via.placeholder.com/400',
            'seller_id' => auth()->id(), // Assign current user as seller
            'is_active' => true,
        ]);

        return redirect()->route('seller.stock.index')->with('success', 'Product created successfully!');
    }
}
