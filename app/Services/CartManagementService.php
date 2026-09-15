<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Services;

use App\Interfaces\CartManagement;
use App\Models\Product;

class CartManagementService implements CartManagement
{
    public function addToCart(array $cart, int $productId, int $quantity, int $availableStock): array
    {
        $currentQuantity = $cart[$productId] ?? 0;
        $cart[$productId] = min($currentQuantity + $quantity, $availableStock);

        return $cart;
    }

    public function buildSummary(array $cart): array
    {
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);

            if ($product === null) {
                continue;
            }

            $subtotal = $product->getPrice() * $quantity;
            $total += $subtotal;

            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        return [
            'items' => $items,
            'total' => $total,
        ];
    }
}
