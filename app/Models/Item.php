<?php

/**
 * @author Ana Sofía Angarita Barrios
 *
 * @property int $id
 * @property int $quantity
 * @property float $price
 * @property int $product_id
 * @property int $order_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    public $timestamps = true;

    protected $fillable = ['quantity', 'price', 'product_id', 'order_id'];

    protected $guarded = ['id'];

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setPrice(float $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function getPrice(): float
    {
        return $this->attributes['price'];
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
