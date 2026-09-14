<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Interfaces;

use App\Models\Order;

interface OrderCreation
{
    public function createFromCart(array $cart, array $orderData, string $paymentMethod, int $userId): Order;
}
