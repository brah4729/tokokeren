<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'session_id'];  // ← Add session_id here

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function addItem($productId, $quantity = 1)
    {
        $product = Product::findOrFail($productId);
        
        if ($product->stock < $quantity) {
            throw new \Exception('Insufficient stock');
        }

        $cartItem = $this->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            $this->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }
    }

    public function total()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }
}