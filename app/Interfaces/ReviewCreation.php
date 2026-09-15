<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Interfaces;

use App\Models\Review;

interface ReviewCreation
{
    public function createForProduct(array $reviewData, int $productId, int $userId): Review;
}
