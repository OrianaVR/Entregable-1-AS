<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Interfaces;

interface CartManagement
{
    public function addToCart(array $cart, int $productId, int $quantity, int $availableStock): array;

    public function buildSummary(array $cart): array;
}
