<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $this->getCart();
        
        try {
            $cart->addItem($request->product_id, $request->quantity);
            return back()->with('success', 'Product added to cart!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return back()->with('success', 'Item removed from cart!');
    }

    public function update(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $item->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cart updated!');
    }

    private function getCart()
    {
        if (auth()->check()) {
            return Cart::with('items.product')->firstOrCreate(['user_id' => auth()->id()]);
        }
        
        $sessionId = session()->getId();
        return Cart::with('items.product')->firstOrCreate(['session_id' => $sessionId]);
    }
}
?>