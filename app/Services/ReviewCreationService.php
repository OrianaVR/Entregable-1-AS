<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Services;

use App\Interfaces\ReviewCreation;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewCreationService implements ReviewCreation
{
    public function createForProduct(array $reviewData, int $productId, int $userId): Review
    {
        return DB::transaction(function () use ($reviewData, $productId, $userId): Review {
            $product = Product::findOrFail($productId);

            $reviewData['product_id'] = $productId;
            $reviewData['user_id'] = $userId;

            $review = Review::create($reviewData);

            $product->setFeatured($product->getAverageRating() >= 4);
            $product->save();

            return $review;
        });
    }
}
