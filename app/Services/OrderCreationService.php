<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Services;

use App\Exceptions\InsufficientStockException;
use App\Interfaces\OrderCreation;
use App\Models\Item;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderCreationService implements OrderCreation
{
    public function createFromCart(array $cart, array $orderData, string $paymentMethod, int $userId): Order
    {
        return DB::transaction(function () use ($cart, $orderData, $paymentMethod, $userId): Order {
            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);

                if ($product === null || $product->getStock() < $quantity) {
                    throw new InsufficientStockException;
                }
            }

            $orderData['user_id'] = $userId;
            $orderData['state'] = 'inProcess';

            $order = Order::create($orderData);

            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);

                Item::create([
                    'quantity' => $quantity,
                    'price' => $product->getPrice(),
                    'product_id' => $product->getId(),
                    'order_id' => $order->getId(),
                ]);

                $product->setStock($product->getStock() - $quantity);
                $product->save();
            }

            Payment::create([
                'method' => $paymentMethod,
                'date' => now(),
                'status' => 'pending',
                'transaction_code' => random_int(100000, 999999),
                'order_id' => $order->getId(),
            ]);

            return $order;
        });
    }
}
