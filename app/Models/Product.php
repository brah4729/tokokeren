<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'brief_description',
        'price',
        'stock',
        'image',
        'category_id',
        'is_active',
        'seller_id',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the seller (user) of the product.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Get the reviews for the product.
     */
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the stock movements for the product.
     */
    public function stockMovements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * Add stock to the product.
     */
    public function addStock(int $quantity, ?string $notes = null): void
    {
        $this->increment('stock', $quantity);

        $this->stockMovements()->create([
            'quantity' => $quantity,
            'type' => 'in',
            'notes' => $notes,
            'user_id' => auth()->id(),
        ]);
    }

    /**
     * Reduce stock from the product.
     */
    public function reduceStock(int $quantity, ?string $notes = null): void
    {
        if ($this->stock < $quantity) {
            throw new \Exception("Insufficient stock for product {$this->name}");
        }

        $this->decrement('stock', $quantity);

        $this->stockMovements()->create([
            'quantity' => $quantity,
            'type' => 'out',
            'notes' => $notes,
            'user_id' => auth()->id(),
        ]);
    }
}
